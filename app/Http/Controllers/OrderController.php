<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Province;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class OrderController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        $cart = session()->get('cart');
        return view('customer.checkout', compact('cart', 'provinces'));
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }
    // public function check_ongkir(Request $request)
    // {


    //     dd($cost);
    //     return response()->json($cost);
    // }

    public function store(Request $request)
    {

        // validasi input
        $validated = $request->validate([
            'country' => 'required|string',
            'name' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:20|min:8',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:20',
            'city_origin' => 'required',
            'province_destination' => 'required',
            'city_destination' => 'required',
            'courier' => 'required',
        ]);
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        // menyimpan data order ke dalam session
        $order = [
            'country' => $validated['country'],
            'name' => $validated['name'],
            'no_tlp' => $validated['no_tlp'],
            'alamat' => $validated['alamat'],
            'kecamatan' => $validated['kecamatan'],
            'kode_pos' => $validated['kode_pos'],
            'user_id' => Auth::id(),
            'city_origin' => $validated['city_origin'],
            'province_destination' => $validated['province_destination'],
            'city_destination' => $validated['city_destination'],
            'courier' => $validated['courier'],
            'cost'     => $cost,
        ];
        session()->put('order', $order);

        // redirect ke halaman lain atau melakukan operasi lain
        return redirect()->route('orders.confirm')->with('success', 'Berhasil memasukan data !');
    }

    public function confirm()
    {
        $cart = session()->get('cart');
        $orders = session()->get('order');
        $ongkir = $orders['cost'][0]['costs'];
        // dd($orders);
        $province = Province::find($orders['province_destination']);
        $city = City::where('city_id', $orders['city_destination'])->get()[0];
        $produk = Product::all();
        return view('customer.confirm', compact('cart', 'produk', 'orders', 'city', 'province', 'ongkir'));
    }


    public function add_order(Request $request)
    {

        // Validasi data formulir checkout
        $validator = Validator::make($request->all(), [
            'shippingserve' => 'required',
        ], [
            'shippingserve.required' => 'Please select a shipping method'
        ]);

        if ($validator->fails()) {
            // Jika validasi gagal, kembali ke halaman checkout dengan pesan error
            return redirect('/confirm')
                ->withErrors($validator)
                ->withInput();
        } else {
            // Jika validasi berhasil, lanjutkan proses checkout

            $id_user = Auth::id();

            // Simpan data ke dalam table orders
            $order = new Order;
            $order->name = $request->name;
            $order->contact = $request->contact;
            $order->alamat = $request->alamat;
            $order->shipto = $request->shipto;
            $order->shippingserve = $request->shippingserve;
            $order->shippingcode = $request->shippingcode;
            $order->shippingcost = $request->shippingcost;
            $order->id_user = $id_user;
            $order->save();
        }
        // Simpan data ke dalam table order_products
        $cart = session()->get('cart');
        foreach ($cart as $item) {
            $order_product = new OrderProduct;
            $order_product->order_id = $order->id;
            $order_product->product_name = $item['product_name'];
            $order_product->size = $item['size'];
            $order_product->discount = $item['discount'];
            $order_product->disc_price = $item['disc_price'];
            $order_product->qty = $item['qty'];
            $order_product->price = $item['price'];
            $order_product->total_qty = $item['total_qty'];
            $order_product->subtotal = $item['subtotal'];
            $order_product->total_price = $item['total_price'];
            $order_product->status = $request->status;
            $order_product->save();
        }

        // Hapus session cart
        session()->forget('cart');

        return redirect()->route('clear.payment', compact('order'))->with('success', 'Order created successfully');
    }

    public function clear_payment()
    {
        $payment = Order::findOrFail();
        return view('customer.clear_payment', compact('payment'));
    }
}
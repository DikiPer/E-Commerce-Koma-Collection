<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $collection = collect($cart);
        $province = Province::find($orders['province_destination']);
        $city = City::where('city_id', $orders['city_destination'])->get()[0];
        $produk = Product::all();
        return view('customer.confirm', compact('cart', 'produk', 'orders', 'city', 'province'));
    }

    public function orders()
    {
        $orders = session()->get('order');
        $ongkir = $orders['cost'][0]['costs'];

        return response()->json($ongkir);
    }


    public function add_order(Request $request)
    {

        // Validasi data formulir checkout
        $validator = Validator::make($request->all(), [
            'shippingserve' => 'required'
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
            $user = Auth::user();
            $address = $user->address;
            $id_pesanan = Str::random(3) . mt_rand(1000, 5000);

            $orders = session()->get('order');
            // Simpan data ke dalam table orders
            $order = new Order;
            $order->id_pesanan = $id_pesanan;
            $order->name = $request->name;
            $order->contact = $request->contact;
            $order->alamat = $address;
            $order->shipto = $request->shipto;
            $order->shippingserve = $request->shippingserve;
            $order->shippingcode = $request->shippingcode;
            $order->shippingcost = $request->shippingcost;
            $order->id_user = $id_user;
            $order->total_qty = $request->total_qty;
            $order->subtotal = $request->subtotal;
            $order->total_price = $request->total_price;
            $order->status = $request->status;
            $order->payment_method = $request->payment_method;
            $order->save();
        }

        // Simpan data ke dalam table order_products
        $cart = session()->get('cart');
        $id_order = Order::latest()->first();
        // dd($id_order->id);
        // dd($id_order);
        foreach ($cart as $detail) {
            $order_product = new OrderProduct;
            $order_product->id_user = $id_user;
            $order_product->id_order = $id_order->id;
            $order_product->id_produk = $detail['product_id'];
            $order_product->product_name = $detail['name'];
            $order_product->size = $detail['size'];
            $order_product->discount = $detail['discount'];
            $order_product->disc_price = NULL;
            $order_product->qty = $detail['quantity'];
            $order_product->price = $detail['price'];
            $order_product->save();
        }

        // Hapus session cart
        session()->forget('cart');

        return redirect()->route('clear.payment', compact('order'))->with('success', 'Order created successfully');
    }

    public function showClearPayment(Order $order)
    {
        if ($order->payment_method == 'tf_bca') {
            return view('payment.bca', [
                'order' => $order,
                'bankName' => 'BCA',
                'bankAccountNumber' => '1234567890',
                'totalPrice' => $order->total_price,
                'totalQty' => $order->total_qty,
                'products' => $order->order_products
            ]);
        } elseif ($order->payment_method == 'tf_mandiri') {
            return view('payment.mandiri', [
                'order' => $order,
                'bankName' => 'Mandiri',
                'bankAccountNumber' => '0987654321',
                'totalPrice' => $order->total_price,
                'totalQty' => $order->total_qty,
                'products' => $order->order_products
            ]);
        } elseif ($order->payment_method == 'tf_bsi') {
            return view('payment.bsi', [
                'order' => $order,
                'bankName' => 'BSI',
                'bankAccountNumber' => '2468013579',
                'totalPrice' => $order->total_price,
                'totalQty' => $order->total_qty,
                'products' => $order->order_products
            ]);
        } else {
            return view('payment.unsupported', [
                'order' => $order
            ]);
        }
    }

    public function pesanan()
    {
        $user_id = Auth::id();
        $orders = DB::table('orders')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.id_order')
            ->select('orders.*', 'order_products.*')
            ->where('orders.id_user', '=', $user_id)
            ->orderByDesc('orders.created_at')
            ->get();

        return view('customer.pesanan', ['orders' => $orders]);
    }


    public function details($id)
    {
        $order_product = OrderProduct::where('id_order', $id)->get();

        return response()->json(['data' => $order_product]);
    }



    // public function pesanan($id)
    // {
    //     $user_id = Auth::id();
    //     $orders = Order::where('id_user', $user_id)->orderByDesc('created_at')->get();
    //     $order_product = OrderProduct::where('id_order', $id)->get();

    //     return view('customer.pesanan', compact('orders', 'order_product'));
    // }
}
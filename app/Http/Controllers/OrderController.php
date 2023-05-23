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
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;


class OrderController extends Controller
{

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

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
            'shippingserve' => 'required',
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'shippingserve.required' => 'Please select a shipping method',
            'bukti_pembayaran.image' => 'The file must be an image',
            'bukti_pembayaran.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            'bukti_pembayaran.max' => 'The image may not be greater than 2 MB'
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
            $date = date('dmY');
            $id_pesanan = 'KOMA-' . Str::random(3) . mt_rand(1000, 5000) . '-' . $date;

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
        foreach ($cart as $detail) {
            $order_product = new OrderProduct;
            $order_product->id_user = $id_user;
            $order_product->id_order = $id_order->id;
            $order_product->id_pesanan = $id_pesanan;
            $order_product->id_produk = $detail['product_id'];
            $order_product->product_name = $detail['name'];
            $order_product->size = $detail['size'];
            $order_product->discount = $detail['discount'];
            $order_product->disc_price = NULL;
            $order_product->qty = $detail['quantity'];
            $order_product->price = $detail['price'];

            // Mengurangi stok produk jika nilai kuantitas terisi
            if ($detail['quantity'] > 0) {
                $product = Product::find($detail['product_id']);
                $product->stock -= $detail['quantity'];
                $product->save();
            }

            // dd($order_product);
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
        $orders = Order::where('id_user', $user_id)->orderByDesc('created_at')->orderByDesc('created_at')
            ->paginate(10);
        // dd($orders);

        return view('customer.pesanan', ['orders' => $orders]);
    }


    public function detail_pesanan($id_order)
    {
        $order_product = OrderProduct::where('id_order', $id_order)->get();

        return view('customer.detail_pesanan', ['data' => $order_product, 'id_order' => $id_order]);
    }

    public function edit($id_order)
    {
        $order = OrderProduct::where('id_order', $id_order)->distinct()->get(['id_pesanan']);
        $order_product = OrderProduct::where('id_order', $id_order)->get();
        $detail = Order::where('id', $id_order)->first(['status', 'total_price', 'payment_method', 'id', 'shippingserve', 'shippingcost']);
        $id_pesanan = $order[0]->id_pesanan;
        $barcode = DNS1D::getBarcodeHTML($id_pesanan, "C128");


        return view('customer.unggah_tf', compact('order', 'order_product', 'detail', 'barcode'));
    }

    public function update(Request $request, $id_order)
    {
        // Validasi file bukti pembayaran
        $request->validate([
            'bukti_pembayaran' => 'required|file|max:2048',
        ]);

        // Get file from request
        $bukti_pembayaran = $request->file('bukti_pembayaran');

        // Get the authenticated user
        $user = Auth::user();

        // Get the order
        $order = Order::findOrFail($id_order);

        // Generate unique filename for the file
        $filename = $order->id_pesanan . '_' . $user->id . '.' . $bukti_pembayaran->getClientOriginalExtension();


        // Save the file to storage/app/public/bukti_pembayaran/
        $bukti_pembayaran->move(public_path('/storage/bukti_pembayaran'), $filename);
        // $bukti_pembayaran->storeAs('storage/bukti_pembayaran', $filename);

        // Update bukti_pembayaran field in Order table
        Order::where('id', $id_order)->update([
            'bukti_pembayaran' => $filename,
        ]);

        // Redirect back with success message
        return redirect()->route('detail.pesanan', ['id' => $id_order])->with('success', 'Bukti pembayaran berhasil diunggah!. Proses verifikasi pembayaran 1x24 jam');
    }
}
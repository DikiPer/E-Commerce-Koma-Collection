<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\Product;
use Milon\Barcode\DNS1D;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class HomeAdminController extends Controller
{
    public function index()
    {
        $product_count = Product::count();
        $user_count = User::count();
        $order_product_count = OrderProduct::count();
        $order_count = Order::count();


        return view('dashboard', compact('product_count', 'user_count', 'order_product_count', 'order_count'));
    }

    public function sales()
    {
        $sales = OrderProduct::all();

        return view('admin.sales', compact('sales'));
    }

    public function detail_sales($id)
    {
        $detail = OrderProduct::find($id);
        return view('admin.detail_sales', compact('detail'));
    }

    public function order()
    {
        $order = Order::all();

        return view('admin.order', compact('order'));
    }

    public function detail_order($id)
    {
        $order = Order::find($id);

        return view('admin.detail_order', compact('order'));
    }

    public function export()
    {
        $date = date('dmY');
        $sales = OrderProduct::all();

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="sales.xlsx"',
        ];
        // menuju file yang akan diunduh
        $pathToFile = (new FastExcel($sales))->export(storage_path('app/sales.xlsx'));


        return response()->download($pathToFile, 'sales' . '-' . $date . '.xlsx', $headers);
    }

    public function export_order()
    {
        $date = date('dmY');
        $order = Order::all();

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="order.xlsx"',
        ];
        // menuju file yang akan diunduh
        $pathToFile = (new FastExcel($order))->export(storage_path('app/order.xlsx'));


        return response()->download($pathToFile, 'orders' . '-' . $date . '.xlsx', $headers);
    }

    public function export_order_pdf($id)
    {
        $order = Order::findOrFail($id);
        $order_product = OrderProduct::where('id_order', $id)->get();
        $id_pesanan = $order->id_pesanan;
        $barcode = DNS1D::getBarcodeHTML($id_pesanan, "C128");
        $pdf = FacadePdf::loadView('admin.order_pdf', ['order' => $order, 'barcode' => $barcode, 'order_product' => $order_product]);

        return $pdf->stream('INVOICE' . '-' . $order->id_pesanan . '-' . $order->nama . '.pdf');
    }

    public function message()
    {
        $message = Message::all();

        return view('admin.message', compact('message'));
    }
}
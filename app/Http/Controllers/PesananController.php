<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PesananController extends Controller
{
    public function index()
    {
        $order = Order::all();

        return view('orders.index', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Order::find($id);
        $order->status = $request->get('status');
        $order->save();


        return redirect('/user_order')->with('success', 'Order has been update');
    }

    public function details($id)
    {
        $order = OrderProduct::where('id_order', $id)->get();
        $id_order = $id;

        return view('orders.detail', compact('order', 'id_order'));
    }

    public function generatePDF($id)

    {
        $order = OrderProduct::where('id_order', $id)->get();

        $data = ['data' => $order];
        dd($data);

        $pdf = FacadePdf::loadView('orders.pdf', $data);
        return $pdf->stream($order->id_order . '-' . 'ID-' . $order->id_pesanan . '.pdf');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstFunction()
    {
        $firstData = Product::where('discount', 1)->get();
        return $firstData;
    }

    public function secondFunction()
    {
        $secondData = Product::all();
        return $secondData;
    }

    public function showPage()
    {
        $firstData = $this->firstFunction();
        $secondData = $this->secondFunction();
        return view('customer.index', compact('firstData', 'secondData'));
    }

    public function sale()
    {
        $sale = Product::where('discount', 1)->get();
        return view('onsale', compact('sale'));
    }

    public function onsale()
    {
        $onsale = Product::where('discount', 1)->get();
        return view('customer.onsale', compact('onsale'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function howtoorder()
    {
        return view('pages.howtoorder');
    }

    public function coomingsoon()
    {
        return view('pages.coomingsoon');
    }

    public function shop(Request $request)
    {
        $category = $request->input('category'); // ambil input category dari URL

        if ($category) {
            $products = Product::where('category', $category)->get(); // filter data berdasarkan category
        } else {
            $products = Product::all();
        }

        return view('shop', [
            'products' => $products,
            'category' => $category // kirim category ke view untuk ditampilkan pada filter
        ]);
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);
        $all = Product::orderBy('id', 'desc')->take(5)->get();
        return view('detail_product', compact('product', 'all'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|',
            'email' => 'required|email|unique:messages,email',
            'subject' => 'required|max:255',
            'message' => 'required|max:255'
        ]);

        $message = Message::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas pesan atau saran yang telah diberikan.');
    }
}
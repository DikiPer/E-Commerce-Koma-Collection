<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'code' => 'required|unique:products',
            'description' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:3048',
            'category' => 'required',
            'stock' => 'required',
            'berat' => 'required',
            'size' => 'required',
            'discount' => 'required',
            'discount_price' => 'required_if:discount,1',
            'start_discount' => 'required_if:discount,1|date',
        ]);

        $product = new Product([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'code' => $request->get('code'),
            'description' => $request->get('description'),
            'category' => $request->get('category'),
            'stock' => $request->get('stock'),
            'berat' => $request->get('berat'),
            'size' => $request->get('size'),
            'discount' => $request->get('discount'),
            'discount_price' => $request->get('discount_price'),
            'start_discount' => $request->get('start_discount'),
        ]);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/product');
            $image->move($destinationPath, $name);
            $product->images = $name;
        }

        $product->save();
        // dd($product);
        return redirect('/product')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('/product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'code' => 'required|unique:products,code,' . $id,
            'description' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg|max:3048',
            'category' => 'required',
            'stock' => 'required',
            'berat' => 'required',
            'size' => 'required',
            'discount' => 'required',
            'discount_price' => 'required_if:discount,1',
            'start_discount' => 'required_if:discount,1'
        ]);

        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->code = $request->get('code');
        $product->description = $request->get('description');
        $product->category = $request->get('category');
        $product->stock = $request->get('stock');
        $product->berat = $request->get('berat');
        $product->size = $request->get('size');
        $product->discount = $request->get('discount');
        $product->discount_price = $request->get('discount_price');
        $product->total_disc = $request->price - $request->discount_price;
        $product->start_discount = $request->get('start_discount');

        if ($request->hasFile('images')) {

            if ($request->hasFile('images')) {

                if (!empty($product->images)) {
                    unlink(public_path('/storage/product/' . $product->images));
                }
                $image = $request->file('images');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/storage/product');
                $image->move($destinationPath, $name);
                $product->images = $name;
            }
        }

        $product->save();
        return redirect('/product')->with('success', 'Product has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product successfully deleted.');
    }

    public function discountedProducts()
    {
        $products = Product::where('discount', 1)->get();
        return view('products.onsale', compact('products'));
    }
}
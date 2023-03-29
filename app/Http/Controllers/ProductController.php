<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $products = Product::where("name","LIKE","%$keyword%")
            ->orWhere("category","LIKE","%$keyword")
            ->latest()->paginate($perPage);
        } else {
        $products = Product::latest()->paginate($perPage);
        }

        return view('products.index', ['products' => $products])->with('1',(request()->input('page',1) -1)*5);
    }
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('products.create');
    }
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        /* form validation */
        $request->validate([
        'name' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,gif,svg|max:2028',
        'category' => 'required',
        'quantity' => 'required',
        'price' => 'required',
        ]);

        $product = new Product;

        //get image
        $file_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name); //save to folder

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->image = $file_name;

        $product->save();
        return redirect()->route('products.index')->with('success','Product added successfully');
    }
    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show',['product'=>$product]);
    }
    /**
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit',['product'=>$product]);
    }
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        /* validation */
        $request->validate([
        'name' => 'required',
        'category' => 'required',
        'quantity' => 'required',
        'price' => 'required',
        ]);

        $file_name = $request->hidden_product_image;

        if ($request->image != '') {
        $file_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name); //save to path
        }

        $product = Product::find($request->hidden_id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->image = $file_name;

        $product->save();

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $image_path = public_path()."/images/";
        $image = $image_path.$product->image;

        if (file_exists($image)) {
@unlink($image);
        }

        $product->delete();
        return redirect('products')->with('success','Product deleted successfully');
    }
}

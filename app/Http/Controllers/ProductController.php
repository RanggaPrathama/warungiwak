<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')->get();
       return view('Admin.product.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = DB::table('kategoris')->get();
        return view('Admin.product.create',['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required',
            'stok' => 'required',
            'gambar_product' => 'required',
            'id_kategori' => 'required',
        ]);

        if($request->hasFile('gambar_product')){
            $file = $request->file('gambar_product');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move(public_path('product'),$nama_file);
            $validatedData["gambar_product"] = $nama_file;
        }

        $product = DB::table('products')->insert($validatedData);
        if($product){
            return redirect()->route('product.index')->with('success','Product Added has been successfully');
        }else{
            return redirect()->route('product.index')->with('error','Product Added has been failed');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoris = DB::table('kategoris')->get();
        $products = DB::table('products')->where('id_product','=',$id)->first();
        return view('Admin.product.update',['products' => $products, 'kategoris' => $kategoris]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required',
            'stok' => 'required',
            'gambar_product' => 'required',
            'id_kategori' => 'required',
        ]);

        $products = DB::table('products')->where('id_product', $id)->first();
        if($request->hasFile('gambar_product')){
            if($products){
                File::delete(public_path('product').'/'.$products->gambar_product);
                $file = $request->file('gambar_product');
                $nama_file = time()."_".$file->getClientOriginalName();
                $file->move(public_path('product'),$nama_file);
                $validatedData["gambar_product"] = $nama_file;
            }else{
                return redirect()->route('product.index')->with('error','Product Added has been failed');
            }
        }

        $product = DB::table('products')->where('id_product', $id)->update($validatedData);
        if($product){
            return redirect()->route('product.index')->with('success','Product Updated has been successfully');
        }else{
            return redirect()->route('product.index')->with('error','Product Updated has been failed');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $products = DB::table('products')->where('id_product', $id)->first();
        if($products){
            File::delete(public_path('product/'),$products->gambar_product);
            $product = DB::table('products')->where('id_product', $id)->delete();
            if($product){
                return redirect()->route('product.index')->with('success','Product Deleted has been successfully');
            }else{
                return redirect()->route('product.index')->with('error','Product Deleted has been failed');
            }
        }else{
            return redirect()->route('product.index')->with('error','Product Deleted has been failed');
        }
    }
}

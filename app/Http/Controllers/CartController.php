<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Http\Requests\StorecartRequest;
use App\Http\Requests\UpdatecartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $carts = DB::table('carts')
                ->select('products.id_product','carts.quantity','products.gambar_product','products.nama_product','products.harga_product')
                ->join('products','products.id_product','=','carts.id_product')
                ->where('id_user','=',$id)
                ->get();
        $payments = DB::table('payments')->get();
        return view('user.pesan',['carts'=>$carts,'payments'=> $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_product = $request->id_product;
       $id_user = auth()->user()->id_user;
       $quantity = $request->quantity;

       $cekcarts = DB::table('carts')->where('id_product','=', $id_product)->where('id_user','=',$id_user)->first();
        if($cekcarts){
            $carts = DB::table('carts')->where('id_product','=', $id_product)->where('id_user','=',$id_user)->update([
                'quantity' => $quantity + $cekcarts->quantity
            ]);
            return response()->json(['success' => 'Product added to cart successfully!']);
        }

       $carts = DB::table('carts')->insert([
        'id_product' => $id_product,
        'id_user' => $id_user,
        'quantity' => $quantity,
       ]);

       return response()->json(['success' => 'Product added to cart successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecartRequest $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function homeUser(){
        return view('user.homePage');
    }

    public function homeAdmin(){

    }

    public function katalog(){
        $kategoris = DB::table('kategoris')->get();
        return view('user.katalog',['kategoris'=>$kategoris]);
    }

    public function getProduct(Request $request){
        $idkategori = $request->query('idkategori');
        $products = DB::table('products')->where('id_kategori',$idkategori)->get();
        return response()->json(['products' => $products]);

    }
}

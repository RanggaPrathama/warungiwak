<?php

namespace App\Http\Controllers;

use App\Models\pemesanan;
use App\Http\Requests\StorepemesananRequest;
use App\Http\Requests\UpdatepemesananRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            DB::beginTransaction();


            $validatedData = $request->validate([
                'totalHarga' => 'required|numeric',
                'dataCart' => 'required',
                'id_payment' => 'required'
            ]);


            $userId = auth()->user()->id_user;
            $totalHarga = $validatedData['totalHarga'];
            $dataCart = json_decode($validatedData['dataCart'], true);
            $idPayment =$request->id_payment;


            $orderId = DB::table('pemesanans')->insertGetId([
                'id_user' => $userId,
                'total_nilai' => $totalHarga,
                'id_payment' =>$idPayment,
                'created_at' => now(),
                'status' => 0
            ]);


            foreach ($dataCart as $item) {
                DB::table('detail_pemesanans')->insert([
                    'id_pemesanan' => $orderId,
                    'id_product' => $item['id_product'],
                    'quantity' => $item['quantity'],
                    'harga_product' => $item['harga_product'],
                    'created_at' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'data' => $orderId]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan order: ' . $e->getMessage()]);
        }
    }

    public function transaksi(){
        $transaksis = DB::table('pemesanans')
                        ->join('users','users.id_user','=','pemesanans.id_user')
                        ->get();
        return view('Admin.transaksi.index',['transaksis'=>$transaksis]);
    }
    /**
     * Display the specified resource.
     */
    public function show(pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepemesananRequest $request, pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemesanan $pemesanan)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = DB::table('payments')->get();
        return view('Admin.payment.index',['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_rekening' => 'required',
            'atas_nama' => 'required',
            'nama_bank' => 'required',
            'gambar_payment' => 'required|mimes:png,jpg',
            'created_at'=> now()
        ]);

        if($request->hasFile('gambar_payment')){
            $file = $request->file('gambar_payment');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move(public_path('payment'),$nama_file);
            $validatedData["gambar_payment"] = $nama_file;
        }

        $payments = DB::table('payments')->insert($validatedData);
        if($payments){
            return redirect()->route('payment.index')->with('success','Payment has been successfully added');
        }else{
            return redirect()->route('payment.index')->with('error','Payment failed to be added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payments = DB::table('payments')->where('id_payment','=',$id)->first();
        return view('Admin.payment.update',['payments' => $payments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_rekening' =>'required',
            'atas_nama' =>'required',
            'nama_bank' =>'required',
            'gambar_payment' =>'required|mimes:png,jpg',
            'created_at'=> now()
        ]);

        $payments = DB::table('payments')->where('id_payment','=',$id)->first();
        if($request->hasFile('gambar_payment')){
            if($payments){
                File::delete(public_path('payment').'/'.$payments->gambar_payment);
                $file = $request->file('gambar_payment');
                $nama_file = time()."_".$file->getClientOriginalName();
                $file->move(public_path('payment'),$nama_file);
                $validatedData["gambar_payment"] = $nama_file;
            }else{
                return redirect()->route('payment.index')->with('error','Payment failed to be updated');
            }

        }

        $payments = DB::table('payments')->where('id_payment','=',$id)->update($validatedData);
        if($payments){
            return redirect()->route('payment.index')->with('success','Payment has been successfully updated');
        }else{
            return redirect()->route('payment.index')->with('error','Payment failed to be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payments = DB::table('payments')->where('id_payment','=',$id)->first();
        if($payments){
            File::delete(public_path('payment/'),$payments->gambar_payment);
            $payments = DB::table('payments')->where('id_payment','=',$id)->delete();
            if($payments){
                return redirect()->route('payment.index')->with('success','Payment has been successfully deleted');
            }else{
                return redirect()->route('payment.index')->with('error','Payment failed to be deleted');
            }
        }else{
            return redirect()->route('payment.index')->with('error','Payment failed to be deleted');
        }


    }
}

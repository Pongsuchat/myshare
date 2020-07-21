<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Tripprice_travel;

class TravelpriceController extends Controller
{
    public function travelprice(Request $request)
    {
        $pricerate = DB::table('tripprice_travel')->where('data','myshare')->first();
        return view('menu.travel_price',[
            
            'pricerate' => $pricerate
            
        
        ]);
    }

    public function tripprice(Request $request)
    {
        $request->validate([
            'priceRate' => 'required|numeric',
            
        ]);
        $data = [
            'priceRate' => $request->post('priceRate'),
            'data' => 'myshare' //สร้างสำหรับ update DB และ Get data
            
        ];
       
     
        //  $pricerate =  DB::table('tripprice_travel')->insert([ 'priceRate' => $request->post('priceRate')]);
        $pricerate_update = DB::table('tripprice')->where('data','myshare')->update($data);
        if ($pricerate_update) {
            
        }else {
            $pricerate =  DB::table('tripprice')->insert($data);
        }
       
        return redirect('tripprice');
    }

    
}

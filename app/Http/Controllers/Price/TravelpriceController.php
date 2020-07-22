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

        $data = array();
        $data_rate = [
            'priceRate' => $request->post('priceRate'),
            'deposit' => 'null',
            'startedPrice' => 'null',
            'priceByStartTime' => 'null',
        ];
       
        $data = [
            'travel' => $data_rate,
        ];
       
        // echo "<pre>";
        // print_r(json_encode( $data));
        // echo "</pre>";
        // die;
        //  $pricerate =  DB::table('tripprice_travel')->insert([ 'priceRate' => $request->post('priceRate')]);
        $pricerate_getid = DB::table('tripprice')->first();
        dd($pricerate_getid['_id']);
        die;

        $pricerate_update = DB::table('tripprice')->where('_id',$pricerate_getid['_id'])->update(json_encode( $data));
        if ($pricerate_update) {
            
        }else {
            $pricerate =  DB::table('tripprice')->insert($data);
        }
       
        return redirect('tripprice');
    }

    
}

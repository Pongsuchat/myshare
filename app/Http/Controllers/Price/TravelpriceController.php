<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Tripprice_travel;
use App\Tripprice;
class TravelpriceController extends Controller
{
    public function travelprice(Request $request)
    {
        
        $tripprice = Tripprice::get();

        if ($tripprice->first()) {

            $data = $tripprice->first();
        
            return view('menu.travel_price',[
                
                'pricerate' =>$data['travel']['priceRate']
                
            ]);
            
        }else {
            return view('menu.travel_price');
        }
        
      
        
        
    }

    public function tripprice(Request $request)
    {
        $request->validate([
            'priceRate' => 'required|numeric',
            
            
        ]);

        $data_rate = array(
            'priceRate' => $request->post('priceRate'),
            'deposit' => 'null',
            'startedPrice' => 'null',
            'priceByStartTime' => 'null',
        );
        $travel=array('travel' =>  $data_rate ,);//'deliver'=>$data_rate);

        $pricerate_getid = DB::table('tripprice')->first();
        
        if ($pricerate_getid) {

            $tripprice_update = DB::table('tripprice')
            ->where('_id',$pricerate_getid['_id'])
            ->update($travel);

        }else {
              
            $tripprice = new  Tripprice($travel);//เชื่อมโมเดล
            $tripprice->save();
             
        }
        return redirect('travelprice');
    }


    
}

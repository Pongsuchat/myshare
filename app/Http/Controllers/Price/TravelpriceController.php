<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use DB,Validator;
use App\Tripprice_travel;
use App\Tripprice;
class TravelpriceController extends Controller
{
    public function travelprice(Request $request)
    {
        
        $tripprice = Tripprice::get();

        if ($tripprice->first()) {

            $data = $tripprice->first();

            // dd($data);
            // die;
            $priceRate = null;
            $deposit = null; 
            $priceByStartTime = null;
            if(array_key_exists('priceRate',$data['travel'])){
                $priceRate =  $data['travel']['priceRate'];
            }

            if(array_key_exists('deposit',$data['travel'])){
                $deposit =  $data['travel']['deposit'];
            }

            if(array_key_exists('priceByStartTime',$data['travel'])){
                $priceByStartTime =  $data['travel']['priceByStartTime'];
            }
            
            // $data = [
            //     'priceRate' =>$priceRate,
            //     'deposit' =>$deposit,
            //     'priceByStartTime' => $priceByStartTime
            // ];

            // dd($data);
            // die;
        
            // return view('menu.travel_price',[
            //     'data'=>$data
            // ]);
            return view('menu.travel_price',[
                
                'priceRate' =>$priceRate,
                
                'deposit' =>$deposit,
                
                'priceByStartTime' => $priceByStartTime
                
            ]);

            
        }else {
            return view('menu.travel_price');
        }
        
      
        
        
    }

    public function tripprice(Request $request)
    {
        
        // dd($request->all());
        // if($request->input('confirm_pricerate')){

        // }
        // die;
        // $validate = $request->validate([
        //     'priceRate' => 'required|numeric|min:1',

        // ]);
        $validate = Validator::make($request->all(),$this->rules(),$this->messages())->validate();

        // if($validate->fails()===true){
        //     // dd($validate->errors());
        //     return $validate->errors();
        // }
        $data_rate = [
            'priceRate' => $request->input('priceRate'),
            'deposit' => $request->input('deposit'),
            'priceByStartTime' => $request->input('priceByStartTime'),
        ];
        // $data_rate = [];
        // if($request->input('confirm_pricerate')){
        //     // $data_rate = array(

        //     //     'priceRate' => $request->input('priceRate'),
                
        //     // );
        //     // $data_rate = array();
        //     array_push($data_rate,['priceRate' => $request->input('priceRate')]);

        // }elseif ($request->input('confirm_deposit')) {
        //     // $data_rate = array(

        //     //     'deposit' => $request->input('deposit'),
                
        //     // );
        //     array_push($data_rate,['deposit' => $request->input('deposit')]);
        // }
        // elseif ($request->input('confirm_priceByStartTime')) {
        //     $data_rate = array(

        //         'priceByStartTime' => $request->input('priceByStartTime'),
    
        //     );
        //     array_push($data_rate,['priceByStartTime' => $request->input('priceByStartTime')]);
        // }
    
        $travel=array('travel' =>  $data_rate ,);//'deliver'=>$data_rate);
        // dd($travel);
        // die;
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

    public function rules()
    {
        return [
            'priceRate' => 'nullable|numeric|min:1',
            'deposit' => 'nullable|numeric|min:0',
            'priceByStartTime' => 'nullable|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            // 'priceRate.required' => 'กรุณากรอกข้อมูล',
            'priceRate.numeric' => 'กรุณากรอกตัวเลขเท่านั้น',
            'priceRate.min' => 'กรุณากรอกตัวเลขมากกว่า 0 ขึ้นไป',

            // 'deposit.required' => 'กรุณากรอกข้อมูล',
            'deposit.numeric' => 'กรุณากรอกตัวเลขเท่านั้น',
            'deposit.min' => 'กรุณากรอกตัวเลขตั้งแต่ 0 ขึ้นไป',

            // 'priceByStartTime.required' => 'กรุณากรอกข้อมูล',
            'priceByStartTime.numeric' => 'กรุณากรอกตัวเลขเท่านั้น',
            'priceByStartTime.min' => 'กรุณากรอกตัวเลขมากกว่า 0 ขึ้นไป',
        ];
    }

    
}

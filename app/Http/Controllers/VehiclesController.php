<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VehiclesController extends Controller
{
    public function updatestatus(Request $request)
    {
        
        $id = $request->input('id');
        $status = $request->input('status');
        
        $data = [
           
            'status' => $status,
            'approveDate' => date("Y-m-dTH:i:s\Z"),
        ];

        $vehicles = DB::table('vehicles')->where('_id',$id)->update($data);
        
            return redirect('dashboard');
        
        
    }
}

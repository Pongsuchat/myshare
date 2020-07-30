@extends('layout')
@include('header')
@section('content')

<div class="row" style="height: 90vh;">

  <div class="col-md-2">
    @include('leftmenu')
  </div>

@php
    // dd($pricerate);
    // die;
    // foreach (  $pricerate as $key => $value) {
    //     echo $key,"=",$value,"<br>";
    // }
    // die;
    // echo $errors->first('priceRate');
    // echo $priceByStartTime;
    $message_deposit = 'ยังไม่กำหนดเรทราคา';
    $message_priceRate = 'ยังไม่กำหนดเรทราคา';
    $message_priceByStartTime = 'ยังไม่กำหนดเรทราคา';
    $_priceRate = $priceRate;
    $_priceByStartTime = $priceByStartTime;
    $_deposit = $deposit;
    // if ($priceRate!=null || $priceRate>0){
    //   $message_priceRate = $priceRate;
    //   $_priceRate =  $priceRate;
    // }elseif ($deposit!=null) {
    //   $message_deposit = $deposit;
    //   $_deposit =  $deposit;
    // }elseif ($priceByStartTime!=null) {
    //   $message_priceByStartTime = $priceByStartTime;
    //   $_priceByStartTime =  $priceByStartTime;
    // }
@endphp
  
  <div class="col-md-10 shadow p-3  rounded">

    <nav class="navbar navbar-light shadow " style="background-color: #b8e8ee;margin-bottom: 1em;">
      <a class="navbar-brand">แก้ไขเรทราคาของ Trip ทั้งหมด</a>
    </nav>


    <div class="price-rate-card bg-light">
      <div class="card-body text-center">
         
        <p class="price-rate-title">เรทราคา Trip เดินทาง</p>
        
        <div class="">
         <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              <a>เรทราคาค่ามัดจำของ Trip </a>
            </div>
            <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="deposit" name="deposit" placeholder="เรทราคาของทริปที่ต้องการแก้ไข" value="{{$_deposit}}">
              @if ($errors->first('deposit'))
              <span>{{$errors->first('deposit')}}</span>
              @endif
            </div>
            {{-- <button type="submit" class="btn btn-primary mb-2" name="confirm_deposit" value="confirm_deposit">ยืนยัน</button> --}}
            
            
            <div class="form-group mb-2">
              <a>เรทราคาของต่อ 1 กิโลเมตรของ Trip </a>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข"  value="{{$_priceRate}}">
              @if ($errors->first('priceRate'))
              <span>{{$errors->first('priceRate')}}</span>
              @endif
            </div>
            {{-- <button type="submit" class="btn btn-primary mb-2" name="confirm_pricerate" value="confirm_pricerate">ยืนยัน</button> --}}


            <div class="form-group mb-2">
              <a>เรทราคาสำหรับการขึ้นรถหลังเวลา 22.00น.ของ Trip </a>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" id="priceByStartTime" name="priceByStartTime" placeholder="เรทราคาของทริปที่ต้องการแก้ไข"  value="{{$_priceByStartTime}}">
              @if ($errors->first('priceByStartTime'))
              <span>{{$errors->first('priceByStartTime')}}</span>
              @endif
            </div>
            {{-- <button type="submit" class="btn btn-primary mb-2" name="confirm_priceByStartTime" value="confirm_priceByStartTime">ยืนยัน</button> --}}

            

            <button type="submit" class="btn btn-primary mb-2" >ยืนยัน</button>
        
           </form>
        </div>
   
    
      </div>
    </div>
    
</div>




</div>

@endsection
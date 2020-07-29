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
              @if (!empty($pricerate))
              <a>เรทราคาของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>เรทราคาของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
        <div class="">
          <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              @if (!empty($pricerate))
              <a>เรทราคาค่ามัดจำของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>เรทราคาค่ามัดจำของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
        <div class="">
          <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              @if (!empty($pricerate))
              <a>ราคาเริ่่มต้นหลังสี่ทุ่มของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>ราคาเริ่่มต้นหลังสี่ทุ่มของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
      </div>
    </div>

    <div class="price-rate-card bg-light" style="margin-top: 20px;">
      <div class="card-body text-center">
        <p class="price-rate-title">เรทราคา Trip ส่งของ</p>
        <div class="">
          <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              @if (!empty($pricerate))
              <a>เรทราคาของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>เรทราคาของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
        <div class="">
          <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              @if (!empty($pricerate))
              <a>เรทราคาค่ามัดจำของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>เรทราคาค่ามัดจำของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
        <div class="">
          <form class="form-inline" style="margin-bottom: 5px !important;" method="POST" action="{{url('/tripprice')}}">
            {{csrf_field()}}
            <div class="form-group mb-2">
              @if (!empty($pricerate))
              <a>ราคาเริ่่มต้นหลังสี่ทุ่มของ Trip ปัจจุบัน = {{$pricerate}} ต่อระยะทาง 1 กิโลเมตร</a>
                
            @else
            <a>ราคาเริ่่มต้นหลังสี่ทุ่มของ Trip ปัจจุบัน = ยังไม่กำหนดเรทราคา ต่อระยะทาง 1 กิโลเมตร</a>
            @endif
            
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
          </form>
        </div>
    
      </div>
    </div>
    
</div>




</div>

@endsection
@extends('layout')
@include('header')
@section('content')

<div class="row" style="height: 90vh;">

  <div class="col-md-2">
    @include('leftmenu')
  </div>
{{-- 
@php
    dd($vehicles_detail);
    die;
@endphp --}}
  
  <div class="col-md-10 shadow p-3  rounded">

    <nav class="navbar navbar-light shadow " style="background-color: #b8e8ee;margin-bottom: 1em;">
      <a class="navbar-brand">ข้อมูลผู้ใช้งาน</a>
    </nav>

    <div class="contrainer">
      <form class="form-inline" method="POST" action="{{url('/tripprice')}}">
        {{csrf_field()}}
        <div class="form-group mb-2">
          {{-- <label for="staticEmail2" class="sr-only">เรทราคาปัจจุบัน : 96</label>
          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="เรทราคาปัจจุบัน : 96"> --}}
          <a>เรทราคาของ Trip ปัจจุบัน = {{$pricerate['priceRate']}} ต่อระยะทาง 1 กิโลเมตร</a>
        </div>
        <div class="form-group mx-sm-3 mb-2">
          {{-- <label for="inputPassword2" class="sr-only">เรทราคาของทริปที่ต้องการแก้ไข</label> --}}
          <input type="number" class="form-control" id="priceRate" name="priceRate" placeholder="เรทราคาของทริปที่ต้องการแก้ไข">
        </div>
        <button type="submit" class="btn btn-primary mb-2">ยืนยันการแก้ไข</button>
      </form>
    </div>
</div>


</div>

@endsection
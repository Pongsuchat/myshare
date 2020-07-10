@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')

<div class="row" style="height: 90vh;">

  <div class="col-md-2">
    @include('leftmenu')
  </div>

  <div class="col-md-10 shadow p-3  rounded">

    <nav class="navbar navbar-light " style="background-color: #b8e8ee;margin-bottom: 1em;">
      <a class="navbar-brand">ผู้ใช้งานรอการยืนยันรถ</a>

      
        {{-- <a class="btn btn-warning my-2 my-sm-0" type="submit" href="{{url('waitingforapprove')}}"><i
            class="fa fa-car mr-2" ></i>ผู้ใช้ที่รอการยืนยันรถยนต์</a> --}}
      


    </nav>


  </div>
  <div>
    

  </div>
</div>

@endsection
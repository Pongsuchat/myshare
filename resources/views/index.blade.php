@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')


<div class="row" style="height: 90vh;">

  {{-- @if (isset(Auth::user()->phoneNumber))
        <div class="alert lalert-danger success-block">
          <strong>Welcome {{Auth::user()->user()->userName}}</strong>
</div>
else
<script>
  window.location ="/main";
</script>
@endif --}}


<div class="col-md-2">
  @include('leftmenu')
</div>
<div class="col-md-10 shadow p-3  rounded">

  <nav class="navbar navbar-light " style="background-color: #b8e8ee;margin-bottom: 1em;">
    <a class="navbar-brand">เจ้าหน้าที่</a>

    
      <button class="btn btn-success my-2 my-sm-0 " data-toggle="modal"
        data-target="#exampleModalCenter"><i class="fa fa-user-plus mr-2" aria-hidden="true"></i>เพิ่มผู้ดูแล</button>
    
  </nav>


  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col" class="text-left">ชื่อ-นามสกุล</th>
        <th scope="col" class="text-left">รหัสประเทศ</th>
        <th scope="col" class="text-left">เบอร์ติดต่อ</th>
        <th scope="col" class="text-left">ระดับ</th>

        <th scope="col" class="text-center">การจัดการ</th>
      </tr>
    </thead>


    @foreach($allusers as $data)
    <tbody>
      <tr>
        <td>{{$data->userName}}</td>
        <td>{{$data->countryCode}}</td>
        <td>{{$data->phoneNumber}}</td>
        <td>{{$data->role}}</td>

        <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i>
          <i class="fa fa-trash" aria-hidden="true"></i>
        </td>
      </tr>
    </tbody>
    @endforeach



  </table>
</div>
<div>
  @include('create')
</div>
</div>

@endsection
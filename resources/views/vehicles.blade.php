@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')


<div class="row" style="height: 90vh;">


<div class="col-md-2">
  @include('leftmenu')
  {{-- <a href="{{url('adminview')}}">Link</a> --}}
</div>
<div class="col-md-10 shadow p-3  rounded">

  <nav class="navbar navbar-light " style="background-color: #b8e8ee;margin-bottom: 1em;">
    <a class="navbar-brand">รถยนต์ รอการอนุมัติ</a>

    

  </nav>


  <table class="table" >
    <thead>
      <tr>
        {{-- <th scope="col" class="text-left">ชื่อผู้ใช้งาน</th> --}}
        <th scope="col" class="text-left">รูปโปรไฟล์</th>
        <th scope="col" class="text-left">บัตรประชาชน</th>
        <th scope="col" class="text-left">ใบขับขี่</th>
        <th scope="col" class="text-left">พรบ</th>
        <th scope="col" class="text-left">สถานะรถยนต์</th>
        <th scope="col" class="text-center">การจัดการ</th>
      </tr>
    </thead>
@php
    
@endphp

    @foreach($allvehicles as $data)

    <tbody>
      <tr>

        
        <td><img src="{{asset($data['vehiclePicture'])}}" width="150px" height="150px"></td>
        <td><img src="{{$data->personalCardPicture}}" width="150px" height="150px"></td>
        <td><img src="{{$data->driverLicensePicture}}" width="150px" height="150px"></td>
        <td><img src="{{$data->actPicture}}" width="150px" height="150px"></td>
        <td>{{$data->status}}</td>
        <td>

            <form  method="POST" action="{{url('/updatestatus')}}" >
                {{csrf_field()}}
             <div class="form-group col-md-10">
                <input type="hidden" name="id" value="{{$data->id}}">
                <select id="inputState" class="form-control" name="status">
                  <option selected value="approve">approve</option>
                  <option value="reject">reject</option>
                  <option value="pending">pending</option>
                </select>

                
              </div>
              <div class="col-md-4"><button type="submit" class="btn btn-primary">ยืนยัน</button></div>

            </form>

        </td>


        <td class="layout-text-center">
  
        
          
        </td>
        
      </tr>
    </tbody>
    @endforeach


  </table>
</div>
<div>
  @include('user/createuser')
  
</div>
</div>


@endsection
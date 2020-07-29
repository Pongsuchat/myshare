@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')

<div class="row" style="height: 90vh;">

  <div class="col-md-2">
    @include('leftmenu')
  </div>

  <div class="col-md-10 shadow p-3 rounded ">

    
    <nav class="navbar navbar-light shadow" style="background-color: #b8e8ee;margin-bottom: 1em;">
      <a class="navbar-brand">ผู้ใช้งานทั่วไป</a>


      <a class="btn btn-warning my-2 my-sm-0" type="submit" href="{{url('waitingforapprove')}}"><i
          class="fa fa-car mr-2"></i>ผู้ใช้ที่รอการยืนยันรถยนต์</a>



    </nav>


    <div class=" all-scrolling">
      <div class="card-body">
        <table class="table " id="myTable" style="justify-content: flex-start;">
          <thead>
            <tr>
              <th scope="col" class="text-left">รูปโปรไฟล์</th>
              <th scope="col" class="text-left">ชื่อ-นามสกุล</th>
              <th scope="col" class="text-left">เบอร์ติดต่อ</th>
              {{-- <th scope="col" class="text-left">ระดับ</th> --}}
    
    
              <th scope="col" class="text-center">การจัดการ</th>
            </tr>
          </thead>
    
          <tbody>
    
            @foreach($allusers as $data)
            @php
            $id = $data['_id'];
            @endphp
            <tr>
    
              <td><a data-fancybox="gallery" href="{{$data->userPicture == null ? asset('images/system/nophoto.png'): $data->userPicture}}"><img
                src="{{$data->userPicture == null ? asset('images/system/nophoto.png'): $data->userPicture}}" width="150px" height="100px"></a></td>
              
              <td>{{$data->userName}}</td>
              <td>{{$data->phoneNumber}}</td>
    
    
    
    
              <td class="layout-text-center">
                
                <form method="GET">
                  {{csrf_field()}}
    
                  <a type="submit" href="{{action('AdminviewController@usersdetail',"id=$id")}}">
    
                    <i class="" aria-hidden="true">รายละเอียด</i>
                  </a>
                </form>
    
              </td>
            </tr>
    
    
    
            @endforeach
    
          </tbody>
    
    
        </table>


      </div>
    </div>
  

    
  </div>
  <div>


  </div>
</div>

@endsection
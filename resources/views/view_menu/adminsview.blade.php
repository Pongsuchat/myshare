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
      <a class="navbar-brand">เจ้าหน้าที่</a>


      <button class="btn btn-success my-2 my-sm-0 " data-toggle="modal" data-target="#modalCreateUser"><i
          class="fa fa-user-plus mr-2" aria-hidden="true"></i>เพิ่มผู้ดูแล</button>

    </nav>


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col" class="text-left">รูปโปรไฟล์</th>
          <th scope="col" class="text-left">ชื่อ-นามสกุล</th>
          <th scope="col" class="text-left">เบอร์ติดต่อ</th>
          <th scope="col" class="text-left">ระดับ</th>
          {{-- <th scope="col" class="text-left">สถานะรถยนต์</th> --}}

          <th scope="col" class="text-center">การจัดการ</th>
        </tr>
      </thead>

      <tbody>

        @foreach($allusers as $data)
        <tr>

          <td><img src="{{$data->userPicture}}" width="80px" height="80"></td>
          <td>{{$data->userName}}</td>
          <td>{{$data->phoneNumber}}</td>
          <td>{{$data->role}}</td>



          <td class="layout-text-center">

            {{-- <form method="GET" >
              {{csrf_field()}}
              <a  type="submit" href="{{action('AdminviewController@detailuser',$data['id'])}}">
                <i class="fa fa-info mr-4 btn btn-outline-primary" aria-hidden="true"></i>
              </a>
            </form> --}}

          </td>
        </tr>

      </form>


        @endforeach

      </tbody>


    </table>
  </div>
  <div>
    @include('adminusers/createuser')

  </div>
</div>

@endsection
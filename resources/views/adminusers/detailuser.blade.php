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

    <div class="container">
      <div class="row">
        <div class="col-3">

          
          <div class="card" style="width: 100%; height: 100%;">
                @if (!empty($user_detail['userPicture']))
                  <a class="card-img-top" data-fancybox="gallery" href="{{$user_detail['userPicture']}}" style="height: 250px;"><img
                    src="{{$user_detail['userPicture']}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                @else
                  <a class="card-img-top" data-fancybox="gallery" href="{{asset('images/system/nophoto.png')}}"><img
                  src="{{asset('images/system/nophoto.png')}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                @endif

                {{-- {{$user_detail->userPicture == null ? asset('images/system/nophoto.png'): $user_detail->userPicture}} --}}
          </div>

        </div>
        <div class="col-sm">
          <h5>User Name: {{$user_detail['userName']}}</h5>
          <h5>เบอร์โทรศัพท์ : {{$user_detail['phoneNumber']}}</h5>
          <h5>เป็นสมาชิกตั้งแต่ : {{$user_detail['created']}}</h5>
          <h5>การยืนยันรถ : {{$user_detail['status']}}</h5>
          <h5>จำนวนรถ : {{$vehicles_detail->count()}} คัน</h5>
        </div>

        <div class="col-sm">
          

          <div class="container">
  <div class="row align-items-start">
    <div class="col">
      <div class="card" style="width: 80%; height: 50%;">
               @if (!empty($vehicles_detail[0]['personalCardPicture']))
                 <a class="card-img-top" data-fancybox="gallery" href="{{$vehicles_detail[0]['personalCardPicture']}}" style=""><img
                   src="{{$vehicles_detail[0]['personalCardPicture']}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                   <span>บัตรประชาชน</span>
               @else
                 <a class="card-img-top" data-fancybox="gallery" href="{{asset('images/system/nophoto.png')}}"><img
                 src="{{asset('images/system/nophoto.png')}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                 <span>บัตรประชาชน</span>
               @endif
   </div>
 </div>
    
    <div class="col">
       <div class="card" style="width: 80%; height: 50%;">
                @if (!empty($vehicles_detail[0]['driverLicensePicture']))
                  <a class="card-img-top" data-fancybox="gallery" href="{{$vehicles_detail[0]['driverLicensePicture']}}" style=""><img
                    src="{{$vehicles_detail[0]['driverLicensePicture']}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                    <span>ใบขับขี่</span>
                @else
                  <a class="card-img-top" data-fancybox="gallery" href="{{asset('images/system/nophoto.png')}}"><img
                  src="{{asset('images/system/nophoto.png')}}" style="width: 100%; max-width: 100%; max-height: 100%; object-fit: contain;"></a>
                  <span>ใบขับขี่</span>
                @endif
    </div>
  </div>
  
 
</div>
        </div>
      </div>
    </div>

    <div class="" style="margin-top: 1cm">
      <h2>ข้อมูลรถ</h2>
    </div>

    <table class="table shadow" id="myTable">
      <thead>
        <tr>
          {{-- <th scope="col" class="text-left">รถคันที่</th> --}}
          <th scope="col" class="text-left">รูปโปรไฟล์รถ</th>
          <th scope="col" class="text-left">ทะเบียนรถ</th>
          <th scope="col" class="text-left">ประกันรถ</th>
          <th scope="col" class="text-left">พรบ</th>
          <th scope="col" class="text-left">สถนานะ</th>
          <th scope="col" class="text-left">อนุมัติการยืนยันรถ</th>
        </tr>
      </thead>

      <tbody>

        @foreach($vehicles_detail as $data)
        @php
        $id = $data['_id'];
        $status = $data['status'];
        @endphp
        <tr>
          {{-- <td>1</td> --}}
          <td><a  data-fancybox="gallery" href="{{$data['vehiclePicture']}}"><img src="{{$data['vehiclePicture']}}"
                width="150px" height="100px"></a></td>
          <td><a data-fancybox="gallery" href="{{$data['registrationPicture']}}"><img
                src="{{$data['registrationPicture']}}" width="150px" height="100px"></a></td>
          <td><a data-fancybox="gallery" href="{{$data['insurancePicture']}}"><img src="{{$data['insurancePicture']}}"
                width="150px" height="100px"></a></td>
          <td><a data-fancybox="gallery" href="{{$data['actPicture']}}"><img src="{{$data['actPicture']}}" width="150px"
                height="100px"></a></td>
          <td>
            
          

            @if ($status=='pending')
              <h3 class="text-warning">{{$status}}</h3>
            
            @elseif ($status=='approve')
              <h3 class="text-success">{{$status}}</h3>
                
             
            @elseif ($status=='reject')
              <h3 class="text-danger">{{$status}}</h3>
               
             
             
            @endif
           
            
          
      
          </td>
          <td>

            <form  method="POST" action="{{url('/updatestatus')}}" >
                {{csrf_field()}}
             <div class="form-group col-md-20">
                <input type="hidden" name="vehicle_id" value="{{$id}}">
                <input type="hidden" name="user_id" value="{{$user_detail['_id']}}">
                <select id="inputState" class="form-control" name="status">
                  <option selected value="approve">approve</option>
                  <option value="reject">reject</option>
                  <option value="pending">pending</option>
                </select>

                
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary">ยืนยัน</button></div>

            </form>

        </td>

        {{-- <td>

          <form  method="POST" action="{{url('/updatestatus')}}" >
              {{csrf_field()}}
           <div class="form-group col-md-10">
              <input type="hidden" name="id" value="{{$id}}">
              <select id="inputState" class="form-control" name="status">
                <option selected value="approve">approve</option>
                <option value="reject">reject</option>
                <option value="pending">pending</option>
              </select>

              
            </div>
            <div class="col-md-4"><button type="submit" class="btn btn-primary">ยืนยัน</button></div>

          </form>

      </td> --}}


          @endforeach
      </tbody>


    </table>

  </div>
</div>







</div>

@endsection
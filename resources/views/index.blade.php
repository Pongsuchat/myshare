

@extends('layout')
{{-- เลือกแม่แบบ --}} 
@include('header')
@section('content')


<div class="row" style="height: 90vh;">
    <div class="col-md-2">
        @include('leftmenu')
    </div>
    <div class="col-md-10 shadow p-3  rounded">

        <nav  class="navbar navbar-light " style="background-color: #b8e8ee;margin-bottom: 1em;">
            <a class="navbar-brand">เจ้าหน้าที่</a>
            
            <form class="form-inline">
              <button class="btn btn-success my-2 my-sm-0 " type="submit"><i class="fa fa-user-plus mr-2" aria-hidden="true"></i>เพิ่มผู้ดูแล</button>
            </form>
          </nav>


        <table class="table" id="myTable">
            <thead>
              <tr>
                <th scope="col" class="text-left">ชื่อ-นามสกุล</th>
                <th scope="col" class="text-left">Email</th>
                <th scope="col" class="text-left">เบอร์ติดต่อ</th>
                <th scope="col" class="text-left">ระดับ</th>
                <th scope="col" class="text-center">การจัดการ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                
                <td>Mark Samata</td>
                <td>mark@mandala.co.th</td>
                <td>0865471256</td>
                <td>admin</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <tr>
                
                <td>Jirawat Chaiyawong</td>
                <td>jirawat@mandala.co.th</td>
                <td>0854712459</td>
                <td>staff</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <tr>
                
                <td>Suporn Chanachan</td>
                <td>suporn@mandala.co.th</td>
                <td>0896574563</td>
                <td>admin</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <tr>
                
                <td>Jirawat Chaiyawong</td>
                <td>jirawat@mandala.co.th</td>
                <td>0854712459</td>
                <td>staff</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <tr>
                
                <td>Mark Samata</td>
                <td>mark@mandala.co.th</td>
                <td>0865471256</td>
                <td>admin</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <tr>
                
                <td>Suporn Chanachan</td>
                <td>suporn@mandala.co.th</td>
                <td>0896574563</td>
                <td>admin</td>
                <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              <td>Suporn Chanachan</td>
              <td>suporn@mandala.co.th</td>
              <td>0896574563</td>
              <td>admin</td>
              <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
            </tr>
            <td>Suporn Chanachan</td>
            <td>suporn@mandala.co.th</td>
            <td>0896574563</td>
            <td>admin</td>
            <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
          </tr>
          <td>Suporn Chanachan</td>
          <td>suporn@mandala.co.th</td>
          <td>0896574563</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        <tr>
                
          <td>Mark Samata</td>
          <td>mark@mandala.co.th</td>
          <td>0865471256</td>
          <td>admin</td>
          <td class="layout-text-center"><i class="fa fa-pencil mr-4" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
        </tr>
        
            </tbody>
          </table>
    </div>
</div>

@endsection


@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')

<div class="row" style="height: 90vh;">

  <div class="col-md-2">
    @include('leftmenu')
  </div>

  <div class="col-md-10 shadow p-3  rounded">

    <div>
      <img src="{{$user_detail['userPicture']}}" width="80px" height="80">
    </div>

  </div>
</div>

@endsection
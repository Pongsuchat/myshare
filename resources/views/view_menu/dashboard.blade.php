@extends('layout')
{{-- เลือกแม่แบบ --}}
@include('header')
@section('content')

@php
    $sesstion = session()->get('user');
   
@endphp
<div class="row" style="height: 90vh;">


<div class="col-md-2">
  @include('leftmenu')
 
</div>
<div class="col-md-10 shadow p-3  rounded">

  <h1>inprogress</h1>
</div>


@endsection


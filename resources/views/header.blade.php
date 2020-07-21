{{-- @php
dd(session()->get('user'));
die;
@endphp --}}

<nav class="navbar navbar-light shadow p-3 mb-3  rounded" style="background-color: #6bbdf8;">
  <a class="navbar-brand txt-header" href="{{url('dashboard')}}">MyShare</a> 
  {{-- Username : {{session()->get('user')['username']}} --}}
  <a>{{session()->get('user')['username']}}</a>
  
  <form class="form-inline layout-al-center">
    <a href="{{url('/logout')}}" class="btn btn-danger my-2 my-sm-0" type="submit"><i class="fa fa-sign-out mr-2" aria-hidden="true" ></i>ออกจากระบบ</a>
    
  </form>
</nav>

<nav class="navbar navbar-light shadow p-3 mb-3  rounded" style="background-color: #6bbdf8;">
  <a class="navbar-brand txt-header">MyShare</a>
  
  <form class="form-inline layout-al-center">
    @if (isset(Auth::user()->phoneNumber))
    <a class="mr-4">{{Auth::user()->userName}}</a>
    @endif
    <a href="{{url('/logout')}}" class="btn btn-danger my-2 my-sm-0" type="submit"><i class="fa fa-sign-out mr-2" aria-hidden="true" ></i>ออกจากระบบ</a>
    
  </form>
</nav>

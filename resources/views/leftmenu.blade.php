<div style="height: 100%;background-color: #28252c;" class="shadow-lg p-3  rounded">

  <div class="accordion   rounded" id="accordionExample">
    <div class="" style="width: 100% !important;">
      <div class="" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link-left btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-user-o" aria-hidden="true" style="margin-right: 5px;"></i>
            จัดการผู้ใช้งาน
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="ml-4" style="display: flex; flex-direction: row;align-items: center;">
            <i class="fa fa-user-circle" aria-hidden="true" style="color: #fff;"></i>
            <a class="dropdown-item-left" href="{{url('adminuser')}}" >ผู้ดูแลระบบ</a>
        </div>
        <div class="ml-4" style="display: flex; flex-direction: row;align-items: center;">
          <i class="fa fa-users" aria-hidden="true" style="color: #fff;"></i>
          <a class="dropdown-item-left" href="{{url('narmoluser')}}" >ผู้ใช้งานทั่วไป</a>
        </div>
        
      </div>
    </div>

    <div class="" style="width: 100% !important;">
      <div class="" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link-left btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           
            <i class="fa fa-globe" aria-hidden="true" style="margin-right: 5px;"></i>
            จัดการทริป
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="">
          <a class="dropdown-item-left" href="{{url('dashboard')}}" >dashboard</a>
                </div>
                <div class="ml-4" style="display: flex; flex-direction: row;align-items: center;">
                  <i class="fa fa-map-marker" aria-hidden="true" style="color: #fff;"></i>
                  <a class="dropdown-item-left" href="{{url('travelprice')}}" >แก้ไขราคา Trip</a>
                </div>
      </div>
    </div>

    
    
  </div>
</div>
        
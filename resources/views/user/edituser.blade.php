{{-- 
  <div class="container">
    @if ($error->all())
    <ul>
      @foreach ($errors->all() as $error)
          <li>
            {{$error}}
          </li>
      @endforeach
  </ul>
    @endif
  </div> --}}
  
  
  <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลผู้ดูแลระบบ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('users')}}">

                {{csrf_field()}}

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control " name="userName" placeholder="ชื่อ - นามสกุล" value="" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationServer02">รหัสประเทศ</label>
                    <input type="text" class="form-control " name="countryCode" placeholder="รหัสประเทศ" value="" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="validationServerUsername">เบอร์โทรศัพท์</label>
                    <div class="input-group">
                      <input type="text" class="form-control " name="phoneNumber" placeholder="เบอร์โทรศัพท์" value="" required>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationServer03">Passwod</label>
                    <input type="text" class="form-control " name="password" placeholder="รหัสผ่าน" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationServer04">ระดับ</label>
                    <input type="text" class="form-control " name="role" placeholder="ระดับ" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationServer05">รูปบัตรประชาชน</label>
                    <input type="text" class="form-control " name="personalPicture" placeholder="เพิ่มไฟล์" >
                  </div>
                </div>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="ยืนยันการแก้ไข"/> 
          
        </div>
    </form>
      </div>
    </div>
  </div>
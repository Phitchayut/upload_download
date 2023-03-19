<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<!-- Modal -->
<div class="modal fade" id="upload_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
      </div>
      <div class="modal-body">
        <form action="../../backend/insert.php" method="post" id="form_upload" enctype="multipart/form-data">
          <div class="mb-2" id="check_docname"></div>
          <div class="form-outline mb-4">
            <input type="text" id="doc_name" name="doc_name" class="form-control" required />
            <label class="form-label" for="doc_name">กรอกชื่อเอกสาร</label>
          </div>
          <!-- post hidden -->
          <input type="hidden" name="user_id" value="<?=  $rowrole['id'] ?>">
          <input type="hidden" name="username" value="<?=  $rowrole['username'] ?>">
          <input type="hidden" name="user_email" value="<?=  $rowrole['email'] ?>">
          <input type="hidden" name="role" value="<?=  $rowrole['role'] ?>">


          <input type="file" name="doc_file" class="form-control" id="doc_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.pdf" required />
          <div class="form-check mt-4">
            <input class="form-check-input" name="status_input" type="checkbox" value="1" id="status_input" />
            <label class="form-check-label" for="status_input">เลือกว่าให้กรอกข้อมูลหรือไม่!</label>
          </div>
          <div class="mt-4" id="shw_header_img" style="display: none;">
            <input type="file" name="header_img" class="form-control" id="header_img" accept="image/*" />
            <label class="form-label text-danger" for="header_img">*เพิ่มรูปภาพ</label>
          </div>
          <hr>
          <div class="row">
            <div class="col-6">
              <button type="submit" name="submit" class="btn btn-success w-100">บันทึก</button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-danger w-100" data-mdb-dismiss="modal">ยกเลิก</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

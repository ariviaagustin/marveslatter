<style type="text/css">
  .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable 
  {
    height: 200px;
  }
  .note-editor.note-airframe, .note-editor.note-frame 
  {
    width: 82%;
    margin-left: 1%;
  }
</style>
 
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Menimbang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/tambah_menimbang_aksi'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Menimbang</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" name="ket_menimbang" required autofocus cols="2" rows="2"></textarea>
                          <input type="hidden" name="id_daftar_surat" value="<?php echo $data->id_daftar_surat; ?>">
                      </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <!-- <a href="" class="btn btn-warning">Draft</a> -->
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
<script src="<?php echo site_url(); ?>assets/new/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  
</script>

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
                <h3 class="card-title">Form Edit Surat Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Entry_surat/edit_surat_aksi'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Dari</label>
                      <div class="col-sm-10">
                          <input type="text" name="dari_pengirim" class="form-control" value="<?php echo $data->dari_pengirim; ?>" required>
                          <input type="hidden" name="id_daftar_input" class="form-control" value="<?php echo $data->id_daftar_input; ?>" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kepada</label>
                      <div class="col-sm-10">
                          <input type="text" name="kepada_tujuan" class="form-control" value="<?php echo $data->kepada_tujuan; ?>" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                      <div class="col-sm-10">
                          <input type="text" name="nomor_surat" class="form-control" value="<?php echo $data->nomor_surat; ?>" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Diterima</label>
                      <div class="col-sm-10">
                          <input type="date" name="tanggal_diterima" class="form-control" value="<?php echo $data->tanggal_diterima; ?>" required>
                      </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Yang Menyerahkan</label>
                      <div class="col-sm-10">
                          <input type="text" name="yang_menyerahkan" class="form-control" value="<?php echo $data->yang_menyerahkan; ?>" required>
                      </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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

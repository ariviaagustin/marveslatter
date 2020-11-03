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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Surat Tugas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/surattugas'); ?>">Surat Tugas</a></li>
              <li class="breadcrumb-item active">Tambah Surat Tugas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Surat Tugas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/surattugas_aksi'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required="required" class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <?php foreach ($jenis_surat as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>"><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nomer_sti" placeholder="Nomor Surat" required autofocus>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-md-3"> 
                          <label>Menimbang</label>
                      </div>
                      <div class="col-md-9" id="menimbang_keg">
                          <div class="entry input-group">
                              
                              <textarea class="form-control mb-4" cols="1" rows="2" required name="menimbang[]" placeholder="Menimbang"></textarea>
                              
                              <div class="input-group-btn col-lg-1"> 
                                 <button class="btn btn-success btn-sm btn-add2" type="button"><i class="fa fa-plus"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-md-3"> 
                          <label>Dasar</label>
                      </div>
                      <div class="col-md-9" id="dasar_keg">
                          <div class="entry input-group">
                              
                              <textarea class="form-control mb-4" cols="1" rows="2" required name="dasar[]" placeholder="Dasar"></textarea>
                              
                              <div class="input-group-btn col-lg-1"> 
                                 <button class="btn btn-success btn-sm btn-adddasar" type="button"><i class="fa fa-plus"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kepada (Daftar Penerima Tugas)</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Daftar Penerima Tugas" style="width: 100%;" name="yang_diberi_tugas[]" required>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Mulai Bertugas</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_mulai_bertugas" placeholder="Tanggal Mulai Bertugas" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Selesai Bertugas</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_selesai_bertugas" placeholder="Tanggal Selesai Bertugas" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Bertugas</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="tempat_tugas" placeholder="Tujuan Tempat Bertugas" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Wilayah Tugas</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="tujuan_tugas">
                        <option value="">Pilih Wilayah Tujuan</option>
                        <?php foreach ($wilayah as $key) { ?>
                          <option value="<?php echo $key->id_kokab; ?>"><?php echo $key->nama_kokab.' - '.$key->nama_provinsi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Maksud Bertugas</label>
                      <div class="col-sm-9">
                          <textarea class="form-control mb-4" cols="1" rows="2" required name="maksud_tugas" placeholder="Maksud Bertugas"></textarea>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat (Penandatanganan)</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_sti" placeholder="Tanggal Surat" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_sti">
                        <option value="">Pilih Penandatangan</option>
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_sti[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <hr>
                  <br>

                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Tugas</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_tugas">
                        <option value="">Pilih Jenis Tugas</option>
                        <?php foreach ($jenis_tugas as $jt) { ?>
                          <option value="<?php echo $jt->id_jenis_tugas; ?>"><?php echo $jt->nama_jenis_tugas; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Moda Transportasi</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="mode_transportasi">
                        <option value="">Pilih Moda Transportasi</option>
                        <?php foreach ($moda as $m) { ?>
                          <option value="<?php echo $m->id_moda; ?>"><?php echo $m->nama_moda; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sumber Pembiayaan</label>
                    <div class="col-sm-9">
                      <input type="text" name="sumber_biaya" placeholder="Sumber Pembiayaan, Contoh : APBN" class="form-control">
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_sti">
                        <option value="">Pilih Klasifikasi Surat</option>
                        <?php foreach ($klasifikasi_surat as $ks) { ?>
                          <option value="<?php echo $ks->id_klasifikasi; ?>"><?php echo $ks->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>      

                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Next <i class="fa fa-arrow-right"></i></button>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })

  $(function () {
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });

  $(function()
  {
    $(document).on('click', '.btn-add2', function(e)
    {
        e.preventDefault();
        var controlForm = $('#menimbang_keg:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add2')
            .removeClass('btn-add2').addClass('btn-remove2')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-trash"></span>');

    }).on('click', '.btn-remove2', function(e)
    {
        e.preventDefault();
        $(this).parents('.entry:first').remove();
        return false;
    });
});

  $(function()
  {
    $(document).on('click', '.btn-adddasar', function(e)
    {
        e.preventDefault();
        var controlForm = $('#dasar_keg:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-adddasar')
            .removeClass('btn-adddasar').addClass('btn-removedasar')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-trash"></span>');

    }).on('click', '.btn-removedasar', function(e)
    {
        e.preventDefault();
        $(this).parents('.entry:first').remove();
        return false;
    });
});

 
</script>

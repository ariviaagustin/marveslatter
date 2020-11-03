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
            <h1>Tambah Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/undangan'); ?>">Undangan</a></li>
              <li class="breadcrumb-item active">Tambah Undangan</li>
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
                <h3 class="card-title">Form Tambah Undangan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/undangan_aksi'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <?php foreach ($jenis_surat as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>"><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No Undangan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nomor_undangan" placeholder="Nomor Undangan" required autofocus>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_undangan">
                        <option selected="selected" value="0">Pilih Penandatangan</option>
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_undangan" placeholder="Perihal Undangan" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Mulai Acara</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_dimulai_acara" placeholder="Tanggal Mulai Acara">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Selesai Acara</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_selesai_acara" placeholder="Tanggal Selesai Bertugas">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jam Mulai Acara</label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" name="jam_dimulai_acara" placeholder="Jam Mulai Acara">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jam Selesai Acara</label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" name="jam_selesai_acara" placeholder="Jam Selesai Bertugas">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lokasi Acara</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="lokasi_acara" placeholder="Lokasi Acara">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="unit_tujuan" id="unit_tujuan" onchange="myFunction()">
                        <option selected="selected" value="0">Pilih Unit Tujuan</option>
                        <option value="1">Perorangan</option>
                        <option value="2">Jabatan</option>
                        <option value="3">Bagian Unit Kerja</option>
                        <option value="4">Unit Kerja</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="display: none;" id="personal">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_undangan[]" multiple="multiple" id="per">
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="jabatan">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_undangan[]" multiple="multiple" id="jab">
                        <?php foreach ($jabatan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="bag_unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_undangan[]" multiple="multiple" id="bag">
                        <?php foreach ($bag_unit as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>"><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_undangan[]" multiple="multiple" id="u">
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>"><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="alamat_tujuan_undangan" placeholder="Alamat Tujuan Undangan">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_undangan[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                        <!--     <?php foreach ($tembusan as $key) { ?>
                            <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_unit_kerja.' - '.$key->nama_jabatan; ?></option>
                          <?php } ?> -->
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_undangan">
                        <option selected="selected">Pilih Klasifikasi</option>
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Undangan</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_undangan" placeholder="Tanggal Undangan">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Undangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_undangan">
                        <option selected="selected">Pilih Sifat</option>
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_undangan" placeholder="Lampiran" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Undangan</label>
                    <div class="col-sm-9">
                      <textarea name="isi_undangan" class="textarea" placeholder="Isi Undangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
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
</script>

<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("unit_tujuan").value;
  if(x == "0")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }

    if(x == "1")
    {
      $("#personal").show() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#per").attr('required',true);
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#jab").attr('required',true);
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
      $("#bag").attr('required',true);
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
      $("#u").attr('required',true);
    }
    return false;
}
</script>

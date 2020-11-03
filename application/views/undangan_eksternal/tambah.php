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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Surat Eksternal - Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Undangan_eksternal/'); ?>">Surat Eksternal - Undangan</a></li>
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Form Tambah Surat Eksternal - Undangan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Undangan_eksternal/aksi_tambah'); ?>" method = "post" enctype="multipart/form-data">
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
                    <label class="col-sm-3 col-form-label">Nomor Undangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_undangan" placeholder="Nomor Undangan" required autofocus>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Undangan</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_undangan" placeholder="Tanggal Undangan" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Undangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_undangan">
                        <option selected="selected" value="">Pilih Sifat Undangan</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Undangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_undangan">
                        <option selected="selected" value="">Pilih Klasifikasi Undangan</option>
                        <?php foreach ($klasifikasi as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_undangan" placeholder="Jumlah Lampiran">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_undangan" placeholder="Perihal Undangan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_undangan">
                        <option selected="selected" value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Undangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tujuan_undangan" placeholder="Tujuan Undangan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan Undangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat_tujuan_undangan" placeholder="Alamat Tujuan Undangan"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Acara</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" name="tanggal_dimulai_acara" placeholder="Tanggal Dimulai Acara" required>
                      </div>
                      <div class="col-sm-1" style="text-align: center;">
                        Sampai
                      </div>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" name="tanggal_selesai_acara" placeholder="Tanggal Selesai Acara" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Acara</label>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" name="jam_dimulai_acara" placeholder="Jam Dimulai Acara" required>
                      </div>
                      <div class="col-sm-1" style="text-align: center;">
                        Sampai
                      </div>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" name="jam_selesai_acara" placeholder="Jam Selesai Acara">
                        <span>*Kosongkan jika waktu selesai tidak ditentukan</span>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lokasi Acara</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lokasi_acara" placeholder="Lokasi Acara" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tembusan_undangan[]" multiple="multiple">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Undangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control textarea" name="isi_undangan" placeholder="Isi Undangan"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                  
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
    $(function () {
    // Summernote
    $('.textarea').summernote()
  })
  });
</script>
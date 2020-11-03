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
            <h1>Tambah Surat Eksternal - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal/'); ?>">Surat Eksternal - Surat</a></li>
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
                <h3 class="card-title">Form Tambah Surat Eksternal - Surat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Surat_eksternal/aksi_tambah'); ?>" method = "post" enctype="multipart/form-data">
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
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required autofocus>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option selected="selected" value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_surat" placeholder="Tanggal Surat" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_surat">
                        <option selected="selected" value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_surat">
                        <option selected="selected" value="">Pilih Klasifikasi Surat</option>
                        <?php foreach ($klasifikasi as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal Surat" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tujuan_surat" placeholder="Tujuan Surat" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan Surat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat_tujuan_surat" placeholder="Alamat Tujuan Surat"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Jumlah Lampiran">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Surat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control textarea" name="isi_surat" placeholder="Isi Surat"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                  <!-- <input type="submit" name="sent" value="Simpan dan Kirim" class="btn btn-info float-right">
                  <input type="submit" name="draft" value="Simpan Sebagai Draft" class="btn btn-warning float-right" style="margin-right: 10px"> -->
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
    }
    return false;
}
</script>
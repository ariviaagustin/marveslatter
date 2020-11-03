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
            <h1>Ubah Surat Eksternal - Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Undangan_eksternal/'); ?>">Surat Eksternal - Undangan</a></li>
              <li class="breadcrumb-item active">Ubah</li>
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
                <h3 class="card-title">Form Ubah Surat Eksternal - Undangan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Undangan_eksternal/aksi_ubah'); ?>" method = "post" enctype="multipart/form-data" id="form1">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Undangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_undangan" placeholder="Nomor Undangan" value="<?= $ue->no_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Undangan</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_undangan" placeholder="Tanggal Undangan" value="<?= $ue->tgl_surat; ?>" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Undangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_undangan">
                        <option selected="selected" value="">Pilih Sifat Undangan</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>" <?php if($key->id_sifat_surat == $ue->sifat_surat){ echo "selected"; } ?>><?php echo $key->nama_sifat_surat; ?></option>
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
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi == $ue->klasifikasi_surat){ echo "selected"; } ?>><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_undangan" placeholder="Jumlah Lampiran" value="<?= $ue->lampiran_surat; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_undangan" placeholder="Perihal Undangan" value="<?= $ue->perihal_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_undangan">
                        <option selected="selected" value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $ue->penandatangan){ echo "selected"; } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Undangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tujuan_undangan" placeholder="Tujuan Undangan" value="<?= $ue->tujuan_surat_ke; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan Undangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat_tujuan_undangan" placeholder="Alamat Tujuan Undangan"><?= $ue->alamat_tujuan_surat; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Acara</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" name="tanggal_dimulai_acara" placeholder="Tanggal Dimulai Acara" value="<?= $ue->tanggal_dimulai_acara; ?>" required>
                      </div>
                      <div class="col-sm-1" style="text-align: center;">
                        Sampai
                      </div>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" name="tanggal_selesai_acara" placeholder="Tanggal Selesai Acara" value="<?= $ue->tanggal_selesai_acara; ?>" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Acara</label>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" name="jam_dimulai_acara" placeholder="Jam Dimulai Acara" value="<?= $ue->jam_dimulai_acara; ?>" required>
                      </div>
                      <div class="col-sm-1" style="text-align: center;">
                        Sampai
                      </div>
                      <div class="col-sm-4">
                        <?php 
                          if($ue->jam_selesai_acara=='00:00:00'){
                            $nilai = '';
                          }else{
                            $nilai = $ue->jam_selesai_acara;
                          }
                        ?>
                        <input type="time" class="form-control" name="jam_selesai_acara" placeholder="Jam Selesai Acara" value="<?php echo $nilai; ?>">
                        <span>*Kosongkan jika waktu selesai tidak ditentukan</span>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lokasi Acara</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lokasi_acara" placeholder="Lokasi Acara" value="<?= $ue->lokasi_acara; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tembusan_undangan[]" multiple="multiple">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($ue->tembusan_surat != "null"){ $tembusan = json_decode($ue->tembusan_surat); foreach ($tembusan as $a) { if($key->id_data_pegawai == $a){ echo "selected"; } } }?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Undangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control textarea" name="isi_undangan" placeholder="Isi Undangan"><?= $ue->isi_surat; ?></textarea>
                    </div>
                  </div>
                  <?php if($ue->file_surat == 0 || $ue->file_surat == ''){ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload File</label>
                      <div class="col-sm-9">
                        <input class="form-control" type="file" name="file_surat" id="file" style="height: 100%" accept="application/pdf" onchange="fileValidation()">
                      </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload File</label>
                      <div class="col-sm-9">
                        <a href="<?= site_url('uploads/undangan/'.$ue->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id_daftar_surat" value="<?= $ue->id_daftar_surat; ?>" id = "id">
                  <input type="hidden" name="status_surat" value="<?= $ue->status_surat; ?>">
                  <input type="hidden" name="is_read" value="<?= $ue->is_read; ?>">
                  <input type="hidden" name="jumlah_file" value="<?= $ue->file_surat; ?>" id = "jumlah">
                  <input type="submit" name="sent" value="Simpan dan Selesai" class="btn btn-info float-right" id="sent">
                  <input type="submit" name="draft" value="Simpan Sebagai Draft" class="btn btn-warning float-right" style="margin-right: 10px" id="draft">
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
<script>
  function fileValidation(){
    const fileInput = document.getElementById("file");
    var filePath = $("#file").val();
    var allowedExtensions = ["pdf"];
    var aux = filePath.split('.');
    var extension = aux[aux.length -1].toLowerCase();
    console.log(extension);
    if(allowedExtensions.indexOf(extension) > -1){
    //alert("file sesuai");
    if (fileInput.files.length > 0) { 
      for (const i = 0; i <= fileInput.files.length - 1; i++) 
      {  
        const fsize = fileInput.files.item(i).size; 
        const file = Math.round((fsize / 1024)); 
        // The size of the file. 
        if (file >= 1024) { 
          alert( 
            "Ukuran File terlalu besar"); 
          fileInput.value = '';
          return false;
        }
      } 
    }
  }else{
    alert("file tidak sesuai");
    fileInput.value = '';
    return false;
  }
}
</script>
<script type="text/javascript">
  $(document).ready(function (){
    <?php if($file > 0){ ?>
      // $("#dis").setAttribute('disabled','disabled');
      $("#form1 :input").attr("disabled", true);
      $("#id").attr("disabled", false);
      $("#draft").attr("disabled", false);
      $("#sent").attr("disabled", false);
      $("#jumlah").attr("disabled", false);
    <?php }?>
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $("#sent").click(function(){
    var x = $("#file").val();
    if(x == '')
    {
      alert('Belum Upload File');
      return false;
    }
    else
    {
      return true;
    }
  });
});
</script>
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
            <h1>Ubah Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal_keluar/'); ?>">Surat Eksternal - Surat Keluar</a></li>
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
                <h3 class="card-title">Form Ubah Surat Keluar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Surat_eksternal_keluar/aksi_ubah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="no_surat" placeholder="Nomor Surat" value="<?= $sek->no_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <option selected="selected" value="">Pilih Jenis Surat</option>
                        <?php foreach ($jenis as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>" <?php if($key->id_jenis_surat == $sek->jenis_surat){ echo "selected"; } ?>><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option selected="selected" value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>" <?php if($key->id_sifat_surat == $sek->sifat_surat){ echo "selected"; } ?>><?php echo $key->nama_sifat_surat; ?></option>
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
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi == $sek->klasifikasi_surat){ echo "selected"; } ?>><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal Surat" value="<?= $sek->perihal_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tgl_surat" placeholder="Tanggal Surat" value="<?= $sek->tgl_surat; ?>" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Jumlah Lampiran" value="<?= $sek->lampiran_surat; ?>">
                      <span>*Diisi dengan angka, contoh : 1</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pengirim Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="pengirim_surat">
                        <option selected="selected" value="">Pilih Pengirim Surat</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $sek->pengirim_surat){ echo "selected"; } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tujuan_surat_ke" placeholder="Tujuan Surat" value="<?= $sek->tujuan_surat_ke; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan Surat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat_tujuan_surat" placeholder="Alamat Tujuan Surat"><?= $sek->alamat_tujuan_surat; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tembusan_surat" placeholder="Tembusan" value="<?= $sek->tembusan_surat; ?>">
                      <span>*Jika lebi dari satu (1), maka pisahkan dengan titik koma (;).</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan">
                        <option selected="selected" value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $sek->penandatangan){ echo "selected"; } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Upload Surat</label>
                    <?php if(!empty($sek->file_surat)){ ?>
                      <div class="col-sm-6">
                        <input class="form-control" type="file" name="file_surat" style="height: 100%" onchange="fileValidation()" accept="application/pdf,image/jpg,image/png,image/jpeg" id="file">
                      </div>
                      <div class="col-sm-3">
                        <a href="<?= site_url('uploads/sek/'.$sek->file_surat); ?>" class = "btn btn-info" target = "_blank"><i class = "fa fa-file"></i> Surat Sebelumnya</a>
                      </div>
                    <?php } ?>
                    <?php if(empty($sek->file_surat)){ ?>
                      <div class="col-sm-9">
                        <input class="form-control" type="file" name="file_surat" style="height: 100%" onchange="fileValidation()" accept="application/pdf,image/jpg,image/png,image/jpeg" id="file">
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $sek->id_daftar_surat; ?>">
                  <input type="hidden" name="file_sek_old" value="<?= $sek->file_surat; ?>">
                  <input type="hidden" name="is_read" value="<?= $sek->is_read; ?>">
                  <input type="hidden" name="status_sek" value="<?= $sek->status_surat; ?>">
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
  });
</script>
<script>
    function fileValidation(){
        const fileInput = document.getElementById("file");
        var filePath = $("#file").val();
        var allowedExtensions = ["jpg","jpeg", "png", "pdf"];
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
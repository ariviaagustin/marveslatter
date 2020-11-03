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
            <h1>Ubah Nota Dinas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/'); ?>">Nota Dinas</a></li>
              <li class="breadcrumb-item active">Ubah Nota Dinas</li>
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
                <h3 class="card-title">Form Ubah Nota Dinas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/notadinas_aksiedit'); ?>" method = "post" id="form1" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="penandatangan_nota_dinas">
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $data->penandatangan){ echo "selected"; } ?>><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_nota_dinas" value="<?php echo $data->perihal_surat; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_nota_dinas">
                        <?php foreach ($tembusan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>" <?php if($key->id_jabatan == $data->tujuan_surat_ke){ echo "selected"; } ?>><?php echo $key->nama_jabatan.' - '.$key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_nota_dinas[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($data->tembusan_surat != "null"){ $tembusan = json_decode($data->tembusan_surat); foreach ($tembusan as $a) { if($key->id_data_pegawai == $a){ echo "selected"; } } }?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="klasifikasi_nota_dinas">
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi == $data->klasifikasi_surat){ echo "selected"; } ?>><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_nota_dinas">
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>" <?php if($key->id_sifat_surat == $data->sifat_surat){ echo "selected"; } ?>><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_nota_dinas" value="<?php echo $data->tgl_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Nota Dinas</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_nota_dinas" value="<?php echo $data->no_surat; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_nota_dinas" value="<?php echo $data->lampiran_surat; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Nota Dinas</label>
                    <div class="col-sm-9">
                      <textarea name="isi_nota_dinas" class="textarea" placeholder="Isi Nota Dinas" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo $data->isi_surat; ?></textarea>
                    </div>
                  </div>
                  <?php if($data->file_surat == NULL || $data->file_surat == ''){ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload File</label>
                      <div class="col-sm-9">
                        <input class="form-control" type="file" name="file_surat" id="file" style="height: 100%" accept="application/pdf" onchange="fileValidation_2()">
                      </div>
                    </div>
                  <?php }else{ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload File</label>
                      <div class="col-sm-9">
                        <a href="<?= site_url('uploads/notadinas/'.$data->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <input type="text" name="status_nota_dinas" value="<?= $nd->status; ?>" id="status"> -->
                  <input type="hidden" name="id_daftar_surat" value="<?php echo $data->id_daftar_surat; ?>" id = "id">
                  <input type="hidden" name="jumlah_file" value="<?= $data->file_surat; ?>" id = "jumlah">
                  <input type="submit" name="sent" value="Simpan dan Kirim" class="btn btn-info float-right" id="sent">
                  <input type="submit" name="draft" value="Simpan Sebagai Draft" class="btn btn-warning float-right" style="margin-right: 10px" id="draft">
                  <!-- <button type="submit" class="btn btn-primary float-right" id="btn">Simpan</button> -->
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
<script type="text/javascript">
  $(document).ready(function(){
    var x = document.getElementById("unit").value;
    var tujuan = "<?= $nd->tujuan ?>";
  if(x == "0")
    {
      $("#internal").hide() ;
      $("#eksternal").hide() ;
    }

    if(x == "1")
    {
      $("#eksternal").hide() ;
      $("#internal").show() ;
    }
    if(x == "2")
    {
      $("#internal").hide() ;
      $("#eksternal").show() ;
      $("input[name='tujuan_eks']").val(tujuan);
      // $("#eksternal").val(pengirim) ;
    }
    return false; 
  });
</script>
<script type="text/javascript">
  function myFunction() {
    var x = document.getElementById("unit").value;
    var tujuan = "<?= $nd->tujuan ?>";
    if(x == "0")
    {
      $("#internal").hide();
      $("#eksternal").hide();
    }

    if(x == "1")
    {
      $("#eksternal").hide() ;
      $("#internal").show() ;
    }
    if(x == "2")
    {
      $("#internal").hide() ;
      $("#eksternal").show() ;
      $("input[name='tujuan_eks']").val('');
    }
      return false;
  }
</script>
<script>
  function fileValidation(){
    const fileInput = document.getElementById("surat_ttd");
    var filePath = $("#surat_ttd").val();
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
            alert("Ukuran File terlalu besar"); 
            fileInput.value = '';
            return false;
          }
        } 
      }
    }
    else{
      alert("file tidak sesuai");
      fileInput.value = '';
      return false;
    }
  }
</script>
<script>
  function fileValidation_2(){
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
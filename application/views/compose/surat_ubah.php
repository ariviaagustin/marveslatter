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
            <h1>Ubah Surat Internal - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/surat'); ?>">Surat Internal - Surat</a></li>
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
                <h3 class="card-title">Form Ubah Surat Internal - Surat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/aksi_surat_ubah'); ?>" method = "post" enctype="multipart/form-data" id="form1" onSubmit="validasi()">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" value="<?= $si->no_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option selected="selected" value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>" <?php if($si->sifat_surat == $key->id_sifat_surat){ echo "selected"; } ?>><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_surat" placeholder="Tanggal Surat" value="<?= $si->tgl_surat; ?>" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_surat">
                        <option selected="selected" value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($si->penandatangan == $key->id_data_pegawai){ echo "selected"; } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
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
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($si->klasifikasi_surat == $key->id_klasifikasi){ echo "selected"; } ?>><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal Surat" value="<?= $si->perihal_surat; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="unit_tujuan" id="unit_tujuan" onchange="myFunction()">
                        <option selected="selected" value="">Pilih Unit Tujuan</option>
                        <option value="1" <?php if($si->jenis_tujuan_surat ==1){ echo "selected"; } ?>>Personal</option>
                        <option value="2" <?php if($si->jenis_tujuan_surat == 2){ echo "selected"; } ?>>Jabatan</option>
                        <option value="3" <?php if($si->jenis_tujuan_surat == 3){ echo "selected"; } ?>>Bagian Unit Kerja</option>
                        <option value="4" <?php if($si->jenis_tujuan_surat == 4){ echo "selected"; } ?>>Unit Kerja</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="personal">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat_p[]" multiple="multiple" id="per">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php $z = json_decode($si->tujuan_surat_ke); if($si->jenis_tujuan_surat == 1){ foreach ($z as $y) { if($y == $key->id_data_pegawai){ echo "selected"; } } } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="jabatan">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat_j[]" multiple="multiple" id="jab">
                        <?php foreach ($jabatan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>" <?php $z = json_decode($si->tujuan_surat_ke); if($si->jenis_tujuan_surat == 2){ foreach ($z as $y) { if($y == $key->id_jabatan){ echo "selected"; } } } ?>><?php echo $key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="bag_unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat_b[]" multiple="multiple" id="bag">
                        <?php foreach ($bag_unit as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>" <?php $z = json_decode($si->tujuan_surat_ke); if($si->jenis_tujuan_surat == 3){ foreach ($z as $y) { if($y == $key->id_bag_unit_kerja){ echo "selected"; } } } ?>><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat_u[]" multiple="multiple" id="u">
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>" <?php $z = json_decode($si->tujuan_surat_ke); if($si->jenis_tujuan_surat == 4){ foreach ($z as $y) { if($y == $key->id_unit_kerja){ echo "selected"; } } } ?>><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Jumlah Lampiran" value="<?= $si->lampiran_surat; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Surat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control textarea" name="isi_surat" placeholder="Isi Surat"><?= $si->isi_surat; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_surat[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($si->tembusan_surat != "null"){ $tembusan = json_decode($si->tembusan_surat); foreach ($tembusan as $a) { if($key->id_data_pegawai == $a){ echo "selected"; } } }?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <?php if($si->file_surat == NULL || $si->file_surat == ''){ ?>
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
                        <a href="<?= site_url('uploads/surat/'.$si->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id_daftar_surat" value="<?= $si->id_daftar_surat; ?>" id="id">
                  <input type="hidden" name="status_surat" value="<?= $si->status_surat; ?>">
                  <input type="hidden" name="is_read" value="<?= $si->is_read; ?>">
                  <input type="hidden" name="jumlah_file" value="<?= $si->file_surat; ?>" id = "jumlah">
                  <input type="submit" name="sent" value="Simpan dan Kirim" class="btn btn-info float-right" id = "sent">
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var x = document.getElementById("unit_tujuan").value;
    if(x == "")
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
  });
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
      $("#personal").required() ;
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#jabatan").required() ;
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
      $("#bag_unit").required() ;
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
      $("#unit").required() ;
    }
    return false;
}
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
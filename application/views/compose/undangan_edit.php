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
            <h1>Ubah Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/undangan/'); ?>">Undangan</a></li>
              <li class="breadcrumb-item active">Ubah Undangan</li>
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
                <h3 class="card-title">Form Ubah Undangan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/undangan_aksiedit'); ?>" method = "post" enctype="multipart/form-data" id="form1">
                <div class="card-body">


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No Undangan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nomor_undangan" value="<?php echo $data->no_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="penandatangan_undangan">
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $data->penandatangan){ echo "selected"; } ?>><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_undangan" value="<?php echo $data->perihal_surat; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Mulai Acara</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_dimulai_acara" value="<?php echo $data->tanggal_dimulai_acara; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Selesai Acara</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_selesai_acara" value="<?php echo $data->tanggal_selesai_acara; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jam Mulai Acara</label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" name="jam_dimulai_acara" value="<?php echo $data->jam_dimulai_acara; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jam Selesai Acara</label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" name="jam_selesai_acara" value="<?php echo $data->jam_selesai_acara; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lokasi Acara</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="lokasi_acara" value="<?php echo $data->lokasi_acara; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="unit_tujuan" id="unit_tujuan" onchange="myFunction()">
                        <option value="1" <?php if($data->jenis_tujuan_surat == 1){ echo "selected"; } ?>>Perorangan</option>
                        <option value="2" <?php if($data->jenis_tujuan_surat == 2){ echo "selected"; } ?>>Jabatan</option>
                        <option value="3" <?php if($data->jenis_tujuan_surat == 3){ echo "selected"; } ?>>Bagian Unit Kerja</option>
                        <option value="4" <?php if($data->jenis_tujuan_surat == 4){ echo "selected"; } ?>>Unit Kerja</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="display: none;" id="personal" >
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tujuan_undangan_p[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php $z = json_decode($data->tujuan_surat_ke); if($data->jenis_tujuan_surat == 1){ foreach ($z as $y) { if($y == $key->id_data_pegawai){ echo "selected"; } } } ?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="jabatan">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tujuan_undangan_j[]">
                        <?php foreach ($jabatan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>" <?php $z = json_decode($data->tujuan_surat_ke); if($data->jenis_tujuan_surat == 2){ foreach ($z as $y) { if($y == $key->id_jabatan){ echo "selected"; } } } ?>><?php echo $key->nama_jabatan; ?></option>
                        <?php } ?>
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="bag_unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tujuan_undangan_bu[]">
                        <?php foreach ($bag_unit as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>" <?php $z = json_decode($data->tujuan_surat_ke); if($data->jenis_tujuan_surat == 3){ foreach ($z as $y) { if($y == $key->id_bag_unit_kerja){ echo "selected"; } } } ?>><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tujuan_undangan_u[]">
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>" <?php $z = json_decode($data->tujuan_surat_ke); if($data->jenis_tujuan_surat == 4){ foreach ($z as $y) { if($y == $key->id_unit_kerja){ echo "selected"; } } } ?>><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                        
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="alamat_tujuan_undangan" value="<?php echo $data->alamat_tujuan_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tembusan_undangan[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($data->tembusan_surat != "null"){ $tembusan = json_decode($data->tembusan_surat); foreach ($tembusan as $a) { if($key->id_data_pegawai == $a){ echo "selected"; } } }?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="klasifikasi_undangan">
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi == $data->klasifikasi_surat){ echo "selected"; } ?>><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Undangan</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_undangan" value="<?php echo $data->tgl_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Undangan</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="sifat_undangan">
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>" <?php if($key->id_sifat_surat == $data->sifat_surat){ echo "selected"; } ?>><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_undangan" value="<?php echo $data->lampiran_surat; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Undangan</label>
                    <div class="col-sm-9">
                      <textarea name="isi_undangan" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo $data->isi_surat; ?></textarea>
                    </div>
                  </div>
                  <?php if($data->file_surat == NULL || $data->file_surat == ''){ ?>
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
                        <a href="<?= site_url('uploads/undangan/'.$data->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a>
                      </div>
                    </div>
                  <?php } ?>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <input type="text" name="status_nota_dinas" value="<?= $nd->status; ?>" id="status"> -->
                  <input type="hidden" name="id_daftar_surat" value="<?php echo $data->id_daftar_surat; ?>" id="id">
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

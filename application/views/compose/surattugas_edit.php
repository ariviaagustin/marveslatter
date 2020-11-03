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
            <h1>Ubah Surat Tugas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/surattugas/'); ?>">Surat Tugas</a></li>
              <li class="breadcrumb-item active">Ubah Surat Tugas</li>
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
                <h3 class="card-title">Form Ubah Surat Tugas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/surattugas_aksiedit'); ?>" method = "post" enctype="multipart/form-data" id="form1">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nomer_sti" value="<?php echo $data->no_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Menimbang</label>
                    <div class="col-sm-9">
                        <a href="#" data-id="<?php echo $data->id_daftar_surat; ?>" class="btn_tambah_menimbang btn btn-info btn-sm" style="float: right;"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <table border="1" style="width: 100%">
                            <thead>
                              <tr style="text-align: center;">
                                  <td>No.</td>
                                  <td style="width: 90%">Menimbang</td>
                                  <!-- <td>Aksi</td> -->
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                  $id_daftar_surat = $data->id_daftar_surat;
                                  $where=array('id_daftar_surat'=>$id_daftar_surat);
                                  $datamenimbang=$this->M_all->selectX('data_menimbang', $where)->result();
                                  $jml = count($datamenimbang);
                                  $no=1;
                                  for ($i=0; $i < $jml; $i++) { ?>
                                      <tr>
                                          <td style="text-align: center;"><?php echo $no++; ?></td>
                                          <td> <input type="text" class="menimbang form-control" name="ket_menimbang[]" data-id="<?php echo $datamenimbang[$i]->id_menimbang; ?>" value="<?php echo $datamenimbang[$i]->ket_menimbang; ?>" style="margin-top: 10px; margin-bottom: 10px;" required></td>
                                          <!-- <td style="text-align: center;">
                                            <a href="<?php //echo site_url('Compose_internal/menimbang_hapus/'.$datamenimbang[$i]->id_menimbang); ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                          </td> -->
                                      </tr> 
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Dasar</label>
                    <div class="col-sm-9">
                        <a href="#" data-id="<?php echo $data->id_daftar_surat; ?>" class="btn_tambah_dasar btn btn-info btn-sm" style="float: right;"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <table border="1" style="width: 100%">
                            <thead>
                              <tr style="text-align: center;">
                                  <td>No.</td>
                                  <td style="width: 90%">Dasar</td>
                                  <!-- <td>Aksi</td> -->
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                  $id_daftar_surat = $data->id_daftar_surat;
                                  $where1=array('id_daftar_surat'=>$id_daftar_surat);
                                  $datadasar=$this->M_all->selectX('data_dasar', $where1)->result();
                                  $jml1 = count($datadasar);
                                  $no1=1;
                                  for ($i=0; $i < $jml1; $i++) { ?>
                                      <tr>
                                          <td style="text-align: center;"><?php echo $no1++; ?></td>
                                          <td> <input type="text" class="dasar form-control" name="ket_dasar[]" data-id="<?php echo $datadasar[$i]->id_dasar; ?>" value="<?php echo $datadasar[$i]->ket_dasar; ?>" style="margin-top: 10px; margin-bottom: 10px;" required></td>
                                          <!-- <td style="text-align: center;">
                                            <a href="" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                          </td> -->
                                      </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kepada (Daftar Penerima Tugas)</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="yang_diberi_tugas[]">
                        <?php 
                            $m = json_decode($data->yang_diberi_tugas);
                              $query=$this->M_surat->pegawai_jabatan_2();
                              foreach ($query->result() as $tampil) {
                              ?>
                              <option value="<?php echo $tampil->id_data_pegawai; ?>" <?php if(in_array($tampil->id_data_pegawai, $m)) echo "selected"; ?>><?php echo $tampil->nama_pegawai.' - '.$tampil->nama_jabatan; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Mulai Bertugas</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_mulai_bertugas" value="<?php echo $data->tanggal_mulai_bertugas; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Selesai Bertugas</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_selesai_bertugas" value="<?php echo $data->tanggal_selesai_bertugas; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Bertugas</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="tempat_tugas" value="<?php echo $data->tempat_tugas; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Wilayah Tugas</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_tugas">
                        <?php foreach ($wilayah as $key) { ?>
                          <option value="<?php echo $key->id_kokab; ?>" <?php if($key->id_kokab == $data->tujuan_tugas){ echo "selected"; } ?>><?php echo $key->nama_kokab.' - '.$key->nama_provinsi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Maksud Bertugas</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="maksud_tugas" cols="2" rows="2"><?php echo $data->maksud_tugas; ?></textarea>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat (Penandatanganan)</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_sti" value="<?php echo $data->tgl_surat; ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="penandatangan_sti">
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($key->id_data_pegawai == $data->penandatangan){ echo "selected"; } ?>><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" style="width: 100%;" name="tembusan_sti[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>" <?php if($data->tembusan_surat != "null"){ $tembusan = json_decode($data->tembusan_surat); foreach ($tembusan as $a) { if($key->id_data_pegawai == $a){ echo "selected"; } } }?>><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                  </div>

                  <hr>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Tugas</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="jenis_tugas">
                        <?php foreach ($jenis_tugas as $key) { ?>
                          <option value="<?php echo $key->id_jenis_tugas; ?>" <?php if($key->id_jenis_tugas == $data->jenis_tugas){ echo "selected"; } ?>><?php echo $key->nama_jenis_tugas; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Moda Transportasi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="mode_transportasi">
                        <?php foreach ($moda as $key) { ?>
                          <option value="<?php echo $key->id_moda; ?>" <?php if($key->id_moda == $data->mode_transportasi){ echo "selected"; } ?>><?php echo $key->nama_moda; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sumber Pembiayaan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="sumber_biaya" value="<?php echo $data->sumber_biaya; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="klasifikasi_sti">
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi == $data->klasifikasi_sti){ echo "selected"; } ?>><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <hr>
                  <?php if($data->file_surat == NULL){ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload Surat (Yang Sudah Ditandatangani)</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" name="file_surat" id="file" style="height: 100%" accept="application/pdf" onchange="fileValidation_2()">
                      </div>
                    </div>
                  <?php }else{ ?>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload Surat (Yang Sudah Ditandatangani)</label>
                      <div class="col-sm-9">
                        <a href="<?= site_url('uploads/surat_tugas/'.$data->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a>
                      </div>
                    </div>
                  <?php } ?>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  
                  <input type="hidden" name="id_daftar_surat" value="<?php echo $data->id_daftar_surat; ?>" id = "id">
                  <input type="hidden" name="jumlah_file" value="<?= $data->file_surat; ?>" id = "jumlah">
                  <input type="submit" name="sent" value="Simpan dan Kirim" class="btn btn-info float-right" id="sent">
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

  <div class="modal fade" id="Modalnew2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Data Menimbang</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                              <div class="body-new" style="padding: 20px;">

                              </div>
                              <div class="modal-footer">
                                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                            
                              </div>
                        </div>
                  </div>
  </div>

  <div class="modal fade" id="Modalnew1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title">Tambah Data Dasar</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="body-new1" style="padding: 20px;">
              </div>
              <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                              
              </div>
          </div>
      </div>
  </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

   $(function () {
                $(document).on('click', '.btn_tambah_menimbang', function (e) {
                    e.preventDefault();
                    $("#Modalnew2").modal('show');
                    $.post('<?php echo site_url('Compose/tambah_menimbang');?>',
                            {id: $(this).attr('data-id')},
                    function (html) {
                        $(".body-new").html(html);
                    }
                    );
                });
      });

   $(function () {
                $(document).on('click', '.btn_tambah_dasar', function (e) {
                    e.preventDefault();
                    $("#Modalnew1").modal('show');
                    $.post('<?php echo site_url('Compose/tambah_dasar');?>',
                            {id: $(this).attr('data-id')},
                    function (html) {
                        $(".body-new1").html(html);
                    }
                    );
                });
      });

   $(".menimbang").change(function(){
          var a = $(this).val();
          var b =  $(this).attr('data-id');
          //alert(a);
          $.ajax({
              url: '<?php echo site_url('Compose/simpan_menimbang');?>',
              type:"POST",
              data:{id:b,ket_menimbang:a},
              success:function(data){
                
              }
          });
      });

   $(".dasar").change(function(){
          var a = $(this).val();
          var b =  $(this).attr('data-id');
          //alert(a);
          $.ajax({
              url: '<?php echo site_url('Compose/simpan_dasar');?>',
              type:"POST",
              data:{id:b,ket_dasar:a},
              success:function(data){
                
              }
          });
      });

   $(document).on('click','.btn_hapus_menimbang',function(e)

    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?php echo base_url('Compose/menimbang_hapus/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
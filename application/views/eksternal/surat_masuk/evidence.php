<style type="text/css">
  table
  {
    margin: 2%;
  }
  th
  {
    width: 25%;
    padding: 15px;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
  }
  td
  {
    border-top: 1px solid black;
    border-bottom: 1px solid black;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Surat Eksternal - Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal_masuk'); ?>">Daftar Surat Eksternal - Surat Masuk</a></li>
              <li class="breadcrumb-item active">Detail Surat Eksternal - Surat Masuk</li>
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
                <div class="row">
                  <div class="col-sm-6"><h3 class="card-title">Detail Surat Eksternal - Surat Masuk</h3></div>
                  <div class="col-sm-6" style="text-align: right;"><a href="<?php echo site_url('Surat_eksternal_masuk/cetak/').$detail_sem->id_sem;?>" target ="_blank" class="btn btn-info"><i class = "fa fa-print"></i> Cetak</a></div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                    <th>Nomor Surat</th>
                    <td> : </td>
                    <td><?php echo $detail_sem->no_sem; ?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->perihal_sem; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->lampiran_sem; ?></td>
                </tr>
                <tr>
                  <th>Jenis Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_jenis_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tanggal_sem); ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat Diterima</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tanggal_sem_diterima);?></td>
                </tr>
                <tr>
                  <th>Asal Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->pengirim_sem; ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_jabatan.' - '.$detail_sem->nama_unit_kerja; ?></td>
                </tr>
                <tr>
                  <th>File Attachment</th>
                  <td> : </td>
                  <td>
                    <a href="#" class="btn btn-primary btn-sm fl" data-id="<?php echo $detail_sem->id_sem ?>" title="File Attachment"><i class="fa fa-image fa-xs"></i> Lihat Attachment</a>
                    <a href="<?php echo site_url('Surat_eksternal_masuk/download/'.$detail_sem->id_sem); ?>" class="btn btn-success btn-sm" ><i class="fa fa-download"></i> Unduh File</a>
                  </td>
                </tr>
              </table>

              <form class="form-horizontal" action="<?php echo site_url('Surat_eksternal_masuk/aksi_disposisi_lanjutan'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">DISPOSISI - Aksi yang Telah Dikerjakan (Checklist)</h3>
                    </div>
                    <div class="card-body">
                      <!-- Minimal red style -->
                      <input type="hidden" name="id_sem" value="<?php echo $detail_sem->id_sem; ?>">
                      <div class="row">
                          <div class="col-sm-12">
                            <?php 
                                $id_sem = $detail_sem->id_sem;
                                $where = array('id_sem'=>$id_sem, 'created_by'=>NULL);
                                $query2=$this->M_all->selectX('disposisi_sem',$where);
                                foreach ($query2->result() as $aksi) { 
                                      $a=$aksi->aksi_dispo_sem;
                                      $where1 = array('id_aksi'=>$a);
                                      $query1=$this->M_all->selectX('master_aksi',$where1);
                                      foreach ($query1->result() as $aksi_k) { ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" style="width: 30px; height: 30px;" value="<?php echo $aksi_k->id_aksi; ?>" name="aksi_realisasi[]">
                                <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi; ?></label>
                              </div>
                              <?php } ?>
                            <?php } ?>     
                          </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <br>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Disposisikan Kembali ?</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="disposisi" id="disposisi" onchange="myFunction()">
                        <option value="0">Pilih Disposisi</option>
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="display: none;" id="tidak">
                    <label class="col-sm-3 col-form-label">Upload Evidence</label>
                    <div class="col-sm-9">
                      <input type="File" name="file_evidence" class="form-control" required>
                    </div>
                  </div>

                <div class="form-group row" style="display: none;" id="benar">
                    <label class="col-sm-3 col-form-label">Unit Disposisi</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Unit" style="width: 100%;" name="unit_dispo[]">
                            <?php foreach ($tembusan as $key) { ?>
                            <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_jabatan.' - '.$key->nama_unit_kerja; ?></option>
                          <?php } ?>
                      </select>
                    </div>

                  
                    <label class="col-sm-3 col-form-label">Pesan Disposisi</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="pesan_dispo" rows="3" placeholder="Pesan Disposisi"></textarea>
                    </div>

                 
                    <label class="col-sm-3 col-form-label">Aksi yang Diperlukan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Aksi yang diperlukan" style="width: 100%;" name="aksi_dispo[]">
                      <?php foreach ($m_aksi as $aksi1) { ?>
                        <option value="<?php echo $aksi1->id_aksi; ?>"><?php echo $aksi1->aksi; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                </div>


                </div>
                  
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lampiran Surat Eksternal Masuk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });  
  </script>
  <?php
   function indonesian_date ($timestamp = '', $date_format = 'd F Y ', $suffix = '') {
      //$timestamp = '', $date_format = 'l, d F Y | H:i', $suffix = 'WIB'
          if (trim ($timestamp) == '')
          {
                  $timestamp = time ();
          }
          elseif (!ctype_digit ($timestamp))
          {
              $timestamp = strtotime ($timestamp);
          }
          # remove S (st,nd,rd,th) there are no such things in indonesia :p
          $date_format = preg_replace ("/S/", "", $date_format);
          $pattern = array (
              '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
              '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
              '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
              '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
              '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
              '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
              '/April/','/June/','/July/','/August/','/September/','/October/',
              '/November/','/December/',
          );
          $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
              'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
              'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
              'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
              'Oktober','November','Desember',
          );
          $date = date ($date_format, $timestamp);
          $date = preg_replace ($pattern, $replace, $date);
          $date = "{$date} {$suffix}";
          return $date;
      }
?>
<script type="text/javascript">
  $(function () {
                $(document).on('click', '.fl', function (e) {
                    e.preventDefault();
                    $("#modal-xl").modal('show');
                    $.post('<?php echo site_url('Surat_eksternal_masuk/modal_file');?>',
                            {id_sem: $(this).attr('data-id')},
                    function (html) {
                        $(".modal-body").html(html);
                    }
                    );
                });
        });
</script>
<script type="text/javascript">
  
    function myFunction() {
  var x = document.getElementById("disposisi").value;
  if(x == "0")
    {
      $("#benar").hide() ;
      $("#tidak").hide() ;
    }

    if(x == "1")
    {
      $("#benar").show() ;
      $("#tidak").hide() ;
    }
    if(x == "2")
    {
      $("#benar").hide() ;
      $("#tidak").show() ;
    }
    return false;
}
</script>
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
                  <div class="col-sm-6" style="text-align: right;"><a href="<?php echo site_url('Surat_eksternal_masuk/cetak/').$detail_sem->id_daftar_surat;?>" target ="_blank" class="btn btn-info"><i class = "fa fa-print"></i> Cetak</a></div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                    <th>Nomor Surat</th>
                    <td> : </td>
                    <td><?php echo $detail_sem->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->lampiran_surat; ?></td>
                </tr>
                <tr>
                  <th>Jenis Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_jenis_surat; ?></td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_sifat_surat; ?></td>
                </tr>
                <tr>
                  <th>Klasifikasi</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->kode_klasifikasi.' - '.$detail_sem->klasifikasi; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat Diterima</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tgl_surat_diterima);?></td>
                </tr>
                <tr>
                  <th>Asal Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->pengirim_surat; ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td>
                    <?php 
                        if($detail_sem->jenis_tujuan_surat=='1'){ ?>
                          <?php 
                            $a = json_decode($detail_sem->tujuan_surat_ke);
                        foreach ($a as $key) { ?>
                          <?php 
                              $key;
                              $query=$this->M_surat->pegawai_jabatan($key);
                              foreach ($query->result() as $orang) { ?>
                                <?php echo $orang->nama_pegawai.' - '.$orang->nama_jabatan; ?>
                                <br>
                             <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php 
                            $b = json_decode($detail_sem->tujuan_surat_ke);
                        foreach ($b as $key2) { ?>
                          <?php 
                              $key2;
                              $where = array('id_jabatan'=>$key2);
                              $query2=$this->M_all->selectX('master_jabatan',$where);
                              foreach ($query2->result() as $jab) { ?>
                                <?php echo $jab->nama_jabatan; ?>
                                <br>
                             <?php } ?>
                        <?php } ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Keaslian Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_keaslian; ?></td>
                </tr>
                <tr>
                  <th>Tingkat Pengamanan</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_tingkat_pengamanan; ?></td>
                </tr>
                <tr>
                  <th>File Attachment</th>
                  <td> : </td>
                  <td>
                    <?php 
                      if($detail_sem->file_surat=='' || $detail_sem->file_surat==NULL){
                        echo "File Tidak Terlampir";
                      }else{ ?>
                        <a href="#" class="btn btn-primary btn-sm fl" data-id="<?php echo $detail_sem->id_daftar_surat ?>" title="File Attachment"><i class="fa fa-image fa-xs"></i> Lihat Attachment</a>
                        <a href="<?php echo site_url('Surat_eksternal_masuk/download/'.$detail_sem->id_daftar_surat); ?>" class="btn btn-success btn-sm" ><i class="fa fa-download"></i> Unduh File</a>
                     <?php } ?>
                  </td>
                </tr>
                
              </table>
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
  </div></div>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                            {id_daftar_surat: $(this).attr('data-id')},
                    function (html) {
                        $(".modal-body").html(html);
                    }
                    );
                });
        });
</script>
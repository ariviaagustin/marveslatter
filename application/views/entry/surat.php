 <style type="text/css">
  th
  {
    text-align: center;
  }
</style>
 <div class="content-wrapper">
 	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Entry Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Entry Surat Masuk / </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                              <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-envelope-open"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Jumlah Keseluruhan Surat Masuk</span>
                                <span class="info-box-number"><?php echo $jmlh_all; ?></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-envelope-open"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Jumlah Surat Masuk (All User)</span>
                                <span class="info-box-number"><?php echo $jmlh_all_user; ?></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-envelope-open"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Jumlah Surat Masuk Hari Ini</span>
                                <span class="info-box-number"><?php echo $jmlh_all; ?></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                      </div>
                  </div>
                  <form class="form-horizontal" action="<?php echo site_url('Entry_surat/filter'); ?>" method = "post">
                    <div class="card-body">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-4">
                            <select class="form-control select2" style="width: 100%;" name="status_input">
                                <option value="">--Pilih Status--</option>
                                <option value="0">Draft - Menunggu Diteruskan</option>
                                <option value="1">Dibaca</option>
                                <option value="2">Diteruskan</option>
                            </select>
                          </div>
                          <label class="col-sm-3 col-form-label" style="text-align: center;">Tanggal Surat Diterima</label>
                          <div class="col-sm-3">
                              <input type="date" name="" class="form-control" >
                            </select>
                          </div>

                        </div>
                    </div>
                </form>
              </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="text-align: right;">
              	<a href="#" class="btn_tambah_srt btn btn-primary" style="float: right;"><i class="fa fa-plus"></i> Input Surat</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<?php echo $this->session->flashdata('msg2');?>
                <?php echo $this->session->flashdata('msg3');?>
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%">No</th>
                      <th>Unik ID</th>
                      <th>Nomor Surat</th>
                      <th>Tanggal Surat</th>
                      <th>Pengirim Surat</th>
                      <th>Tujuan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    	<?php
                    		$no=1;
                    		foreach ($surat as $key) { ?>
                    			<tr>
                    				<td><?php echo $no++; ?></td>
                            <td><?php echo $key->no_ticket; ?></td>
                    				<td><?php echo $key->nomor_surat; ?></td>
                    				<td><?php echo indonesian_date($key->tanggal_diterima); ?></td>
                    				<td><?php echo $key->dari_pengirim; ?></td>
                    				<td><?php echo $key->kepada_tujuan; ?></td>
                    				<td style="text-align: center;">
                    					<?php if($key->status_input==0){ ?>
                    						<span class="badge badge-warning">Draft - Menunggu Diteruskan</span>
                    					<?php }elseif($key->status_input==1){ ?>
                    						<span class="badge badge-success">Dibaca</span>
                    					<?php }elseif($key->status_input==2){ ?>
                    						<span class="badge badge-primary">Diteruskan</span>
                    					<?php }else{ ?>
                                <span class="badge badge-info">Surat Dikirim</span>
                              <?php } ?>
                    				</td>
                    				<td style="text-align: center;">
                    					<a href="#" data-id="<?= $key->id_daftar_input; ?>" class = "btn_detail btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                              <a href="<?php echo site_url('Entry_surat/cetak_tanda/').$key->id_daftar_input;?>" target="_blank" class = "btn btn-primary btn-sm" title = "Tanda Terima"><li class="fa fa-sticky-note"></li></a>
                    					<?php if($key->status_input==0){ ?>
                        					<a href="#" data-id = "<?= $key->id_daftar_input; ?>" class="btn_ubah btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                          					<a href="#" data-id = "<?= $key->id_daftar_input; ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a> 
                              <?php } ?>
                    				</td>
                    			</tr>
                    	<?php 	}
                    	?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
 </div>
 <div class="modal fade" id="Modalnew1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title">Input Surat Masuk</h4>
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

  <div class="modal fade" id="Modalnew2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title">Detail Surat Masuk</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="body-new2" style="padding: 20px;">
              </div>
              <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                              
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="Modalnew3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title">Edit Surat Masuk</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="body-new3" style="padding: 20px;">
              </div>
              <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                              
              </div>
          </div>
      </div>
  </div>

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
  $(function () {
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });

  $(function () {
                $(document).on('click', '.btn_tambah_srt', function (e) {
                    e.preventDefault();
                    $("#Modalnew1").modal('show');
                    $.post('<?php echo site_url('Entry_surat/tambah_surat');?>',
                            // {id: $(this).attr('data-id')},
                    function (html) {
                        $(".body-new1").html(html);
                    }
                    );
                });
      });

  $(function () {
                $(document).on('click', '.btn_detail', function (e) {
                    e.preventDefault();
                    $("#Modalnew2").modal('show');
                    $.post('<?php echo site_url('Entry_surat/detail_surat');?>',
                            {id: $(this).attr('data-id')},
                    function (html) {
                        $(".body-new2").html(html);
                    }
                    );
                });
      });

  $(function () {
                $(document).on('click', '.btn_ubah', function (e) {
                    e.preventDefault();
                    $("#Modalnew3").modal('show');
                    $.post('<?php echo site_url('Entry_surat/ubah_surat');?>',
                            {id: $(this).attr('data-id')},
                    function (html) {
                        $(".body-new3").html(html);
                    }
                    );
                });
      });

  $(document).on('click','.hapus',function(e)

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
          url: '<?php echo base_url('Entry_surat/surat_hapus/'); ?>/'+id,
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
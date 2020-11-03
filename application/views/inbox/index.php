<style type="text/css">
  th
  {
    text-align: center;
  }
  .box{
    background-color: #ff9900;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
  .kirim{
    background-color: #17a2b8;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: white;
    margin-bottom: 7px;
    text-align: center;
  }
  .blm_upload{
    background-color: #d4d4d4;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
  .sudah_upload{
    background-color: #6ae3ff;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inbox</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Inbox</li>
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
                <div class="card-header" style="text-align: right;">
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div style="overflow-x:auto;">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;">No</th>
                        <th style="vertical-align: middle;">Kategori Surat</th>
                        <th style="vertical-align: middle;">Nomor Surat</th>
                        <th style="vertical-align: middle;">Tanggal Surat</th>
                        <th style="vertical-align: middle;">Jenis Surat</th>
                        <th style="vertical-align: middle;">Sifat Surat</th>
                        <th style="vertical-align: middle;">Klasifikasi</th>
                        <th style="vertical-align: middle;">Perihal</th>
                        <th style="vertical-align: middle; width: 13%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $nomor = 1;
                        foreach ($data as $d) {
                      ?>
                      <tr style="background-color: #f0f8ff">
                        <td><?php echo $nomor++ ?>.</td>
                        <td><?php echo $d->ket_masuk_keluar.' - '.$d->ket_internal_eksternal; ?></td>
                        <td><?php echo $d->no_surat; ?></td>
                        <td><?php echo indonesian_date($d->tgl_surat); ?></td>
                        <td><?php echo $d->nama_jenis_surat;?></td>
                        <td><?php echo $d->nama_sifat_surat;?></td>
                        <td><?php echo $d->kode_klasifikasi.' - '.$d->klasifikasi;?></td>
                        <td><?php echo $d->perihal_surat;?></td>
                        <td style="text-align: center;">
                          <a href="<?php echo site_url('Inbox/detail/'.$d->id_daftar_surat); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
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
    <!-- /.content -->
  </div>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
  $(function () {
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
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
          url: '<?php echo base_url('Surat_internal/hapus/'); ?>/'+id,
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
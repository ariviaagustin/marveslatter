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
            <h1>Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Undangan/ </li>
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
                <a href="<?php echo site_url('Compose/undangan_tambah'); ?>" class="btn btn-info"><li class = "fa fa-plus"></li> Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%; vertical-align: middle;">No</th>
                      <th style="vertical-align: middle;">Nomer Undangan</th>
                      <th style="vertical-align: middle;">Tanggal Undangan</th>
                      <th style="vertical-align: middle;">Perihal Undangan</th>
                      <th style="vertical-align: middle;">Status Undangan</th>
                      <th style="width: auto; vertical-align: middle;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($data as $key) {
                    ?>
                    <tr>
                      <td><?php echo $no++; ?>.</td>
                      <td><?php echo $key->no_surat; ?></td>
                      <td><?php echo $key->tgl_surat; ?></td>
                      <td><?php echo $key->perihal_surat; ?></td>
                      <td>
                        <?php if($key->status_surat == 1){ ?>
                          <center>
                            <div class="box"><i class="fa fa-archive" aria-hidden="true"></i> Draft</div>
                          </center>
                        <?php } ?>
                        <?php if($key->status_surat == 2){ ?>
                          <center><div class="kirim"><i class="fa fa-paper-plane" aria-hidden="true"></i> Terkirim</div>
                            <a href="<?= site_url('uploads/undangan/'.$key->file_surat); ?>" class = "btn btn-info btn-sm" target = "_blank"><i class="fa fa-file"></i></a></center>
                        <?php } ?>
                      </td>
                      <td style="text-align: left;">
                        <a href="<?php echo site_url('Compose/undangan_detail/'.$key->id_daftar_surat); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                        <a href="<?php echo site_url('Compose/export_undangan/'.$key->id_daftar_surat); ?>" class = "btn btn-primary btn-sm" title = "Unduh"><li class="fa fa-download"></li></a>
                        <?php if($key->status_surat == 1){ ?>
                          <a href="<?php echo site_url('Compose/undangan_edit/'.$key->id_daftar_surat); ?>" class = "btn btn-warning btn-sm" title = "Edit"><li class="fa fa-edit"></li></a>
                          <a href="#" data-id = "<?= $key->id_daftar_surat; ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?> 
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
          url: '<?php echo base_url('Compose/undangan_hapus/'); ?>/'+id,
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
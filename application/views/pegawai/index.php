<style type="text/css">
  th
  {
    text-align: center;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Data Pegawai / </li>
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
                <!-- <h3 class="card-title">Paket USMART</h3> -->
                <a href="<?php echo site_url('Pegawai/tambah'); ?>" class="btn btn-info"><li class = "fa fa-plus"></li> Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 3%">No</th>
                      <th>Nama Pegawai</th>
                      <th>ID Pegawai</th>
                      <th>Jabatan</th>
                      <th>Sub Bagian Unit Kerja</th>
                      <th>Bagian Unit Kerja</th>
                      <th>Unit Kerja</th>
                      <th>Lembaga</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($pegawai as $key) {
                    ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $no++; ?>.</td>
                      <td><?php echo $key->nama_pegawai; ?></td>
                      <td><?php echo $key->no_pegawai; ?></td>
                      <td><?php echo $key->nama_jabatan; ?></td>
                      <td><?php echo $key->nama_sub_bagian; ?></td>
                      <td><?php echo $key->nama_bagian; ?></td>
                      <td><?php echo $key->nama_unit_kerja; ?></td>
                      <td><?php echo $key->nama_instansi; ?></td>
                      <td><?php if($key->status == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; }?></td>
                      <td style="text-align: left;">
                        <a href="<?php echo site_url('Pegawai/detail/'.$key->id_data_pegawai); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                        <a href="<?php echo site_url('Pegawai/ubah/'.$key->id_data_pegawai); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                        <a href="#" data-id = "<?= $key->id_data_pegawai; ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
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
          url: '<?php echo base_url('Pegawai/hapus/'); ?>/'+id,
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
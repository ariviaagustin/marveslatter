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
            <h1>Data Golongan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Data Golongan / </li>
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
                <a href="<?php echo site_url('Master_data/golongan_tambah'); ?>" class="btn btn-info"><li class = "fa fa-plus"></li> Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%">No</th>
                      <th>Nama Golongan</th>
                      <th>Keterangan Golongan</th>
                      <th>Urutan</th>
                      <!-- <th>Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1; 
                      foreach ($golongan as $es) { ?>
                        <tr>
                            <td><?php echo $no++.'.'; ?></td>
                            <td><?php echo $es->nama_golongan; ?></td>
                            <td style="text-align: center;"><?php echo $es->ket_golongan; ?></td>
                            <td style="text-align: center;"><?php echo $es->urutan_golongan; ?></td>
                           <!--  <td></td> -->
                        </tr>
                    <?php }
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
          url: '<?php echo base_url('Bagian_unit_kerja/hapus/'); ?>/'+id,
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
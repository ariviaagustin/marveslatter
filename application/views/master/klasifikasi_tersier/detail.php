<style type="text/css">
  table
  {
    margin: 2%;
  }
  th
  {
    width: 20%;
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
            <h1>Detail Klasifikasi (Tersier)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/klasifikasi_tersier'); ?>">Master Klasifikasi</a></li>
              <li class="breadcrumb-item active">Detail Klasifikasi Tersier</li>
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
                <h3 class="card-title">Detail Klasifikasi Tersier</h3>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Klasifikasi Primer</th>
                  <td> : </td>
                  <td><?php echo $sekunder->klasifikasi; ?></td>
                </tr>
                <tr>
                  <th>Klasifikasi Sekunder</th>
                  <td> : </td>
                  <td><?php echo $sekunder->nama_sekunder; ?></td>
                </tr>
                <tr>
                  <th>Klasifikasi Tersier</th>
                  <td> : </td>
                  <td><?php echo $sekunder->nama_tersier; ?></td>
                </tr>
                <tr>
                  <th>Kode Tersier</th>
                  <td> : </td>
                  <td><?php echo $sekunder->kode_tersier; ?></td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td> : </td>
                  <td><?php if($sekunder->status_tersier == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></td>
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
  </div>
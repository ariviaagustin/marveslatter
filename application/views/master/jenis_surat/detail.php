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
            <h1>Detail Jenis Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/jenis_surat'); ?>">Jenis Surat</a></li>
              <li class="breadcrumb-item active">Detail Jenis Surat</li>
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
                <h3 class="card-title">Detail Jenis Surat</h3>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nama Jenis Surat</th>
                  <td> : </td>
                  <td><?= $jenis->nama_jenis_surat; ?></td>
                </tr>
                <tr>
                  <th>Digunakan Untuk</th>
                  <td> : </td>
                  <td><?php if($jenis->use_for == 1){ echo "Surat Masuk"; } else if($jenis->use_for == 2){ echo "Surat Keluar"; } else { echo "Surat Masuk dan Surat Keluar"; } ?></td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td> : </td>
                  <td><?php if($jenis->status_jenis_surat == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></td>
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
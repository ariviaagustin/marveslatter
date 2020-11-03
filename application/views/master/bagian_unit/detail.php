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
            <h1>Detail Bagian Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/bagian_unit_kerja'); ?>">Daftar Bagian Unit Kerja</a></li>
              <li class="breadcrumb-item active">Detail Bagian Unit Kerja</li>
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
                <h3 class="card-title">Detail Bagian Unit Kerja</h3>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nama Bagian Unit Kerja</th>
                  <td> : </td>
                  <td><?= $bagian->nama_bagian; ?></td>
                </tr>
                <tr>
                  <th>Unit Kerja</th>
                  <td> : </td>
                  <td>
                    <?php 
                      foreach ($unit as $key) 
                      {
                        if($bagian->id_unit_kerja == $key->id_unit_kerja)
                        {
                          echo $key->nama_unit_kerja;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Kode Bagian</th>
                  <td> : </td>
                  <td><?= $bagian->kode_bagian; ?></td>
                </tr>
                <tr>
                  <th>Urutan</th>
                  <td> : </td>
                  <td><?= $bagian->order_bagian; ?></td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td> : </td>
                  <td><?php if($bagian->status_bagian ==  1){echo "Aktif";} else {echo"Tidak Aktif"; } ?></td>
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
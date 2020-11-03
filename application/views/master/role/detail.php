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
            <h1>Detail Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/role'); ?>">Daftar Role</a></li>
              <li class="breadcrumb-item active">Detail Role</li>
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
                <h3 class="card-title">Detail Role</h3>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nama Role</th>
                  <td> : </td>
                  <td><?= $role->nama_role; ?></td>
                </tr>
                <tr>
                  <th>Alias</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($tingkat as $key) 
                      {
                        if($key->id_tingkat == $role->alias_role)
                        {
                          echo $key->nama_tingkat;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td> : </td>
                  <td><?php if($role->status_role == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></td>
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
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
            <h1>Detail Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Pegawai'); ?>">Daftar Pegawai</a></li>
              <li class="breadcrumb-item active">Detail Pegawai</li>
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
                <h3 class="card-title">Detail Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nama Pegawai</th>
                  <td> : </td>
                  <td><?= $pegawai->nama_pegawai; ?></td>
                </tr>
                <tr>
                  <th>ID Pegawai</th>
                  <td> : </td>
                  <td><?= $pegawai->no_pegawai; ?></td>
                </tr>
                <tr>
                  <th>NIK Pegawai</th>
                  <td> : </td>
                  <td><?= $pegawai->nik; ?></td>
                </tr>
                <tr>
                  <th>Alamat Pegawai</th>
                  <td> : </td>
                  <td><?= $pegawai->alamat_pegawai." ".$kel." ".$kec." ".$kab." ".$prov." ".$pegawai->kode_pos; ?></td>
                </tr>
                <tr>
                  <th>Tempat Lahir</th>
                  <td> : </td>
                  <td><?= $pegawai->tempat_lahir; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <td> : </td>
                  <td><?= $pegawai->tanggal_lahir; ?></td>
                </tr>
                <tr>
                  <th>Jabatan</th>
                  <td> : </td>
                  <td>
                    <?php 
                      foreach ($jabatan as $key) 
                      {
                        if($pegawai->jabatan == $key->id_jabatan)
                        {
                          echo $key->nama_jabatan;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Bagian Unit Kerja</th>
                  <td> : </td>
                  <td>
                    <?php 
                      foreach ($bagian as $key) 
                      {
                        if($pegawai->bagian_unit_kerja == $key->id_bag_unit_kerja)
                        {
                          echo $key->nama_bagian;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Unit Kerja</th>
                  <td> : </td>
                  <td>
                    <?php 
                      foreach ($unit_kerja as $key) 
                      {
                        if($pegawai->unit_kerja == $key->id_unit_kerja)
                        {
                          echo $key->nama_unit_kerja;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td> : </td>
                  <td><?php if($pegawai->status ==  1){echo "Aktif";} else {echo"Tidak Aktif"; } ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Foto Pegawai</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 10px">
                    <?php if(!empty($pegawai->foto_pegawai)){ ?>
                      <img src="<?= site_url('assets/img/pegawai/'.$pegawai->foto_pegawai); ?>" width = "80px">
                    <?php } ?>
                    <?php if(empty($pegawai->foto_pegawai)){ echo "Tidak Ada Foto"; } ?>
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
  </div>
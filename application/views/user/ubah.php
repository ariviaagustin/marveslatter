<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Data_user/'); ?>">Data User</a></li>
              <li class="breadcrumb-item active">Ubah User</li>
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
                <h3 class="card-title">Form Ubah User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Data_user/aksi_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama User</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_user" placeholder="Nama Lengkap User" value="<?= $user->nama_user; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_pegawai" placeholder="ID Pegawai" value="<?= $user->no_pegawai; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilih Role</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="role"  disabled="true">
                        <option selected="selected">Pilih Role</option>
                        <?php foreach ($role as $key) { ?>
                          <option value="<?php echo $key->id_role; ?>" <?php if($user->role == $key->id_role){ echo "selected"; } ?>><?php echo $key->nama_role; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tingkat</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="tingkat"  disabled="true">
                        <option selected="selected">Pilih Tingkat</option>
                        <?php foreach ($tingkat as $key) { ?>
                          <option value="<?php echo $key->id_tingkat; ?>" <?php if($key->id_tingkat == $user->tingkat){ echo "selected"; } ?>><?php echo $key->nama_tingkat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-sm-2">
                          <input type="radio" name="status_user" value="1" <?php if($user->status_user == 1){ echo "checked"; } ?>> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_user" value="2" <?php if($user->status_user == 2){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $user->username; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="konfirm" placeholder="Konfirmasi Password">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $user->id_user; ?>">
                  <input type="hidden" name="pass_old" value="<?= $user->password; ?>">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script type="text/javascript">
    window.onload = function () {
        document.getElementById("pass").onchange = validatePassword;
        document.getElementById("konfirm").onchange = validatePassword;
    }
    function validatePassword(){
        var pass2=document.getElementById("pass").value;
        var pass1=document.getElementById("konfirm").value;
        if(pass1!=pass2)
            document.getElementById("konfirm").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("konfirm").setCustomValidity('');
    }
</script>
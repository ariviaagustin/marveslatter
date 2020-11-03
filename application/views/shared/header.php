<!DOCTYPE html>
<html lang="en">
<?php
$uri = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MARVES-LETTER | Beranda</title>

  <link href="<?php echo base_url('assets/img/LogoKemenkoMaritim.PNG')?>" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <style type="text/css">
    [class*=sidebar-dark] .brand-link 
    {
      background: white;
      height: 57px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
          <div class="nav-link">
              <h6 style="color: black">
                <?php 
                  $role = $this->M_all->selectSemua('entitas__role')->result();
                  foreach ($role as $key) 
                  {
                    if($key->id_role == $this->session->userdata('role'))
                    {
                       echo $key->nama_role;
                    }
                  }
                ?>
              </h6>
          </div>
      </li>
      <li class="nav-item dropdown">
        <div class="nav-link">
          <h6 style="color: black">
            <?php
              if(str_word_count($this->session->userdata('nama_user')) > 2)
              {
                $kata = $this->session->userdata('nama_user');
                $nama = (explode(" ",$kata));
                echo $nama[0]." ".$nama[1];
              }
              else
              {
                echo $this->session->userdata('nama_user');
              }
            ?>
          </h6>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user" style="font-size: 25px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="<?php echo site_url('Login/logout'); ?>" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <i class="fas fa-sign-out-alt" style="font-size: 20px"></i>
              <div class="media-body" style="margin-left: 5%">
                <h3 class="dropdown-item-title">
                  Logout
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php 
        $role=$this->session->userdata('role');
        if($role==10){
          $link_beranda=site_url('Entry_surat'); 
        }else{
          $link_beranda=site_url('Beranda'); 
        }
    ?>
    <a href="<?php echo $link_beranda; ?>" class="brand-link">
      <img src="<?php echo site_url(); ?>assets/img/logo_marlet.png" alt="Logo" class="brand-image" style="width:80%; padding-left: 15px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            $role=$this->session->userdata('role');
            if($role==10){ ?>
            <li class="nav-header">MENU</li>
              <li class="nav-item">
                <a href="<?php echo site_url('Entry_surat'); ?>" class="nav-link <?php if(($uri=='Entry_surat' && $uri2=='')) echo 'active';?>">
                <i class="nav-icon fas fa-th"></i>
                <p>Entry Surat Masuk</p>
              </a>
            </li>
          <?php } ?>

          <?php 
              $role=$this->session->userdata('role');
              if($role<=9 || $role==11){ ?>

            <li class="nav-header">MENU</li>
            <li class="nav-item">
              <a href="<?php echo site_url('Beranda'); ?>" class="nav-link <?php if(($uri=='Beranda' && $uri2=='')) echo 'active';?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
          <?php } ?>

          <?php if($role==11){ ?>
            <li class="nav-item">
              <a href="<?php echo site_url('Entry_persuratan'); ?>" class="nav-link <?php if(($uri=='Entry_persuratan' && $uri2=='') || ($uri=='Entry_persuratan' && $uri2=='input') || ($uri=='Entry_persuratan' && $uri2=='kirim_surat')) echo 'active';?>">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Entry Identitas Surat</p>
              </a>
            </li>
          <?php } ?>

          <?php 
              $role=$this->session->userdata('role');
              if($role==1){ ?>

          <li class="nav-item">
            <a href="<?php echo site_url('Beranda/instansi'); ?>" class="nav-link <?php if(($uri=='Beranda' && $uri2=='instansi')) echo 'active';?>">
              <i class="nav-icon fas fa-university"></i>
              <p>Profil Instansi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Pegawai');?>" class="nav-link <?php if(($uri=='Pegawai' && $uri2=='') || ($uri=='Pegawai' && $uri2=='tambah') || ($uri=='Pegawai' && $uri2=='detail') || ($uri=='Pegawai' && $uri2=='ubah')) echo 'active';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Data Pegawai</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Data_user');?>" class="nav-link <?php if(($uri=='Data_user' && $uri2=='') || ($uri=='Data_user' && $uri2=='tambah') || ($uri=='Data_user' && $uri2=='detail') || ($uri=='Data_user' && $uri2=='ubah')) echo 'active';?>">
              <i class="nav-icon fas fa-user"></i>
              <p>Data User</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if(($uri=='Master_data' && $uri2=='unit_kerja') || ($uri=='Master_data' && $uri2=='unit_kerja_tambah') || ($uri=='Master_data' && $uri2=='unit_kerja_detail') || ($uri=='Master_data' && $uri2=='bagian_unit_kerja') || ($uri=='Master_data' && $uri2=='bagian_unit_tambah') || ($uri=='Master_data' && $uri2=='bagian_detail') || ($uri=='Master_data' && $uri2=='bagian_ubah') || ($uri=='Master_data' && $uri2=='sub_bagian_unit')  || ($uri=='Master_data' && $uri2=='sub_bagian_tambah') || ($uri=='Master_data' && $uri2=='eselon') || ($uri=='Master_data' && $uri2=='eselon_tambah') || ($uri=='Master_data' && $uri2=='golongan') || ($uri=='Master_data' && $uri2=='golongan_tambah') || ($uri=='Master_data' && $uri2=='jabatan') || ($uri=='Master_data' && $uri2=='jabatan_tambah') || ($uri=='Master_data' && $uri2=='jabatan_detail') || ($uri=='Master_data' && $uri2=='jabatan_ubah') || ($uri=='Master_data' && $uri2=='role') || ($uri=='Master_data' && $uri2=='role_tambah') || ($uri=='Master_data' && $uri2=='role_detail') || ($uri=='Master_data' && $uri2=='role_ubah') || ($uri=='Master_data' && $uri2=='jenis_surat') || ($uri=='Master_data' && $uri2=='jenis_surat_tambah') || ($uri=='Master_data' && $uri2=='jenis_surat_ubah') || ($uri=='Master_data' && $uri2=='jenis_surat_detail') || ($uri=='Master_data' && $uri2=='aksi') || ($uri=='Master_data' && $uri2=='aksi_tambah') || ($uri=='Master_data' && $uri2=='aksi_ubah') || ($uri=='Master_data' && $uri2=='aksi_detail') || ($uri=='Master_data' && $uri2=='sifat_surat') || ($uri=='Master_data' && $uri2=='sifat_surat_tambah') || ($uri=='Master_data' && $uri2=='sifat_surat_ubah') || ($uri=='Master_data' && $uri2=='sifat_surat_detail') || ($uri=='Master_data' && $uri2=='klasifikasi') || ($uri=='Master_data' && $uri2=='klasifikasi_tambah') || ($uri=='Master_data' && $uri2=='klasifikasi_ubah') || ($uri=='Master_data' && $uri2=='klasifikasi_detail') || ($uri=='Master_data' && $uri2=='klasifikasi_sekunder') || ($uri=='Master_data' && $uri2=='klasifikasi_sekunder_tambah') || ($uri=='Master_data' && $uri2=='klasifikasi_sekunder_ubah') || ($uri=='Master_data' && $uri2=='klasifikasi_sekunder_detail') || ($uri=='Master_data' && $uri2=='klasifikasi_tersier') || ($uri=='Master_data' && $uri2=='klasifikasi_tersier_tambah') || ($uri=='Master_data' && $uri2=='klasifikasi_tersier_ubah') || ($uri=='Master_data' && $uri2=='klasifikasi_tersier_detail') || ($uri=='Master_data' && $uri2=='keaslian') || ($uri=='Master_data' && $uri2=='keaslian_tambah') || ($uri=='Master_data' && $uri2=='keaslian_ubah') || ($uri=='Master_data' && $uri2=='keaslian_detail') || ($uri=='Master_data' && $uri2=='keamanan') || ($uri=='Master_data' && $uri2=='keamanan_tambah') || ($uri=='Master_data' && $uri2=='keamanan_ubah') || ($uri=='Master_data' && $uri2=='keamanan_detail') || ($uri=='Master_data' && $uri2=='jenis_tugas') || ($uri=='Master_data' && $uri2=='jenis_tugas_tambah') || ($uri=='Master_data' && $uri2=='jenis_tugas_ubah') || ($uri=='Master_data' && $uri2=='jenis_tugas_detail') || ($uri=='Master_data' && $uri2=='moda_transport') || ($uri=='Master_data' && $uri2=='moda_transport_tambah') || ($uri=='Master_data' && $uri2=='moda_transport_ubah') || ($uri=='Master_data' && $uri2=='moda_transport_detail') || ($uri=='Master_data' && $uri2=='agama') || ($uri=='Master_data' && $uri2=='pendidikan')) echo 'active';?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/unit_kerja');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/bagian_unit_kerja');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bagian Unit Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/sub_bagian_unit');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Bagian Unit Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/eselon');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eselon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/golongan');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Golongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/jabatan');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/role');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/jenis_surat'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/aksi'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aksi Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/sifat_surat'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sifat Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/klasifikasi'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Klasifikasi (Primer)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/klasifikasi_sekunder'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Klasifikasi (Sekunder)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/klasifikasi_tersier'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Klasifikasi (Tersier)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/keaslian'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keaslian Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/keamanan'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keamanan Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/jenis_tugas'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Tugas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/moda_transport'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Moda Transport</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/agama'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Master_data/pendidikan'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendidikan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($role <= 9) { ?>
          <li class="nav-header">SURAT</li>
          <li class="nav-item">
            <a href="<?php echo site_url('Inbox');?>" class="nav-link <?php if(($uri=='Inbox' && $uri2=='') || ($uri=='Inbox' && $uri2=='detail')) echo 'active';?>">
              <i class="nav-icon fas fa-inbox"></i>
              <p>Inbox</p>
            </a>
          </li> 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if(($uri=='Surat_internal' && $uri2=='') || ($uri=='Surat_internal' && $uri2=='tambah_surat_keluar') || ($uri=='Surat_internal' && $uri2=='detail')) echo 'active';?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Entry Surat Internal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Surat_internal'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if(($uri=='Surat_eksternal_masuk' && $uri2=='') || ($uri=='Surat_eksternal_masuk' && $uri2=='tambah') || ($uri=='Surat_eksternal_masuk' && $uri2=='detail') || ($uri=='Surat_eksternal_keluar' && $uri2=='') || ($uri=='Surat_eksternal_keluar' && $uri2=='tambah') || ($uri=='Surat_eksternal_keluar' && $uri2=='ubah') || ($uri=='Surat_eksternal_keluar' && $uri2=='detail') ) echo 'active';?>">
              <i class="nav-icon far fa-envelope-open"></i>
              <p>
                Entry Surat Eksternal
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Surat_eksternal_masuk');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Surat_eksternal_keluar');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if(($uri=='Compose' && $uri2=='') || ($uri=='Compose' && $uri2=='notadinas_tambah') || ($uri=='Compose' && $uri2=='notadinas_detail') || ($uri=='Compose' && $uri2=='notadinas_edit') || ($uri=='Compose' && $uri2=='surat') || ($uri=='Compose' && $uri2=='surat_tambah') || ($uri=='Compose' && $uri2=='surat_detail') || ($uri=='Compose' && $uri2=='surat_ubah') || ($uri=='Compose' && $uri2=='surattugas') || ($uri=='Compose' && $uri2=='surattugas_tambah') || ($uri=='Compose' && $uri2=='surattugas_detail') || ($uri=='Compose' && $uri2=='surattugas_edit') || ($uri=='Compose' && $uri2=='undangan') | ($uri=='Compose' && $uri2=='undangan_tambah') || ($uri=='Compose' && $uri2=='undangan_detail') || ($uri=='Compose' && $uri2=='undangan_edit') || ($uri=='Surat_eksternal' && $uri2=='') || ($uri=='Surat_eksternal' && $uri2=='detail') || ($uri=='Surat_eksternal' && $uri2=='tambah') || ($uri=='Surat_eksternal' && $uri2=='ubah') || ($uri=='Undangan_eksternal' && $uri2=='') || ($uri=='Undangan_eksternal' && $uri2=='tambah') || ($uri=='Undangan_eksternal' && $uri2=='detail') || ($uri=='Undangan_eksternal' && $uri2=='ubah')) echo 'active';?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Compose
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Internal
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo site_url('Compose'); ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Nota Dinas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo site_url('Compose/surat'); ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Surat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo site_url('Compose/surattugas'); ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Surat Tugas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo site_url('Compose/undangan'); ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Undangan</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Eksternal
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo site_url('Surat_eksternal');?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Surat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo site_url('Undangan_eksternal');?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Undangan</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Report');?>" class="nav-link <?php if(($uri=='Report' && $uri2=='') ) echo 'active';?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Report</p>
            </a>
          </li> 
        <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
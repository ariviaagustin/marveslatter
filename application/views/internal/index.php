<style type="text/css">
  th
  {
    text-align: center;
  }
  .box{
    background-color: #007bff;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt; 
    color: white;
    margin-top: 5px;
  } 
</style>
 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Surat Internal - Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Surat Internal - Surat Keluar / </li>
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
            <?php echo $this->session->flashdata('msg2');?>
            <div class="card">
              <div class="card-header" style="text-align: right;">
                <a href="<?php echo site_url('Surat_internal/tambah_surat_keluar'); ?>" class="btn btn-info"><li class = "fa fa-plus"></li> Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%">No</th>
                      <th>Nomor Surat</th>
                      <th>Jenis Surat</th>
                      <th>Sifat Surat</th>
                      <th>Perihal</th>
                      <th>Pengirim</th>
                      <th>Tujuan Surat</th>
                      <th>Tembusan Surat</th>
                      <th style="width: auto">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $no=1;
                      foreach ($data as $key) { ?>                    
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $key->no_surat; ?></td>
                      <td><?php echo $key->nama_jenis_surat; ?></td>
                      <td><?php echo $key->nama_sifat_surat; ?></td>
                      <td><?php echo $key->perihal_surat; ?></td>
                      <td>
                        <?php 
                            $where = array('id_data_pegawai'=>$key->pengirim_surat);
                            $dt = $this->M_all->selectX('data_pegawai', $where)->row();
                            echo $dt->nama_jabatan.' - '.$dt->nama_pegawai;
                        ?>
                      </td>
                      <td>
                        <?php 
                          if($key->jenis_tujuan_surat==1){
                            $where1 = array('id_daftar_surat'=>$key->id_daftar_surat,'jenis_tujuan_surat'=>$key->jenis_tujuan_surat);
                            $data1 = $this->M_all->selectX('daftar_tujuan_surat', $where1)->result();
                            foreach ($data1 as $key1) {
                              $where2 = array('id_data_pegawai'=>$key1->tujuan_surat);
                              $dt2 = $this->M_all->selectX('data_pegawai', $where2)->row();
                              echo '- '.$dt2->nama_jabatan.' - '.$dt2->nama_pegawai.'<br>';
                            }
                          }else{
                            $where3 = array('id_daftar_surat'=>$key->id_daftar_surat,'jenis_tujuan_surat'=>$key->jenis_tujuan_surat);
                            $data3 = $this->M_all->selectX('daftar_tujuan_surat', $where3)->result();
                            foreach ($data3 as $key2) {
                              $where4 = array('id_jabatan'=>$key2->tujuan_surat);
                              $dt4 = $this->M_all->selectX('master_jabatan', $where4)->row();
                              echo '- '.$dt4->nama_jabatan.'<br>';
                            }
                          }
                        ?>
                      </td>
                      <td>
                        <?php 
                            $where5 = array('id_daftar_surat'=>$key->id_daftar_surat);
                            $data5 = $this->M_all->selectX('daftar_tembusan_surat', $where5)->result();
                            foreach ($data5 as $key3) {
                              $where6 = array('id_jabatan'=>$key3->tembusan);
                              $dt6 = $this->M_all->selectX('master_jabatan', $where6)->row();
                              echo '- '.$dt6->nama_jabatan.'<br>';
                            }
                        ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if($this->session->userdata('role')==1){ ?>
                            <a href="<?php echo site_url('Surat_internal/detail/'.$key->id_daftar_surat); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                            <a href="#" data-id = "<?= $key->id_daftar_surat; ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        <?php }else{ ?>
                            <a href="<?php echo site_url('Surat_internal/detail/'.$key->id_daftar_surat); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
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
          url: '<?php echo base_url('Surat_internal/hapus/'); ?>/'+id,
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
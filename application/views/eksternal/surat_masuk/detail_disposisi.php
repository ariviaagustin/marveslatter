<style type="text/css">
  table
  {
    margin: 2%;
  }
  th
  {
    width: 25%;
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
            <h1>Detail Surat Eksternal - Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal_masuk'); ?>">Daftar Surat Eksternal - Surat Masuk</a></li>
              <li class="breadcrumb-item active">Detail</li>
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
                <div class="row">
                  <div class="col-sm-6"><h3 class="card-title">Detail Surat Eksternal - Surat Masuk</h3></div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a href="<?php echo site_url('Surat_eksternal_masuk/cetak/').$detail_sem->id_sem;?>" target ="_blank" class="btn btn-info"><i class = "fa fa-print"></i> Cetak</a>

                    <?php if($detail_sem->status_sem=="4"){ ?>
                      <a href="#" class="btn btn-primary"><i class = "fa fa-envelope"></i> Selesai</a>
                    <?php }elseif($detail_sem->status_sem=="3"){ ?>
                      <a href="#" class="btn btn-success"><i class = "fa fa-share"></i> Disposisi II</a>
                    <?php }elseif($detail_sem->status_sem=="2"){ ?>
                      <a href="#" class="btn btn-warning"><i class = "fa fa-share"></i> Disposisi I</a>
                    <?php }else{ ?>
                      <a href="#" class="btn btn-danger"><i class = "fa fa-envelope"></i> Surat Masuk</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                    <th>Nomor Surat</th>
                    <td> : </td>
                    <td><?php echo $detail_sem->no_sem; ?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->perihal_sem; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->lampiran_sem; ?></td>
                </tr>
                <tr>
                  <th>Jenis Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_jenis_surat; ?></td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_sifat_surat; ?></td>
                </tr>
                <tr>
                  <th>Klasifikasi</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->kode_klasifikasi.' - '.$detail_sem->klasifikasi; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tanggal_sem); ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat Diterima</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($detail_sem->tanggal_sem_diterima);?></td>
                </tr>
                <tr>
                  <th>Asal Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->pengirim_sem; ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_jabatan.' - '.$detail_sem->nama_unit_kerja; ?></td>
                </tr>
                <tr>
                  <th>Keaslian Surat</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_keaslian; ?></td>
                </tr>
                <tr>
                  <th>Tingkat Pengamanan</th>
                  <td> : </td>
                  <td><?php echo $detail_sem->nama_tingkat_pengamanan; ?></td>
                </tr>
                <tr>
                  <th>File Attachment</th>
                  <td> : </td>
                  <td>
                    <?php 
                      if($detail_sem->tingkat_pengamanan_sem=='3' || $detail_sem->tingkat_pengamanan_sem=='4'){
                        echo "File Rahasia/Sangat Rahasia";
                      }else{ ?>
                        <a href="#" class="btn btn-primary btn-sm fl" data-id="<?php echo $detail_sem->id_sem ?>" title="File Attachment"><i class="fa fa-image fa-xs"></i> Lihat Attachment</a>
                        <a href="<?php echo site_url('Surat_eksternal_masuk/download/'.$detail_sem->id_sem); ?>" class="btn btn-success btn-sm" ><i class="fa fa-download"></i> Unduh File</a>
                     <?php } ?>
                  </td>
                </tr>
                
              </table>
                 <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">DETAIL DISPOSISI</h3>
                    </div>
                    <div class="card-body">
                      <!-- Minimal red style -->
                      <div class="row">
                          <div class="col-sm-12">
                            - Surat Dibuat oleh : 
                            <b>
                              <?php
                                  $id_user = $detail_sem->created_by;
                                  $query = $this->M_all->cek_user($id_user)->row();
                                  // var_dump($query);
                                  // die();
                                  echo $query->nama_pegawai.' - '.$query->nama_jabatan;
                              ?>
                            </b>
                            <br>
                            <?php 
                                $status = $detail_sem->status_sem;
                                $id_sem = $detail_sem->id_sem;
                                $cekdatafile = $this->M_all->ceksemfile($id_sem);
                                $hasilrow = $cekdatafile->row();

                                if($status=="4" AND (!isset($hasilrow))){ ?>
                                <?php  
                                  $id_sem = $detail_sem->id_sem;
                                  $where = array('id_sem'=>$id_sem);
                                  $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                  $no=1;
                                  foreach ($query2->result() as $q) {
                                    $a=$q->id_tujuan_sem;
                                    $b=$q->id_jenis_detail; ?>

                                    <?php if($b==1){ ?>

                                      - Surat ditujukan untuk :
                                      <b>
                                        <?php
                                            $query3 = $this->M_all->aktorjabatan($a)->row();
                                            echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>

                                    <?php }elseif($b==2){ ?>

                                      - Surat di disposisikan ke-<?php echo $no++;?> :
                                      <b>
                                        <?php 
                                            $c= $q->id_tujuan_sem;
                                            $query4 = $this->M_all->aktorjabatan($c)->row();
                                            echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>
                                    <?php }else{echo ""; } ?>
                                  <?php } ?>
                                <br>
                                <b>Hasil Aksi yang dikerjakan : </b>
                                <br>
                                <?php 
                                    $id_sem = $detail_sem->id_sem;
                                    $wherehsl = array('id_sem'=>$id_sem);
                                    $hasil = $this->M_all->selectX('disposisi_sem',$wherehsl);
                                    $no=1;
                                    foreach ($hasil->result() as $hsl) {
                                      $hsl_aksi=$hsl->aksi_dispo_sem;
                                      $nilai=$hsl->aksi_realisasi_;
                                      $aktor=$hsl->created_by;
                                      $whereaksi = array('id_aksi'=>$hsl_aksi);
                                      $aksi_data=$this->M_all->selectX('master_aksi',$whereaksi);

                                      foreach ($aksi_data->result() as $aksi_k) { ?>
                                        <?php 
                                            $id_user = $hsl->created_by;
                                            $user_data=$this->M_all->cek_user($id_user)->row();
                                        ?>

                                        <?php if($aksi_k->id_aksi == $hsl_aksi AND $nilai != NULL){ ?>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $aksi_k->id_aksi; ?>" <?php if($aksi_k->id_aksi == $hsl_aksi AND $nilai != NULL){ echo "Checked"; } ?> style="width: 30px; height: 30px;" name="aksi_realisasi[]" disabled>
                                            <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi.' - Dikerjakan oleh '.$user_data->nama_pegawai.' , '.$user_data->nama_jabatan; ?></label>
                                          </div>
                                          <br>
                                        <?php }else{ ?>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $aksi_k->id_aksi; ?>"style="width: 30px; height: 30px;" name="aksi_realisasi[]" disabled>
                                            <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi; ?></label>
                                          </div>
                                          <br>
                                        <?php } ?>
                                          

                                      <?php } ?>

                                    <?php } ?> 

                               <?php }elseif($status=="4" AND (isset($hasilrow))){ ?>
                                  <?php
                                      $a=$detail_sem->aksi_realisasi;
                                      if($a==NULL){ ?>
                                        <?php  
                                            $id_sem = $detail_sem->id_sem;
                                            $where = array('id_sem'=>$id_sem);
                                            $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                            $no=1;
                                            foreach ($query2->result() as $q) {
                                              $a=$q->id_tujuan_sem;
                                              $b=$q->id_jenis_detail; ?>

                                              <?php if($b==1){ ?>

                                                - Surat ditujukan untuk :
                                                <b>
                                                  <?php
                                                      $query3 = $this->M_all->aktorjabatan($a)->row();
                                                      echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                                  ?>
                                                </b>
                                                <br>

                                              <?php }elseif($b==2){ ?>

                                                - Surat di disposisikan ke-<?php echo $no++;?> :
                                                <b>
                                                  <?php 
                                                      $c= $q->id_tujuan_sem;
                                                      $query4 = $this->M_all->aktorjabatan($c)->row();
                                                      echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                                  ?>
                                                </b>
                                                <br>
                                              <?php }else{echo ""; } ?>
                                            <?php } ?>
                                          <br>
                                          <b>Hasil Aksi yang dikerjakan : Tidak Ada Disposisi</b>
                                          <br>
                                          <h6 style="margin-top: 10px; font-weight: bold;">File Evidence yang diunggah : </h6>
                                          <?php
                                              $id_sem = $detail_sem->id_sem;
                                              $cekdatafile = $this->M_all->ceksemfile($id_sem);
                                              $hasilrow = $cekdatafile->row();
                                              if($hasilrow->file_evidence==NULL){
                                                echo "Tidak Ada";
                                              }else{ ?>

                                                <a href="#" class="btn btn-primary btn-sm evidence" data-id="<?php echo $hasilrow->id_file ?>" title="File Attachment"><i class="fa fa-image fa-xs"></i> Lihat Evidence</a>
                                                <a href="<?php echo site_url('Surat_eksternal_masuk/download_evidence/'.$hasilrow->id_file); ?>" class="btn btn-success btn-sm" ><i class="fa fa-download"></i> Unduh Evidence</a>

                                              <?php } ?>

                                      <?php }else{ ?>

                                          <?php  
                                              $id_sem = $detail_sem->id_sem;
                                              $where = array('id_sem'=>$id_sem);
                                              $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                              $no=1;
                                              foreach ($query2->result() as $q) {
                                                $a=$q->id_tujuan_sem;
                                                $b=$q->id_jenis_detail; ?>

                                                <?php if($b==1){ ?>

                                                  - Surat ditujukan untuk :
                                                  <b>
                                                    <?php
                                                        $query3 = $this->M_all->aktorjabatan($a)->row();
                                                        echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                                    ?>
                                                  </b>
                                                  <br>

                                                <?php }elseif($b==2){ ?>

                                                  - Surat di disposisikan ke-<?php echo $no++;?> :
                                                  <b>
                                                    <?php 
                                                        $c= $q->id_tujuan_sem;
                                                        $query4 = $this->M_all->aktorjabatan($c)->row();
                                                        echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                                    ?>
                                                  </b>
                                                  <br>
                                                <?php }else{echo ""; } ?>
                                              <?php } ?>
                                            <br>
                                            <b>Hasil Aksi yang dikerjakan : </b>
                                            <br>
                                            <?php 
                                                $id_sem = $detail_sem->id_sem;
                                                $wherehsl = array('id_sem'=>$id_sem);
                                                $hasil = $this->M_all->selectX('disposisi_sem',$wherehsl);
                                                $no=1;
                                                foreach ($hasil->result() as $hsl) {
                                                  $hsl_aksi=$hsl->aksi_dispo_sem;
                                                  $nilai=$hsl->aksi_realisasi_;
                                                  $aktor=$hsl->created_by;
                                                  $whereaksi = array('id_aksi'=>$hsl_aksi);
                                                  $aksi_data=$this->M_all->selectX('master_aksi',$whereaksi);

                                                  foreach ($aksi_data->result() as $aksi_k) { ?>
                                                    <?php 
                                                        $id_user = $hsl->created_by;
                                                        $user_data=$this->M_all->cek_user($id_user)->row();
                                                    ?>
                                                      <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $aksi_k->id_aksi; ?>" <?php if($aksi_k->id_aksi == $hsl_aksi AND $nilai != NULL){ echo "Checked"; } ?> style="width: 30px; height: 30px;" name="aksi_realisasi[]" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi.' - Dikerjakan oleh '.$user_data->nama_pegawai.' , '.$user_data->nama_jabatan; ?></label>
                                                      </div>
                                                      <br>

                                                  <?php } ?>
                                                <?php } ?>

                                            <h6 style="margin-top: 10px; font-weight: bold;">File Evidence yang diunggah : </h6>
                                            <?php
                                                $id_sem = $detail_sem->id_sem;
                                                $cekdatafile = $this->M_all->ceksemfile($id_sem);
                                                $hasilrow = $cekdatafile->row();
                                                if($hasilrow->file_evidence==NULL){
                                                  echo "Tidak Ada";
                                                }else{ ?>

                                                  <a href="#" class="btn btn-primary btn-sm evidence" data-id="<?php echo $hasilrow->id_file ?>" title="File Attachment"><i class="fa fa-image fa-xs"></i> Lihat Evidence</a>
                                                  <a href="<?php echo site_url('Surat_eksternal_masuk/download_evidence/'.$hasilrow->id_file); ?>" class="btn btn-success btn-sm" ><i class="fa fa-download"></i> Unduh Evidence</a>
                                                <?php } ?>
                                      <?php } ?>
                                  

                               <?php }elseif($status=="3"){ ?>

                                  <?php  
                                  $id_sem = $detail_sem->id_sem;
                                  $where = array('id_sem'=>$id_sem);
                                  $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                  $no=1;
                                  foreach ($query2->result() as $q) {
                                    $a=$q->id_tujuan_sem;
                                    $b=$q->id_jenis_detail; ?>

                                    <?php if($b==1){ ?>

                                      - Surat ditujukan untuk :
                                      <b>
                                        <?php
                                            $query3 = $this->M_all->aktorjabatan($a)->row();
                                            echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>

                                    <?php }elseif($b==2){ ?>

                                      - Surat di disposisikan ke-<?php echo $no++;?> :
                                      <b>
                                        <?php 
                                            $c= $q->id_tujuan_sem;
                                            $query4 = $this->M_all->aktorjabatan($c)->row();
                                            echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>
                                    <?php }else{echo ""; } ?>
                                  <?php } ?>
                                <br>
                                <b>Hasil Aksi yang dikerjakan : </b>
                                <br>
                                <?php 
                                    $id_sem = $detail_sem->id_sem;
                                    $wherestat3 = array('id_sem'=>$id_sem, 'created_at!='=>NULL, 'created_BY!='=>NULL);
                                    $hasil = $this->M_all->selectX('disposisi_sem',$wherestat3);
                                    $no=1;
                                    foreach ($hasil->result() as $hsl) {
                                      $hsl_aksi=$hsl->aksi_dispo_sem;
                                      $nilai=$hsl->aksi_realisasi_;
                                      $aktor=$hsl->created_by;
                                      $whereaksi = array('id_aksi'=>$hsl_aksi);
                                      $aksi_data=$this->M_all->selectX('master_aksi',$whereaksi);

                                      foreach ($aksi_data->result() as $aksi_k) { ?>
                                        <?php 
                                            $id_user = $hsl->created_by;
                                            $user_data=$this->M_all->cek_user($id_user)->row();
                                        ?>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $aksi_k->id_aksi; ?>" <?php if($aksi_k->id_aksi == $hsl_aksi AND $nilai != NULL){ echo "Checked"; } ?> style="width: 30px; height: 30px;" name="aksi_realisasi[]" disabled>
                                            <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi.' - Dikerjakan oleh '.$user_data->nama_pegawai.' , '.$user_data->nama_jabatan; ?></label>
                                          </div>
                                          <br>

                                      <?php } ?>

                                    <?php } ?> 


                              <?php }elseif($status=="2"){ ?>

                                  <?php  
                                  $id_sem = $detail_sem->id_sem;
                                  $where = array('id_sem'=>$id_sem);
                                  $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                  $no=1;
                                  foreach ($query2->result() as $q) {
                                    $a=$q->id_tujuan_sem;
                                    $b=$q->id_jenis_detail; ?>

                                    <?php if($b==1){ ?>

                                      - Surat ditujukan untuk :
                                      <b>
                                        <?php
                                            $query3 = $this->M_all->aktorjabatan($a)->row();
                                            echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>

                                    <?php }elseif($b==2){ ?>

                                      - Surat di disposisikan ke-<?php echo $no++;?> :
                                      <b>
                                        <?php 
                                            $c= $q->id_tujuan_sem;
                                            $query4 = $this->M_all->aktorjabatan($c)->row();
                                            echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>
                                    <?php }else{echo ""; } ?>
                                  <?php } ?>
                                <br>
                                <b>Hasil Aksi yang dikerjakan : </b>
                                <br>
                                <?php 
                                    $id_sem = $detail_sem->id_sem;
                                    $wherestat3 = array('id_sem'=>$id_sem, 'created_at!='=>NULL, 'created_BY!='=>NULL);
                                    $hasil = $this->M_all->selectX('disposisi_sem',$wherestat3);
                                    $no=1;
                                    foreach ($hasil->result() as $hsl) {
                                      $hsl_aksi=$hsl->aksi_dispo_sem;
                                      $nilai=$hsl->aksi_realisasi_;
                                      $aktor=$hsl->created_by;
                                      $whereaksi = array('id_aksi'=>$hsl_aksi);
                                      $aksi_data=$this->M_all->selectX('master_aksi',$whereaksi);

                                      foreach ($aksi_data->result() as $aksi_k) { ?>
                                        <?php 
                                            $id_user = $hsl->created_by;
                                            $user_data=$this->M_all->cek_user($id_user)->row();
                                        ?>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $aksi_k->id_aksi; ?>" <?php if($aksi_k->id_aksi == $hsl_aksi AND $nilai != NULL){ echo "Checked"; } ?> style="width: 30px; height: 30px;" name="aksi_realisasi[]" disabled>
                                            <label class="form-check-label" for="inlineCheckbox1"><?php echo $aksi_k->aksi.' - Dikerjakan oleh '.$user_data->nama_pegawai.' , '.$user_data->nama_jabatan; ?></label>
                                          </div>
                                          <br>

                                      <?php } ?>

                                    <?php } ?> 

                              <?php }else{ ?>

                                <?php  
                                  $id_sem = $detail_sem->id_sem;
                                  $where = array('id_sem'=>$id_sem);
                                  $query2 = $this->M_all->selectX('tbl_sem_detail',$where);
                                  $no=1;
                                  foreach ($query2->result() as $q) {
                                    $a=$q->id_tujuan_sem;
                                    $b=$q->id_jenis_detail; ?>

                                    <?php if($b==1){ ?>

                                      - Surat ditujukan untuk :
                                      <b>
                                        <?php
                                            $query3 = $this->M_all->aktorjabatan($a)->row();
                                            echo $query3->nama_jabatan.' - '.$query3->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>

                                    <?php }elseif($b==2){ ?>

                                      - Surat di disposisikan ke-<?php echo $no++;?> :
                                      <b>
                                        <?php 
                                            $c= $q->id_tujuan_sem;
                                            $query4 = $this->M_all->aktorjabatan($c)->row();
                                            echo $query4->nama_jabatan.' - '.$query4->nama_unit_kerja;
                                        ?>
                                      </b>
                                      <br>
                                    <?php }else{echo ""; } ?>
                                  <?php } ?>
                                <br>

                              <?php } ?>
                          </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lampiran Surat Eksternal Masuk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-xl-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lampiran Evidence</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <?php
   function indonesian_date ($timestamp = '', $date_format = 'd F Y ', $suffix = '') {
      //$timestamp = '', $date_format = 'l, d F Y | H:i', $suffix = 'WIB'
          if (trim ($timestamp) == '')
          {
                  $timestamp = time ();
          }
          elseif (!ctype_digit ($timestamp))
          {
              $timestamp = strtotime ($timestamp);
          }
          # remove S (st,nd,rd,th) there are no such things in indonesia :p
          $date_format = preg_replace ("/S/", "", $date_format);
          $pattern = array (
              '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
              '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
              '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
              '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
              '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
              '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
              '/April/','/June/','/July/','/August/','/September/','/October/',
              '/November/','/December/',
          );
          $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
              'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
              'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
              'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
              'Oktober','November','Desember',
          );
          $date = date ($date_format, $timestamp);
          $date = preg_replace ($pattern, $replace, $date);
          $date = "{$date} {$suffix}";
          return $date;
      }
?>
<script type="text/javascript">
  $(function () {
                $(document).on('click', '.fl', function (e) {
                    e.preventDefault();
                    $("#modal-xl").modal('show');
                    $.post('<?php echo site_url('Surat_eksternal_masuk/modal_file');?>',
                            {id_sem: $(this).attr('data-id')},
                    function (html) {
                        $(".modal-body").html(html);
                    }
                    );
                });
        });

  $(function () {
                $(document).on('click', '.evidence', function (e) {
                    e.preventDefault();
                    $("#modal-xl-1").modal('show');
                    $.post('<?php echo site_url('Surat_eksternal_masuk/modal_evidence');?>',
                            {id_file: $(this).attr('data-id')},
                    function (html) {
                        $(".modal-body").html(html);
                    }
                    );
                });
        });
</script>
<style type="text/css">
  .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable 
  {
    height: 200px;
  }
  .note-editor.note-airframe, .note-editor.note-frame 
  {
    width: 82%;
    margin-left: 1%;
  }
</style>
 
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Input Surat Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Unik ID</label>
                      <div class="col-sm-10">
                          <input type="text" name="no_ticket" class="form-control" value="<?php echo $data->no_ticket; ?>" readonly>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Dari</label>
                      <div class="col-sm-10">
                          <input type="text" name="dari_pengirim" class="form-control" value="<?php echo $data->dari_pengirim; ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kepada</label>
                      <div class="col-sm-10">
                          <input type="text" name="kepada_tujuan" class="form-control" value="<?php echo $data->kepada_tujuan; ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                      <div class="col-sm-10">
                          <input type="text" name="nomor_surat" class="form-control" value="<?php echo $data->nomor_surat; ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Diterima</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_diterima" class="form-control" value="<?php echo indonesian_date($data->tanggal_diterima); ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Yang Menyerahkan</label>
                      <div class="col-sm-10">
                          <input type="text" name="yang_menyerahkan" class="form-control" value="<?php echo $data->yang_menyerahkan; ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                          <?php if($data->status_input==0){ ?>
                              <span class="badge badge-warning" style="width: auto; min-height: 18px;">Draft - Menunggu Diteruskan</span>
                          <?php }elseif($data->status_input==1){ ?>
                              <span class="badge badge-success" style="width: auto; min-height: 18px;">Dibaca</span>
                          <?php }else{ ?>
                            <span class="badge badge-primary" style="width: auto; min-height: 18px;">Diteruskan</span>
                          <?php } ?>
                      </div>
                  </div>

                </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
<script src="<?php echo site_url(); ?>assets/new/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.js"></script>
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


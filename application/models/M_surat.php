<?php
  defined('BASEPATH') or exit('No direct Script access allowed');

  class M_surat extends CI_Model
  {
      public function suratkeluar_sik()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $where="id_internal_eksternal='1' AND id_surat_masuk_keluar='1' AND id_compose IS NULL";
        $this->db->where($where);
        return $this->db->get();
      } 

      public function pegawaijabatan()
      {
        $this->db->select('*');
        $this->db->from('data_pegawai');
        $this->db->join('master_jabatan','master_jabatan.id_jabatan=data_pegawai.jabatan');
        return $this->db->get();
      }

      public function tembusan()
      {
        $this->db->select('*');
        $this->db->from('master_jabatan');
        $this->db->join('master_unit_kerja','master_unit_kerja.id_unit_kerja=master_jabatan.id_unit_kerja');
        return $this->db->get();
      }

      public function detail_sik($id_daftar_surat)
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.pengirim_surat','inner');
        $this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat);
        return $this->db->get();
      }

      public function pegawai_jabatan($key){
        $this->db->select('*');
        $this->db->from('data_pegawai');
        $this->db->join('master_jabatan','master_jabatan.id_jabatan=data_pegawai.jabatan','inner');
        $this->db->where('data_pegawai.id_data_pegawai',$key);
        return $this->db->get();
      }

      public function jab_unit($tem){
        $this->db->select('*');
        $this->db->from('master_jabatan');
        $this->db->join('master_unit_kerja','master_unit_kerja.id_unit_kerja=master_jabatan.id_unit_kerja','inner');
        $this->db->join('master_bag_unit_kerja','master_bag_unit_kerja.id_bag_unit_kerja=master_jabatan.id_bagian_unit','left');
        $this->db->where('master_jabatan.id_jabatan',$tem);
        return $this->db->get();
      }

      public function download_sik($id_daftar_surat){
        $query = $this->db->get_where('daftar_surat',array('id_daftar_surat'=>$id_daftar_surat));
        return $query->row_array();
      }

       public function instansi($where){
        $this->db->select('*');
        $this->db->from('instansi');
        $this->db->join('entitas__provinsi','entitas__provinsi.id_provinsi=instansi.provinsi_instansi','inner');
        $this->db->join('entitas__kabupaten','entitas__kabupaten.id_kokab=instansi.kota_instansi','inner');
        $this->db->join('entitas__kecamatan','entitas__kecamatan.id_kecamatan=instansi.kecamatan_instansi','inner');
        $this->db->join('entitas__kelurahan','entitas__kelurahan.id_deskel=instansi.kelurahan_instansi','inner');
        $this->db->where('instansi.id',$where);
        return $this->db->get();
      }

      public function index_sek_admin(){
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $where="id_internal_eksternal='2' AND id_surat_masuk_keluar='1' AND id_compose is NULL";
        $this->db->where($where);
        return $this->db->get();
      }

      public function pegawai_jab()
      { 
        $this->db->select('*');
        $this->db->from('data_pegawai');
        $this->db->join('master_jabatan', 'master_jabatan.id_jabatan = data_pegawai.jabatan');
        $this->db->where('data_pegawai.status',1);
        $query = $this->db->get();
        return $query;
      }

      public function cekJabatan($jabatan){
        $sql = "SELECT *
              FROM surat_eksternal_masuk
              inner join tbl_sem_detail on tbl_sem_detail.id_sem = surat_eksternal_masuk.id_sem
              WHERE tbl_sem_detail.id_tujuan_sem = '$jabatan'";
              return $this->db->query($sql);
      }

      public function suratmasuk_sem()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $where="id_internal_eksternal='2' AND id_surat_masuk_keluar='2' AND id_compose IS NULL";
        $this->db->where($where);
        $this->db->order_by('daftar_surat.id_daftar_surat','DESC');
        return $this->db->get(); 
      }

      public function detail_sem($id_daftar_surat)
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('master_tingkat_pengamanan','master_tingkat_pengamanan.id_tingkat_pengamanan=daftar_surat.tingkat_pengamanan','inner');
        $this->db->join('master_keaslian','master_keaslian.id_keaslian=daftar_surat.keaslian_surat','inner');
        $this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat);
        return $this->db->get();
      }

      public function data_daftar_surat()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->order_by('daftar_surat.id_daftar_surat','DESC');
        return $this->db->get();
      }

      public function daftar_surat_detail($id_daftar_surat)
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('jenis_surat','jenis_surat.id_jenis_surat=daftar_surat.jenis_surat','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat);
        return $this->db->get();
      }

      public function notadinas()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $where="daftar_surat.id_compose='1' AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
        $this->db->where($where);
        return $this->db->get();
      }

      public function notadinas_detail($id_daftar_surat){
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
         $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
        $this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat);
        return $this->db->get();
      }

      public function notadinas_export($id_daftar_surat){
        $this->db->select('id_daftar_surat, no_surat, perihal_surat, isi_surat, tgl_surat, nama_pegawai, master_jabatan.nama_jabatan, tembusan_surat');
        $this->db->from('daftar_surat');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
        $this->db->join('master_jabatan','master_jabatan.id_jabatan=daftar_surat.tujuan_surat_ke','inner');
        $this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat);
        return $this->db->get();
      }

      public function surat_internal()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $this->db->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $where="daftar_surat.id_compose='2' AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
      }

      public function jab_bag_unit()
      {
        $this->db->select('*');
        $this->db->from('master_jabatan');
        $this->db->join('master_bag_unit_kerja', 'master_jabatan.id_bagian_unit = master_bag_unit_kerja.id_bag_unit_kerja');
        $this->db->where('master_jabatan.status_jabatan',1);
        $this->db->where('master_bag_unit_kerja.status_bagian',1);
        $query = $this->db->get();
        return $query;
      }

      public function unit_bag_unit()
      {
        $this->db->select('*');
        $this->db->from('master_bag_unit_kerja');
        $this->db->join('master_unit_kerja', 'master_unit_kerja.id_unit_kerja = master_bag_unit_kerja.id_unit_kerja');
        $this->db->where('master_unit_kerja.status_unit_kerja',1);
        $this->db->where('master_bag_unit_kerja.status_bagian',1);
        $query = $this->db->get();
        return $query;
      }

       public function surattugas()
      {
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('daftar_surat_tugas','daftar_surat_tugas.id_daftar_surat=daftar_surat.id_daftar_surat','inner');
        $this->db->join('master_jenis_tugas','master_jenis_tugas.id_jenis_tugas=daftar_surat_tugas.jenis_tugas','inner');
        $this->db->join('entitas__kabupaten','entitas__kabupaten.id_kokab=daftar_surat_tugas.tujuan_tugas','inner');
        $where="daftar_surat.id_compose='3' AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
      }

      public function wilayah()
      {
        $this->db->select('*');
        $this->db->from('entitas__kabupaten');
        $this->db->join('entitas__provinsi','entitas__provinsi.id_provinsi=entitas__kabupaten.id_provinsi');
        return $this->db->get();
      }

      public function data_sti_print($config=array())
      {
            $defaults = array(  
               'id_daftar_surat' => NULL,                         
           );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }
            $this->db->select('*');
            $this->db->from('daftar_surat');
            $this->db->join('daftar_surat_tugas','daftar_surat_tugas.id_daftar_surat=daftar_surat.id_daftar_surat','inner');
            $this->db->join('master_jenis_tugas','master_jenis_tugas.id_jenis_tugas=daftar_surat_tugas.jenis_tugas','inner');
            $this->db->join('entitas__kabupaten','entitas__kabupaten.id_kokab=daftar_surat_tugas.tujuan_tugas','inner');
            $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');     
            $where = "id_compose='3' AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
            $this->db->where($where);
            
            if($id_sti){$this->db->where('daftar_surat.id_daftar_surat',$id_daftar_surat,'match');}
            $query = $this->db->get();
            return $query;
      }

      public function surattugas_detail($id_daftar_surat){
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('daftar_surat_tugas','daftar_surat_tugas.id_daftar_surat=daftar_surat.id_daftar_surat','inner');
        $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('master_jenis_tugas','master_jenis_tugas.id_jenis_tugas=daftar_surat_tugas.jenis_tugas','inner');
        $this->db->join('master_moda_transport','master_moda_transport.id_moda=daftar_surat_tugas.mode_transportasi','inner');
        $this->db->join('entitas__kabupaten','entitas__kabupaten.id_kokab=daftar_surat_tugas.tujuan_tugas','inner');
        $this->db->where('daftar_surat.id_daftar_surat', $id_daftar_surat);
        return $this->db->get();
      }

      public function pegawai_jabatan_2(){
        $this->db->select('*');
        $this->db->from('data_pegawai');
        $this->db->join('master_jabatan','master_jabatan.id_jabatan=data_pegawai.jabatan','inner');
        return $this->db->get();
      }

      public function modal_menimbang($id_daftar_surat){
        $this->db->select('*');
        $this->db->from('data_menimbang');
        $this->db->where('data_menimbang.id_daftar_surat', $id_daftar_surat);
        return $this->db->get();
      }

      public function modal_dasar($id_daftar_surat){
          $this->db->select('*');
          $this->db->from('data_dasar');
          $this->db->where('data_dasar.id_daftar_surat', $id_daftar_surat);
          return $this->db->get();
      }

      public function undangan()
      {
          $this->db->select('*');
          $this->db->from('daftar_surat');
          $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
          $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
          $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
          $where="id_compose='4' AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
          $this->db->where($where);
          return $this->db->get();
      }

      public function undangan_detail($id_daftar_surat){
        $this->db->select('*');
        $this->db->from('daftar_surat');
        $this->db->join('daftar_surat_undangan','daftar_surat_undangan.id_daftar_surat=daftar_surat.id_daftar_surat','inner');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
        $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
        $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
        $where="daftar_surat.id_daftar_surat='$id_daftar_surat'";
        $this->db->where($where);
        return $this->db->get();
      }

      public function surat_eksternal_compose()
      {
          $this->db->select('*');
          $this->db->from('daftar_surat');
          $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
          $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
          $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
          $where="id_compose='5' AND id_internal_eksternal='2' AND id_surat_masuk_keluar='1'";
          $this->db->where($where);
          return $this->db->get();
      }

      public function data_undangan_eks_co()
      {
          $this->db->select('*');
          $this->db->from('daftar_surat');
          $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=daftar_surat.klasifikasi_surat','inner');
          $this->db->join('data_pegawai','data_pegawai.id_data_pegawai=daftar_surat.penandatangan','inner');
          $this->db->join('master_sifat_surat','master_sifat_surat.id_sifat_surat=daftar_surat.sifat_surat','inner');
          $where="id_compose='6' AND id_internal_eksternal='2' AND id_surat_masuk_keluar='1'";
          $this->db->where($where);
          return $this->db->get();
      }

      public function jmlh_ski(){
        $query = "SELECT * FROM daftar_surat where id_compose IS NULL AND id_internal_eksternal='1' AND id_surat_masuk_keluar='1'";
        $result = $this->db->query($query);
        return $result->num_rows();
      }

      public function jmlh_sme(){
            $query = "SELECT * FROM daftar_surat where id_compose IS NULL AND id_internal_eksternal='2' AND id_surat_masuk_keluar='2'";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function jmlh_ske(){
            $query = "SELECT * FROM daftar_surat where id_compose IS NULL AND id_internal_eksternal='2' AND id_surat_masuk_keluar='1'";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function jmlh_srt(){
            $query = "SELECT * FROM daftar_surat where (id_compose='2' OR id_compose='5')";
            $result = $this->db->query($query);
            return $result->num_rows();
      }
      public function jmlh_nd(){
            $query = "SELECT * FROM daftar_surat where (id_compose='1')";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function jmlh_st(){
            $query = "SELECT * FROM daftar_surat where (id_compose='3')";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function jmlh_u(){
            $query = "SELECT * FROM daftar_surat where (id_compose='4' OR id_compose='6')";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function data_input_surat($id_user)
      {
          $this->db->select('*');
          $this->db->from('daftar_input_surat');
          $this->db->where('daftar_input_surat.created_by',$id_user);
          $this->db->order_by('daftar_input_surat.id_daftar_input','DESC');
          return $this->db->get();
      }
      public function modal_detail_surat($id_daftar_input)
      {
          $this->db->select('*');
          $this->db->from('daftar_input_surat');
          $this->db->where('daftar_input_surat.id_daftar_input',$id_daftar_input);
          return $this->db->get();
      }

      public function jmlh_entry_all($id_user){
            $query = "SELECT * FROM daftar_input_surat where created_by='$id_user'";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function jmlh_entry_all_user(){
            $query = "SELECT * FROM daftar_input_surat";
            $result = $this->db->query($query);
            return $result->num_rows();
      }

      public function data_input_masuk()
      {
          $this->db->select('*');
          $this->db->from('daftar_input_surat');
          $this->db->order_by('daftar_input_surat.id_daftar_input','DESC');
          return $this->db->get();
      }

      public function daftar_kirim_surat($id_daftar_input)
      {
          $this->db->select('*');
          $this->db->from('daftar_surat');
          $this->db->where('daftar_surat.id_daftar_input', $id_daftar_input);
          return $this->db->get();
      }

      function getkodeunik() { 
            $kodejadi = rand(10000,99999)."TND".time();
            return $kodejadi;
      }


          


  }
?>

<?php
  defined('BASEPATH') or exit('No direct Script access allowed');

  class M_master extends CI_Model
  {
      public function data_pegawai(){
          $this->db->select('*');
          $this->db->from('data_pegawai');
          $this->db->join('instansi', 'instansi.id=data_pegawai.id_instansi', 'left');
          $this->db->join('master_unit_kerja', 'master_unit_kerja.id_unit_kerja=data_pegawai.unit_kerja', 'left');
          $this->db->join('master_bag_unit_kerja', 'master_bag_unit_kerja.id_bag_unit_kerja=data_pegawai.bagian_unit_kerja', 'left');
          $this->db->join('master_sub_bagian', 'master_sub_bagian.id_sub_bagian=data_pegawai.sub_bagian_unit', 'left');
          return $this->db->get();
      }

      function getunit($id_instansi){
            $query="SELECT * FROM `master_unit_kerja` where master_unit_kerja.id_instansi='$id_instansi' AND status_unit_kerja='1'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
      }

      function get_jabatan_unit($id_instansi, $id_unit_kerja){
            $query="SELECT * FROM `master_jabatan` where (master_jabatan.id_instansi='$id_instansi' AND master_jabatan.id_unit_kerja IS NULL) or (master_jabatan.id_instansi='$id_instansi' AND master_jabatan.id_unit_kerja='$id_unit_kerja')";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
      }

      function get_jabatan($id_instansi, $id_unit_kerja, $id_bagian_unit){
            $query="SELECT * FROM `master_jabatan` where master_jabatan.id_instansi='$id_instansi' OR master_jabatan.id_unit_kerja='$id_unit_kerja' OR master_jabatan.id_bagian_unit='$id_bagian_unit'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
      }

      public function data_user(){
            $this->db->select('id_user, nama_user, user.id_pegawai, user.no_pegawai, username, nama_jabatan, status_user, role');
            $this->db->from('user');
            $this->db->join('data_pegawai', 'data_pegawai.id_data_pegawai=user.id_pegawai','inner');
            return $this->db->get();
      }

      function get_jabatan_user($role){
            $query="SELECT * FROM `master_jabatan` INNER JOIN master_eselon ON master_eselon.id_eselon = master_jabatan.eselon_id where master_eselon.tingkat_eselon='$role'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
      }

      public function data_unit_kerja(){
            $this->db->select('nama_instansi, id_unit_kerja, id_instansi, nama_unit_kerja, kode_unit_kerja, order_unit_kerja, status_unit_kerja');
            $this->db->from('master_unit_kerja');
            $this->db->join('instansi', 'instansi.id=master_unit_kerja.id_instansi', 'inner');
            return $this->db->get();
      }

      public function data_subbagian(){
            $this->db->select('nama_instansi, nama_unit_kerja, nama_bagian, nama_sub_bagian, kode_sub_bagian, order_sub_bagian, status_sub_bagian, id_sub_bagian');
            $this->db->from('master_sub_bagian');
            $this->db->join('instansi', 'instansi.id=master_sub_bagian.id_instansi', 'inner');
            $this->db->join('master_unit_kerja', 'master_unit_kerja.id_unit_kerja=master_sub_bagian.id_unit_kerja', 'inner');
            $this->db->join('master_bag_unit_kerja', 'master_bag_unit_kerja.id_bag_unit_kerja=master_sub_bagian.id_bagian_unit', 'inner');
            return $this->db->get();
      }

      function get_bagian_unit($id_instansi, $id_unit_kerja){
            $query="SELECT * FROM `master_bag_unit_kerja` where master_bag_unit_kerja.id_instansi='$id_instansi' AND master_bag_unit_kerja.id_unit_kerja='$id_unit_kerja' AND status_bagian='1'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
      }

      public function data_eselon(){
            $this->db->select('nama_eselon, nama_role, master_eselon.ket_eselon, id_eselon');
            $this->db->from('master_eselon');
            $this->db->join('entitas__role', 'entitas__role.id_role=master_eselon.tingkat_eselon', 'inner');
            $this->db->where('status_eselon',1);
            return $this->db->get();
      }

      public function data_jabatan(){
            $this->db->select('nama_instansi, nama_jabatan, nama_unit_kerja, nama_bagian, nama_sub_bagian, id_jabatan, status_jabatan');
            $this->db->from('master_jabatan');
            $this->db->join('instansi', 'instansi.id=master_jabatan.id_instansi', 'left');
            $this->db->join('master_unit_kerja', 'master_unit_kerja.id_unit_kerja=master_jabatan.id_unit_kerja', 'left');
            $this->db->join('master_bag_unit_kerja', 'master_bag_unit_kerja.id_bag_unit_kerja=master_jabatan.id_bagian_unit', 'left');
            $this->db->join('master_sub_bagian', 'master_sub_bagian.id_sub_bagian=master_jabatan.id_sub_bagian', 'left');
            $this->db->where('status_jabatan',1);
            return $this->db->get();
      }

      function get_sub_bagian($id_instansi, $id_unit_kerja, $id_bagian_unit){
            $query="SELECT * FROM `master_sub_bagian` where master_sub_bagian.id_instansi='$id_instansi' AND master_sub_bagian.id_unit_kerja='$id_unit_kerja' AND master_sub_bagian.id_bagian_unit='$id_bagian_unit' AND status_sub_bagian='1'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
    }

    public function data_sekunder($id_sekunder)
    {
        $this->db->select('*');
        $this->db->from('master_klasifikasi_sekunder');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=master_klasifikasi_sekunder.id_klasifikasi','inner');
        $this->db->where('master_klasifikasi_sekunder.id_sekunder', $id_sekunder);
        return $this->db->get();
    }

    function getsekunder($id_klasifikasi){
            $query="SELECT * FROM `master_klasifikasi_sekunder` where master_klasifikasi_sekunder.id_klasifikasi ='$id_klasifikasi'";
            $q=$this->db->query($query);    
            if ($q->num_rows() > 0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
    }

    public function data_tersier($id_tersier)
    {
        $this->db->select('*');
        $this->db->from('master_klasifikasi_tersier');
        $this->db->join('master_klasifikasi','master_klasifikasi.id_klasifikasi=master_klasifikasi_tersier.id_klasifikasi','inner');
        $this->db->join('master_klasifikasi_sekunder','master_klasifikasi_sekunder.id_sekunder=master_klasifikasi_tersier.id_sekunder','inner');
        $this->db->where('master_klasifikasi_tersier.id_tersier', $id_tersier);
        return $this->db->get();
    }

      







  }
?>

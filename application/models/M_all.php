<?php
  defined('BASEPATH') or exit('No direct Script access allowed');

  class M_all extends CI_Model
  {
      public function cek_login($username, $password){ 
          $this->db->select('count(*) as total');
          $this->db->from('user');
          $this->db->where('username',$username);
          $this->db->where('password',$password);
          $this->db->where('status_user',1);
          $data = $this->db->get();

          foreach ($data->result() as $a){
              return $a->total+0;
          }
      }

      public function selectX($tbl,$where){
          return $this->db->get_where($tbl,$where);
      }

      public function selectSemua($tbl){
          return $this->db->get($tbl);
      }

      public function insert_data($data,$table){
          $this->db->insert($table,$data);
      }

      public function update_data($tbl,$data,$where){
          $this->db->where($where);
          $this->db->update($tbl,$data);
          return true;
      }

      public function delete_data($tbl,$where){
          $this->db->delete($tbl,$where);
      }

      public function get_limit($tabel, $id_order, $sort, $limit){
          $this->db->select("*");
          $this->db->from($tabel);
          $this->db->order_by($id_order, $sort);
          $this->db->limit($limit);
          $query = $this->db->get();
          return $query;
      }

      public function get_data_limit($tabel, $where, $id_order, $sort, $limit){
          $this->db->select("*");
          $this->db->from($tabel);
          $this->db->where($where);
          $this->db->order_by($id_order, $sort);
          $this->db->limit($limit);
          $query = $this->db->get();
          return $query;
      }

      public function get_or_where($tabel, $where1, $where2){
          $this->db->select("*");
          $this->db->from($tabel);
          $this->db->where($where1);
          $this->db->or_where($where2);
          $query = $this->db->get();
          return $query;
      }


  }
?>

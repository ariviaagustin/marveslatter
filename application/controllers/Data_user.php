<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('M_all');
        $this->load->model('M_master');
        $this->load->library('user_agent');
        date_default_timezone_set("Asia/Jakarta");  
        $this->load->helpers('fungsi_helper');

        $username = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $id_role=$this->session->userdata('role');

        if(!isset($username) && ($id_role<='9')){
             redirect('Login/logout');
        }
    }

	public function index()
	{
		if($this->session->userdata('role') == 1)
		{
	        $data['user'] = $this->M_master->data_user()->result();
			$this->load->view('shared/header');
			$this->load->view('user/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where_role = array('status_role'=>1);
			$data['role'] = $this->M_all->selectX('entitas__role', $where_role)->result();
			$where_tingkat = array('status_tingkat'=>1);
			$data['tingkat'] = $this->M_all->selectX('entitas__tingkat', $where_tingkat)->result();
			$this->load->view('shared/header');
			$this->load->view('user/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function get_jabatan(){
        $this->load->model('M_master');
        $role = $this->input->post('role');
        $data = $this->M_master->get_jabatan_user($role);
                 
        echo '<select required class="form-control select2" style="width: 100%;" name="jabatan" id="div_jabatan">
        <option value="">--Pilih Jabatan--</option>';

        foreach($data as $b){
            echo '
            <option value="'.$b->id_jabatan.'">'.$b->nama_jabatan.'</option>';
        }
        echo '</select>';
  	}

  	public function aksi_tambah()
	{
		$role = $this->input->post('role');
		if($role==1){
			$data = array(
				'nama_pegawai' => $this->input->post('nama_user'),
				'no_pegawai' => $this->input->post('no_pegawai'),
				'id_instansi' => 1,
				'status' => $this->input->post('status_user'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_user'),
			);
			$query=$this->M_all->insert_data($data,'data_pegawai');
			$id = $this->db->insert_id();

			$role = $this->input->post('role');
			$where = array('id_role'=>$role);
			$dt = $this->M_all->selectX('entitas__role',$where)->row();
			$tingkat=$dt->alias_role;

			$data1 = array(
				'id_pegawai' => $id,
				'nama_user' => $this->input->post('nama_user'),
				'no_pegawai' => $this->input->post('no_pegawai'),
				'role' => $this->input->post('role'),
				'tingkat' => $tingkat,
				'status_user' => $this->input->post('status_user'),
				'id_instansi' => 1,
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_user'),
			);
			
			$query2=$this->M_all->insert_data($data1,'user');
		}else{
			$role = $this->input->post('role');
			$jabatan = $this->input->post('jabatan');

			$where2 = array('id_jabatan'=>$jabatan);
			$jab = $this->M_all->selectX('master_jabatan',$where2)->row();
			$id_instansi =$jab->id_instansi;
			$id_unit_kerja = $jab->id_unit_kerja;
			$id_bagian_unit =$jab->id_bagian_unit;
			$id_sub_bagian = $jab->id_sub_bagian;
			$nama_jabatan = $jab->nama_jabatan;
			$eselon_id = $jab->eselon_id;

			$where3 = array('id_role'=>$role);
			$rol = $this->M_all->selectX('entitas__role',$where3)->row();
			$tingkat_=$rol->alias_role;

			$data3 = array(
				'nama_pegawai' => $this->input->post('nama_user'),
				'no_pegawai' => $this->input->post('no_pegawai'),
				'id_instansi' => $id_instansi,
				'unit_kerja' => $id_unit_kerja,
				'bagian_unit_kerja' => $id_bagian_unit,
				'sub_bagian_unit' => $id_sub_bagian,
				'eselon_id' => $eselon_id,
				'jabatan' => $this->input->post('jabatan'),
				'nama_jabatan' => $nama_jabatan,
				'status' => $this->input->post('status_user'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_user'),
			);
			$query3=$this->M_all->insert_data($data3,'data_pegawai');
			$id_peg = $this->db->insert_id();

			$data4 = array(
				'id_pegawai' => $id_peg,
				'nama_user' => $this->input->post('nama_user'),
				'no_pegawai' => $this->input->post('no_pegawai'),
				'role' => $this->input->post('role'),
				'tingkat' => $tingkat_,
				'status_user' => $this->input->post('status_user'),
				'id_instansi' => $id_instansi,
				'id_unit_kerja' => $id_unit_kerja,
				'id_bagian_unit' => $id_bagian_unit,
				'id_sub_bagian' => $id_sub_bagian,
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_user'),
			);
			
			$query2=$this->M_all->insert_data($data1,'user');
		}
		
		redirect('Data_user');
	}

	public function detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_user'=>$id);
	        $user = $this->M_all->selectX('user',$where)->result();
	        $data['user'] = $user[0];
	        $data['role'] = $this->M_all->selectSemua('entitas__role')->result();
	        $data['tingkat'] = $this->M_all->selectSemua('entitas__tingkat')->result();
			$this->load->view('shared/header');
			$this->load->view('user/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_user'=>$id);
	        $user = $this->M_all->selectX('user',$where)->result();
	        $data['user'] = $user[0];
	        $where_role = array('status_role'=>1);
			$data['role'] = $this->M_all->selectX('entitas__role', $where_role)->result();
			$where_tingkat = array('status_tingkat'=>1);
			$data['tingkat'] = $this->M_all->selectX('entitas__tingkat', $where_tingkat)->result();
			$this->load->view('shared/header');
			$this->load->view('user/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_ubah()
	{
		$password = $this->input->post('password');
		$pass_old = $this->input->post('pass_old');
		if(!empty($password))
		{
			$pass = md5($password);
		}
		else
		{
			$pass = $pass_old;
		}
		$data = array(
			'status_user' => $this->input->post('status_user'),
			'username' => $this->input->post('username'),
			'password' => $pass,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('id_user'),
		);
		$where = array('id_user'=>$this->input->post('id'));
		$query=$this->M_all->update_data('user',$data,$where);
		redirect('Data_user');
	}

	public function hapus($id)
	{
		$where = array('id_user' => $id);
		$this->M_all->delete_data('user',$where);
		redirect('Data_user');
	}




}

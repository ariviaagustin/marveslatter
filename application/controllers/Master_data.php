<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_data extends CI_Controller {
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
		$this->load->view('shared/not_access');
	}

	public function unit_kerja()
	{
		if($this->session->userdata('role') == 1)
		{	
			$data['unit'] = $this->M_master->data_unit_kerja()->result();
			$this->load->view('shared/header');
			$this->load->view('master/unit_kerja/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function unit_kerja_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result(); 
			$where = array('status'=>1);
			$data['lembaga'] = $this->M_all->selectX('instansi', $where)->result(); 
			$this->load->view('shared/header');
			$this->load->view('master/unit_kerja/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_unit_kerja_tambah()
	{
		$data = array(
			'id_instansi' =>$this->input->post('id_instansi'),
			'nama_unit_kerja' => $this->input->post('nama_unit_kerja'),
			'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
			'order_unit_kerja' => $this->input->post('order_unit_kerja'),
			'status_unit_kerja' => $this->input->post('status_unit_kerja')
		);
			
		$query=$this->M_all->insert_data($data,'master_unit_kerja');
		redirect('Master_data/unit_kerja');
	}

	public function unit_kerja_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_unit_kerja'=>$id);
	        $unit_kerja = $this->M_all->selectX('master_unit_kerja',$where)->result();
	        $data['unit'] = $unit_kerja[0];
			$this->load->view('shared/header');
			$this->load->view('master/unit_kerja/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function unit_kerja_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_unit_kerja'=>$id);
	        $unit_kerja = $this->M_all->selectX('master_unit_kerja',$where)->result();
	        $data['unit'] = $unit_kerja[0];
			$this->load->view('shared/header');
			$this->load->view('master/unit_kerja/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_unit_kerja_ubah()
	{
		$data = array(
			'nama_unit_kerja' => $this->input->post('nama_unit_kerja'),
			'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
			'order_unit_kerja' => $this->input->post('order_unit_kerja'),
			'status_unit_kerja' => $this->input->post('status_unit_kerja')
		);
		$where = array('id_unit_kerja'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_unit_kerja',$data,$where);
		redirect('Master_data/unit_kerja');
	}

	public function unit_kerja_hapus($id)
	{
		$where = array('id_unit_kerja' => $id);
		$this->M_all->delete_data('master_unit_kerja', $where);
		redirect('Master_data/unit_kerja');
	}

	public function bagian_unit_kerja()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
	        $data['bagian'] = $this->M_all->selectSemua('master_bag_unit_kerja')->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian_unit/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function bagian_unit_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where1 = array('status'=>1);
			$data['lembaga'] = $this->M_all->selectX('instansi', $where1)->result();
			$where = array('status_unit_kerja'=>1);
			$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where)->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian_unit/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function get_unit(){
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $data = $this->M_master->getunit($id_instansi);
        
        echo '<select required class="form-control select2" style="width: 100%;" name="id_unit_kerja"  id="div_unit">
        <option value="">--Pilih Unit Kerja--</option>';

        foreach($data as $b){
            echo '
            <option value="'.$b->id_unit_kerja.'">'.$b->nama_unit_kerja.'</option>';
        }
        echo '</select>';
  	}

  	public function aksi_bagian_tambah()
	{
		$data = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'nama_bagian' => $this->input->post('nama_bagian'),
			'kode_bagian' => $this->input->post('kode_bagian'),
			'status_bagian' => $this->input->post('status_bagian'),
			'order_bagian' => $this->input->post('order_bagian')
		);
			
		$query=$this->M_all->insert_data($data,'master_bag_unit_kerja');
		redirect('Master_data/bagian_unit_kerja');
	}

	public function bagian_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_bag_unit_kerja'=>$id);
	        $bagian = $this->M_all->selectX('master_bag_unit_kerja',$where)->result();
	        $data['bagian'] = $bagian[0];
	        $data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian_unit/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function bagian_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_bag_unit_kerja'=>$id);
	        $bagian = $this->M_all->selectX('master_bag_unit_kerja',$where)->result();
	        $data['bagian'] = $bagian[0];
	        $where_unit = array('status_unit_kerja'=>1);
			$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where_unit)->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian_unit/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_bagian_ubah()
	{
		$data = array(
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'nama_bagian' => $this->input->post('nama_bagian'),
			'kode_bagian' => $this->input->post('kode_bagian'),
			'status_bagian' => $this->input->post('status_bagian'),
			'order_bagian' => $this->input->post('order_bagian')
		);
		$where = array('id_bag_unit_kerja'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_bag_unit_kerja',$data,$where);
		redirect('Master_data/bagian_unit_kerja');
	}

	public function bagian_hapus($id)
	{
		$where = array('id_bag_unit_kerja' => $id);
		$this->M_all->delete_data('master_bag_unit_kerja',$where);
		redirect('Master_data/bagian_unit_kerja');
	}

	public function sub_bagian_unit()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['sub'] = $this->M_master->data_subbagian()->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian-sub/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	function get_unit_sub(){  
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $data = $this->M_master->getunit($id_instansi);
         
        echo '<select required class="form-control select2" style="width: 100%;" name="id_unit_kerja"  id="div_unit" onchange="get_bagian_unit()">
        <option value="">--Pilih Unit Kerja--</option>';

        foreach($data as $b){
            echo '
            <option value="'.$b->id_unit_kerja.'">'.$b->nama_unit_kerja.'</option>';
        }
        echo '</select>';
  	}

  	function get_bagian_unit(){
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $id_unit_kerja = $this->input->post('id_unit_kerja');
        
        $data = $this->M_master->get_bagian_unit($id_instansi, $id_unit_kerja);
               
        echo '<select required class="form-control select2" style="width: 100%;" name="id_bagian_unit" id="div_bagian">
        <option value="0">--Pilih Bagian Unit Kerja--</option>';

        foreach($data as $c){
            echo '<option value="'.$c->id_bag_unit_kerja.'">'.$c->nama_bagian.'</option>';
        }
        echo '</select>';
  	}

	public function sub_bagian_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where1 = array('status'=>1);
			$data['lembaga'] = $this->M_all->selectX('instansi', $where1)->result();
			$where = array('status_unit_kerja'=>1);
			$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where)->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian-sub/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_sub_bagian_tambah()
	{
		$data = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'id_bagian_unit' => $this->input->post('id_bagian_unit'),
			'nama_sub_bagian' => $this->input->post('nama_sub_bagian'),
			'kode_sub_bagian' => $this->input->post('kode_sub_bagian'),
			'status_sub_bagian' => $this->input->post('status_sub_bagian'),
			'order_sub_bagian' => $this->input->post('order_sub_bagian')
		);
			
		$query=$this->M_all->insert_data($data,'master_sub_bagian');
		redirect('Master_data/sub_bagian_unit');
	}

	public function sub_bagian_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_bag_unit_kerja'=>$id);
	        $bagian = $this->M_all->selectX('master_bag_unit_kerja',$where)->result();
	        $data['bagian'] = $bagian[0];
	        $data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian-sub/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function sub_bagian_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_bag_unit_kerja'=>$id);
	        $bagian = $this->M_all->selectX('master_bag_unit_kerja',$where)->result();
	        $data['bagian'] = $bagian[0];
	        $where_unit = array('status_unit_kerja'=>1);
			$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where_unit)->result();
			$this->load->view('shared/header');
			$this->load->view('master/bagian-sub/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_sub_bagian_ubah()
	{
		$data = array(
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'nama_bagian' => $this->input->post('nama_bagian'),
			'kode_bagian' => $this->input->post('kode_bagian'),
			'status_bagian' => $this->input->post('status_bagian'),
			'order_bagian' => $this->input->post('order_bagian')
		);
		$where = array('id_bag_unit_kerja'=>$this->input->post('id'));
		$query=$this->M_all->update_data($where,$data,'master_bag_unit_kerja');
		redirect('Mater_data/sub_bagian_unit');
	}

	public function sub_bagian_hapus($id)
	{
		$where = array('id_bag_unit_kerja' => $id);
		$this->M_all->delete_data('master_bag_unit_kerja',$where);
		redirect('Master_data/sub_bagian_unit');
	}

	public function eselon()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['eselon'] = $this->M_master->data_eselon()->result();
			$this->load->view('shared/header');
			$this->load->view('master/eselon/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function eselon_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where1 = array('status_role'=>1, 'alias_role!='=>1);
			$data['tingkat'] = $this->M_all->selectX('entitas__role', $where1)->result();
			$this->load->view('shared/header');
			$this->load->view('master/eselon/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	
	public function aksi_eselon_tambah()
	{
		$data = array(
			'tingkat_eselon' => $this->input->post('tingkat_eselon'),
			'nama_eselon' => $this->input->post('nama_eselon'),
			'ket_eselon' => $this->input->post('ket_eselon'),
			'urutan_eselon' => $this->input->post('urutan_eselon'),
			'status_eselon' => $this->input->post('status_eselon')
		);
			
		$query=$this->M_all->insert_data($data,'master_eselon');
		redirect('Master_data/eselon');
	}

	public function golongan()
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('status_golongan'=>1);
			$data['golongan'] = $this->M_all->selectX('master_golongan', $where)->result();
			$this->load->view('shared/header');
			$this->load->view('master/golongan/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}


	public function golongan_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/golongan/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	
	public function aksi_golongan_tambah()
	{
		$data = array(
			'nama_golongan' => $this->input->post('nama_golongan'),
			'ket_golongan' => $this->input->post('ket_golongan'),
			'urutan_golongan' => $this->input->post('urutan_golongan'),
			'status_golongan' => $this->input->post('status_golongan'),
		);
			
		$query=$this->M_all->insert_data($data,'master_golongan');
		redirect('Master_data/golongan');
	}

	public function jabatan()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['jabatan'] = $this->M_master->data_jabatan()->result();
			$this->load->view('shared/header');
			$this->load->view('master/jabatan/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jabatan_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('status'=>1);
			$data['lembaga'] = $this->M_all->selectX('instansi', $where)->result();
			$where1 = array('status_eselon'=>1);
			$data['eselon'] = $this->M_all->selectX('master_eselon', $where1)->result();
			$this->load->view('shared/header');
			$this->load->view('master/jabatan/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	function get_unit_kerja(){  
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $data = $this->M_master->getunit($id_instansi);

        echo '<select required class="form-control select2" style="width: 100%;" name="id_unit_kerja"  id="id_bagian_unit" onchange="get_bagian()">
        	<option value="">Pilih Unit Kerja</option>';

        foreach($data as $b){
            echo '
            <option value="'.$b->id_unit_kerja.'">'.$b->nama_unit_kerja.'</option>';
        }
        echo '</select>';
  	}

  	function get_bagian(){
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $id_unit_kerja = $this->input->post('id_unit_kerja');
        
        $data = $this->M_master->get_bagian_unit($id_instansi, $id_unit_kerja);
             
        echo '<select required class="form-control select2" style="width: 100%;" name="id_bagian_unit" id="id_sub_bagian" onchange="get_sub_bagian()">
        <option value="">Pilih Bagian Unit Kerja</option>';

        foreach($data as $c){
            echo '<option value="'.$c->id_bag_unit_kerja.'">'.$c->nama_bagian.'</option>';
        }
        echo '</select>';
  	}

  	function get_sub_bagian(){
        $this->load->model('M_all');
        $id_instansi = $this->input->post('id_instansi');
        $id_unit_kerja = $this->input->post('id_unit_kerja');
        $id_bagian_unit = $this->input->post('id_bagian_unit');
        
        $data = $this->M_master->get_sub_bagian($id_instansi, $id_unit_kerja, $id_bagian_unit);
       

        echo '<select required class="form-control select2" style="width: 100%;" name="id_sub_bagian" id="div_sub">
        <option value="">Pilih Sub Bagian Unit Kerja</option>';

        foreach($data as $c){
            echo '<option value="'.$c->id_sub_bagian.'">'.$c->nama_sub_bagian.'</option>';
        }
        echo '</select>';
  	}

  	public function aksi_jabatan_tambah()
	{
		$id_instansi = $this->input->post('id_instansi');
		$id_unit_kerja = $this->input->post('id_unit_kerja');
		$id_bagian_unit = $this->input->post('id_bagian_unit');
		$id_sub_bagian = $this->input->post('id_sub_bagian');

		$eselon_id=$this->input->post('eselon_id');
		if($eselon_id==2 OR $eselon_id==3 OR $eselon_id==4){
			$eselon_parent=1;
			$where=array('eselon_id'=>$eselon_parent);
			$dt=$this->M_all->selectX('master_jabatan', $where)->row();
			$jabatan_parent = $dt->id_jabatan;
		}elseif($eselon_id==5 OR $eselon_id==6){
			$id_unit_kerja = $this->input->post('id_unit_kerja');
			$dt=$this->M_all->data_jabatan_parent($id_unit_kerja)->row();
			$jabatan_parent = $dt->id_jabatan;
		}elseif($eselon_id==7 OR $eselon_id==8){
			$id_instansi = $this->input->post('id_instansi');
			$id_unit_kerja = $this->input->post('id_unit_kerja');
			$id_bagian_unit = $this->input->post('id_bagian_unit');
			$dt=$this->M_all->data_jabatan_parent_es3($id_instansi, $id_unit_kerja, $id_bagian_unit)->row();
			$jabatan_parent = $dt->id_jabatan;
		}else{

		}

		if($id_unit_kerja=='' AND $id_bagian_unit=='' AND $id_sub_bagian==''){
			$data = array(
				'id_instansi' => $this->input->post('id_instansi'),
				'id_unit_kerja' => null,
				'id_bagian_unit' => null,
				'id_sub_bagian' => null,
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'kode_jabatan' => $this->input->post('kode_jabatan'),
				'eselon_id' => $this->input->post('eselon_id'),
				'jabatan_order' => $this->input->post('jabatan_order'),
				'status_jabatan' => $this->input->post('status_jabatan'),
				'jabatan_parent' => NULL,
			);
			$query=$this->M_all->insert_data($data,'master_jabatan');
		 }elseif($id_bagian_unit=='' AND $id_sub_bagian==''){
		 	$data = array(
				'id_instansi' => $this->input->post('id_instansi'),
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'id_bagian_unit' => null,
				'id_sub_bagian' => null,
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'kode_jabatan' => $this->input->post('kode_jabatan'),
				'eselon_id' => $this->input->post('eselon_id'),
				'jabatan_order' => $this->input->post('jabatan_order'),
				'status_jabatan' => $this->input->post('status_jabatan'),
				'jabatan_parent' => $jabatan_parent,
			);
			$query=$this->M_all->insert_data($data,'master_jabatan');
		}elseif($id_sub_bagian==''){
			$data = array(
				'id_instansi' => $this->input->post('id_instansi'),
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'id_bagian_unit' => $this->input->post('id_bagian_unit'),
				'id_sub_bagian' => null,
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'kode_jabatan' => $this->input->post('kode_jabatan'),
				'eselon_id' => $this->input->post('eselon_id'),
				'jabatan_order' => $this->input->post('jabatan_order'),
				'status_jabatan' => $this->input->post('status_jabatan'),
				'jabatan_parent' => $jabatan_parent,
			);
			$query=$this->M_all->insert_data($data,'master_jabatan');
		}else{
			$data = array(
				'id_instansi' => $this->input->post('id_instansi'),
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'id_bagian_unit' => $this->input->post('id_bagian_unit'),
				'id_sub_bagian' => $this->input->post('id_sub_bagian'),
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'kode_jabatan' => $this->input->post('kode_jabatan'),
				'eselon_id' => $this->input->post('eselon_id'),
				'jabatan_order' => $this->input->post('jabatan_order'),
				'status_jabatan' => $this->input->post('status_jabatan'),
				'jabatan_parent' => $jabatan_parent,
			);
			$query=$this->M_all->insert_data($data,'master_jabatan');
		}
		redirect('Master_data/jabatan');
	}

	public function jabatan_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jabatan'=>$id);
	        $jabatan = $this->M_all->selectX('master_jabatan',$where)->result();
	        $data['jabatan'] = $jabatan[0];
	        $data['bagian'] = $this->M_all->selectSemua('master_bag_unit_kerja')->result();
	        $data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
			$this->load->view('shared/header');
			$this->load->view('master/jabatan/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jabatan_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jabatan'=>$id);
	        $jabatan = $this->M_all->selectX('master_jabatan',$where)->result();
	        $data['jabatan'] = $jabatan[0];
	        $where_unit = array('status_unit_kerja'=>1);
			$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where_unit)->result();
			$where_bagian = array('status_bagian'=>1);
			$data['bagian'] = $this->M_all->selectX('master_bag_unit_kerja', $where_bagian)->result();
			$this->load->view('shared/header');
			$this->load->view('master/jabatan/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_ubah_jabatan()
	{
		$data = array(
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'id_bag_unit_kerja' => $this->input->post('id_bag_unit_kerja'),
			'nama_jabatan' => $this->input->post('nama_jabatan'),
			'kode_jabatan' => $this->input->post('kode_jabatan'),
			'id_role' => $this->input->post('id_role'),
			'status_jabatan' => $this->input->post('status_jabatan')
		);
		$where = array('id_jabatan'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_jabatan',$data,$where);
		redirect('Master_data/jabatan');
	}

	public function hapus_jabatan($id)
	{
		$where = array('id_jabatan' => $id);
		$this->M_all->delete_data('master_jabatan',$where);
		redirect('Master_data/jabatan');
	}

	public function role()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['role'] = $this->M_all->selectSemua('entitas__role')->result();
			$data['tingkat'] = $this->M_all->selectSemua('entitas__tingkat')->result();
			$this->load->view('shared/header');
			$this->load->view('master/role/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function role_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where_tingkat = array('status_tingkat'=>1);
			$data['tingkat'] = $this->M_all->selectX('entitas__tingkat', $where_tingkat)->result();
			$this->load->view('shared/header');
			$this->load->view('master/role/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_role_tambah()
	{
		$data = array(
			'nama_role' => $this->input->post('nama_role'),
			'alias_role' => $this->input->post('alias_role'),
			'status_role' => $this->input->post('status_role')
		);
			
		$query=$this->M_all->insert_data($data,'entitas__role');
		redirect('Master_data/role');
	}

	public function role_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$data['tingkat'] = $this->M_all->selectSemua('entitas__tingkat')->result();
			$where = array('id_role'=>$id);
	        $role = $this->M_all->selectX('entitas__role',$where)->result();
	        $data['role'] = $role[0];
			$this->load->view('shared/header');
			$this->load->view('master/role/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function role_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where_tingkat = array('status_tingkat'=>1);
			$data['tingkat'] = $this->M_all->selectX('entitas__tingkat', $where_tingkat)->result();
			$where = array('id_role'=>$id);
	        $role = $this->M_all->selectX('entitas__role',$where)->result();
	        $data['role'] = $role[0];
			$this->load->view('shared/header');
			$this->load->view('master/role/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_role_ubah()
	{
		$data = array(
			'nama_role' => $this->input->post('nama_role'),
			'alias_role' => $this->input->post('alias_role'),
			'status_role' => $this->input->post('status_role'),
		);
		$where = array('id_role'=>$this->input->post('id'));
		$query=$this->M_all->update_data('entitas__role',$data,$where);
		redirect('Role');
	}

	public function hapus_role($id)
	{
		$where = array('id_role' => $id);
		$this->M_all->delete_data('entitas__role',$where);
		redirect('Master_data/role');
	}

	public function jenis_surat()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['jenis'] = $this->M_all->selectSemua('jenis_surat')->result();
			$this->load->view('shared/header');
			$this->load->view('master/jenis_surat/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jenis_surat_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/jenis_surat/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_jenis_tambah()
	{
		$data = array(
			'nama_jenis_surat' => $this->input->post('nama_jenis_surat'),
			'use_for' => $this->input->post('use_for'),
			'status_jenis_surat' => $this->input->post('status_jenis_surat')
		);
			
		$query=$this->M_all->insert_data($data,'jenis_surat');
		redirect('Master_data/jenis_surat');
	}

	public function jenis_surat_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jenis_surat'=>$id);
	        $jenis = $this->M_all->selectX('jenis_surat',$where)->result();
	        $data['jenis'] = $jenis[0];
			$this->load->view('shared/header');
			$this->load->view('master/jenis_surat/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jenis_surat_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jenis_surat'=>$id);
	        $jenis = $this->M_all->selectX('jenis_surat',$where)->result();
	        $data['jenis'] = $jenis[0];
			$this->load->view('shared/header');
			$this->load->view('master/jenis_surat/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_jenis_ubah()
	{
		$data = array(
			'nama_jenis_surat' => $this->input->post('nama_jenis_surat'),
			'use_for' => $this->input->post('use_for'),
			'status_jenis_surat' => $this->input->post('status_jenis_surat')
		);
		$where = array('id_jenis_surat'=>$this->input->post('id'));
		$query=$this->M_all->update_data('jenis_surat',$data,$where);
		redirect('Master_data/jenis_surat');
	}

	public function jenis_surat_hapus($id)
	{
		$where = array('id_jenis_surat' => $id);
		$this->M_all->delete_data('jenis_surat',$where);
		redirect('Master_data/jenis_surat');
	}

	public function aksi()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['aksi'] = $this->M_all->selectSemua('master_aksi')->result();
			$this->load->view('shared/header');
			$this->load->view('master/aksi/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/aksi/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_surat_tambah()
	{
		$data = array(
			'aksi' => $this->input->post('aksi'),
			'status_aksi' => $this->input->post('status_aksi')
		);
			
		$query=$this->M_all->insert_data($data,'master_aksi');
		redirect('Master_data/aksi');
	}

	public function aksi_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_aksi'=>$id);
	        $aksi = $this->M_all->selectX('master_aksi',$where)->result();
	        $data['aksi'] = $aksi[0];
			$this->load->view('shared/header');
			$this->load->view('master/aksi/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_aksi'=>$id);
	        $aksi = $this->M_all->selectX('master_aksi',$where)->result();
	        $data['aksi'] = $aksi[0];
			$this->load->view('shared/header');
			$this->load->view('master/aksi/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_surat_ubah()
	{
		$data = array(
			'aksi' => $this->input->post('aksi'),
			'status_aksi' => $this->input->post('status_aksi')
		);
		$where = array('id_aksi'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_aksi',$data,$where);
		redirect('Master_data/aksi');
	}

	public function aksi_hapus($id)
	{
		$where = array('id_aksi' => $id);
		$this->M_all->delete_data('master_aksi',$where);
		redirect('Master_data/aksi');
	}

	public function sifat_surat()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['sifat'] = $this->M_all->selectSemua('master_sifat_surat')->result();
			$this->load->view('shared/header');
			$this->load->view('master/sifat_surat/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function sifat_surat_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/sifat_surat/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_sifat_tambah()
	{
		$data = array(
			'nama_sifat_surat' => $this->input->post('nama_sifat_surat'),
			'use_for' => $this->input->post('use_for'),
			'status_sifat_surat' => $this->input->post('status_sifat_surat')
		);
			
		$query=$this->M_all->insert_data($data,'master_sifat_surat');
		redirect('Master_data/sifat_surat');
	}

	public function sifat_surat_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_sifat_surat'=>$id);
	        $sifat = $this->M_all->selectX('master_sifat_surat',$where)->result();
	        $data['sifat'] = $sifat[0];
			$this->load->view('shared/header');
			$this->load->view('master/sifat_surat/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function sifat_surat_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_sifat_surat'=>$id);
	        $sifat = $this->M_all->selectX('master_sifat_surat',$where)->result();
	        $data['sifat'] = $sifat[0];
			$this->load->view('shared/header');
			$this->load->view('master/sifat_surat/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_sifat_ubah()
	{
		$data = array(
			'nama_sifat_surat' => $this->input->post('nama_sifat_surat'),
			'use_for' => $this->input->post('use_for'),
			'status_sifat_surat' => $this->input->post('status_sifat_surat')
		);
		$where = array('id_sifat_surat'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_sifat_surat',$data, $where);
		redirect('Master_data/sifat_surat');
	}

	public function sifat_surat_hapus($id)
	{
		$where = array('id_sifat_surat' => $id);
		$this->M_all->delete_data('master_sifat_surat', $where);
		redirect('Master_data/Sifat_surat');
	}

	public function klasifikasi()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['klasifikasi'] = $this->M_all->selectSemua('master_klasifikasi')->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_klasifikasi_tambah()
	{
		$data = array(
			'klasifikasi' => $this->input->post('klasifikasi'),
			'kode_klasifikasi' => $this->input->post('kode_klasifikasi'),
			'status_klasifikasi' => $this->input->post('status_klasifikasi')
		);
			
		$query=$this->M_all->insert_data($data,'master_klasifikasi');
		redirect('Master_data/klasifikasi');
	}

	public function klasifikasi_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_klasifikasi'=>$id);
	        $klasifikasi = $this->M_all->selectX('master_klasifikasi',$where)->result();
	        $data['klasifikasi'] = $klasifikasi[0];
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_klasifikasi'=>$id);
	        $klasifikasi = $this->M_all->selectX('master_klasifikasi',$where)->result();
	        $data['klasifikasi'] = $klasifikasi[0];
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_klasifikasi_ubah()
	{
		$data = array(
			'klasifikasi' => $this->input->post('klasifikasi'),
			'kode_klasifikasi' => $this->input->post('kode_klasifikasi'),
			'status_klasifikasi' => $this->input->post('status_klasifikasi')
		);
		$where = array('id_klasifikasi'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_klasifikasi',$data,$where);
		redirect('Master_data/klasifikasi');
	}

	public function klasifikasi_hapus($id)
	{
		$where = array('id_klasifikasi' => $id);
		$this->M_all->delete_data('master_klasifikasi',$where);
		redirect('Master_data/klasifikasi');
	}

	public function klasifikasi_sekunder()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['sekunder'] = $this->M_all->selectSemua('master_klasifikasi_sekunder')->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_sekunder/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_sekunder_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where=array('status_klasifikasi',1);
			$data['primer'] = $this->M_all->selectX('master_klasifikasi', $where)->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_sekunder/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_klasifikasi_sekunder_tambah()
	{
		$data = array(
			'id_klasifikasi' => $this->input->post('id_klasifikasi'),
			'kode_sekunder' => $this->input->post('kode_sekunder'),
			'nama_sekunder' => $this->input->post('nama_sekunder'),
			'status_sekunder' => $this->input->post('status_sekunder')
		);
			
		$query=$this->M_all->insert_data($data,'master_klasifikasi_sekunder');
		redirect('Master_data/klasifikasi_sekunder');
	}

	public function klasifikasi_sekunder_detail($id_sekunder)
	{
		if($this->session->userdata('role') == 1)
		{
	        $data['sekunder'] = $this->M_master->data_sekunder($id_sekunder)->row();

			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_sekunder/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_sekunder_ubah($id_sekunder)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_sekunder'=>$id_sekunder);
	        $data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi_sekunder',$where)->row();
	        $data['primer'] = $this->M_all->selectSemua('master_klasifikasi')->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_sekunder/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_klasifikasi_sekunder_ubah()
	{
		$id_sekunder=$this->input->post('id_sekunder');
		$data = array(
			'id_klasifikasi' => $this->input->post('id_klasifikasi'),
			'kode_sekunder' => $this->input->post('kode_sekunder'),
			'nama_sekunder' => $this->input->post('nama_sekunder'),
			'status_sekunder' => $this->input->post('status_sekunder')
		);
		$where = array('id_sekunder'=>$id_sekunder);
		$query=$this->M_all->update_data('master_klasifikasi_sekunder',$data,$where);
		redirect('Master_data/klasifikasi_sekunder');
	}

	public function klasifikasi_sekunder_hapus($id)
	{
		$where = array('id_sekunder' => $id);
		$this->M_all->delete_data('master_klasifikasi_sekunder',$where);
		redirect('Master_data/klasifikasi_sekunder');
	}

	public function klasifikasi_tersier()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['tersier'] = $this->M_all->selectSemua('master_klasifikasi_tersier')->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_tersier/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_tersier_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where=array('status_klasifikasi',1);
			$data['primer'] = $this->M_all->selectX('master_klasifikasi', $where)->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_tersier/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function get_sekunder(){
        $this->load->model('M_master');
        $id_klasifikasi = $this->input->post('id_klasifikasi');
        $data = $this->M_master->getsekunder($id_klasifikasi);
        
        echo '<select required class="form-control select2" name="id_sekunder"  id="div_sekunder">
        <option value="">--Pilih Klasifikasi Sekunder--</option>';

        foreach($data as $b){
            echo '
            <option value="'.$b->id_sekunder.'">'.$b->kode_sekunder.' - '.$b->nama_sekunder.'</option>';
        }
        echo '</select>';
    }

	public function aksi_klasifikasi_tersiers_tambah()
	{
		$data = array(
			'id_klasifikasi' => $this->input->post('id_klasifikasi'),
			'id_sekunder' => $this->input->post('id_sekunder'),
			'kode_tersier' => $this->input->post('kode_tersier'),
			'nama_tersier' => $this->input->post('nama_tersier'),
			'status_tersier' => $this->input->post('status_tersier')
		);
			
		$query=$this->M_all->insert_data($data,'master_klasifikasi_tersier');
		redirect('Master_data/klasifikasi_tersier');
	}

	public function klasifikasi_tersier_detail($id_tersier)
	{
		if($this->session->userdata('role') == 1)
		{
	        $data['sekunder'] = $this->M_master->data_tersier($id_tersier)->row();

			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_tersier/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function klasifikasi_tersier_ubah($id_tersier)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_tersier'=>$id_tersier);
	        $data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi_tersier',$where)->row();
	        $data['primer'] = $this->M_all->selectSemua('master_klasifikasi')->result();
	        $data['sekunder'] = $this->M_all->selectSemua('master_klasifikasi_sekunder')->result();
			$this->load->view('shared/header');
			$this->load->view('master/klasifikasi_tersier/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_klasifikasi_tersier_ubah()
	{
		$id_tersier=$this->input->post('id_tersier');
		$data = array(
			'id_klasifikasi' => $this->input->post('id_klasifikasi'),
			'id_sekunder' => $this->input->post('id_sekunder'),
			'kode_tersier' => $this->input->post('kode_tersier'),
			'nama_tersier' => $this->input->post('nama_tersier'),
			'status_tersier' => $this->input->post('status_tersier')
		);
		$where = array('id_tersier'=>$id_tersier);
		$query=$this->M_all->update_data('master_klasifikasi_tersier',$data,$where);
		redirect('Master_data/klasifikasi_tersier');
	}

	public function klasifikasi_tersier_hapus($id)
	{
		$where = array('id_tersier' => $id);
		$this->M_all->delete_data('master_klasifikasi_tersier',$where);
		redirect('Master_data/klasifikasi_tersier');
	}

	public function keaslian()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['asli'] = $this->M_all->selectSemua('master_keaslian')->result();
			$this->load->view('shared/header');
			$this->load->view('master/keaslian/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function keaslian_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/keaslian/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_keaslian_tambah()
	{
		$data = array(
			'nama_keaslian' => $this->input->post('nama_keaslian'),
			'status_keaslian' => $this->input->post('status_keaslian')
		);
			
		$query=$this->M_all->insert_data($data,'master_keaslian');
		redirect('Master_data/keaslian');
	}

	public function keaslian_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_keaslian'=>$id);
	        $asli = $this->M_all->selectX('master_keaslian',$where)->result();
	        $data['asli'] = $asli[0];
			$this->load->view('shared/header');
			$this->load->view('master/keaslian/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function keaslian_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_keaslian'=>$id);
	        $asli = $this->M_all->selectX('master_keaslian',$where)->result();
	        $data['asli'] = $asli[0];
			$this->load->view('shared/header');
			$this->load->view('master/keaslian/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_keaslian_ubah()
	{
		$data = array(
			'nama_keaslian' => $this->input->post('nama_keaslian'),
			'status_keaslian' => $this->input->post('status_keaslian')
		);
		$where = array('id_keaslian'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_keaslian',$data,$where);
		redirect('Master_data/keaslian');
	}

	public function keaslian_hapus($id)
	{
		$where = array('id_keaslian' => $id);
		$this->M_all->delete_data('master_keaslian',$where);
		redirect('Master_data/keaslian');
	}
	
	public function keamanan()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['keamanan'] = $this->M_all->selectSemua('master_tingkat_pengamanan')->result();
			$this->load->view('shared/header');
			$this->load->view('master/keamanan/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function keamanan_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/keamanan/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_keamanan_tambah()
	{
		$data = array(
			'nama_tingkat_pengamanan' => $this->input->post('nama_tingkat_pengamanan'),
			'status_tingkat_pengamanan' => $this->input->post('status_tingkat_pengamanan')
		);
			
		$query=$this->M_all->insert_data($data,'master_tingkat_pengamanan');
		redirect('Master_data/keamanan');
	}

	public function keamanan_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_tingkat_pengamanan'=>$id);
	        $keamanan = $this->M_all->selectX('master_tingkat_pengamanan',$where)->result();
	        $data['keamanan'] = $keamanan[0];
			$this->load->view('shared/header');
			$this->load->view('master/keamanan/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function keamanan_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_tingkat_pengamanan'=>$id);
	        $keamanan = $this->M_all->selectX('master_tingkat_pengamanan',$where)->result();
	        $data['keamanan'] = $keamanan[0];
			$this->load->view('shared/header');
			$this->load->view('master/keamanan/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_keamanan_ubah()
	{
		$data = array(
			'nama_tingkat_pengamanan' => $this->input->post('nama_tingkat_pengamanan'),
			'status_tingkat_pengamanan' => $this->input->post('status_tingkat_pengamanan')
		);
		$where = array('id_tingkat_pengamanan'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_tingkat_pengamanan',$data,$where);
		redirect('Master_data/keamanan');
	}

	public function keamanan_hapus($id)
	{
		$where = array('id_tingkat_pengamanan' => $id);
		$this->M_all->delete_data('master_tingkat_pengamanan',$where);
		redirect('Master_data/keamanan');
	}

	public function jenis_tugas()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['jenis'] = $this->M_all->selectSemua('master_jenis_tugas')->result();
			$this->load->view('shared/header');
			$this->load->view('master/jenis_tugas/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jenis_tugas_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/jenis_tugas/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_jenis_tugas_tambah()
	{
		$data = array(
			'nama_jenis_tugas' => $this->input->post('nama_jenis_tugas'),
			'status_jenis_tugas' => $this->input->post('status_jenis_tugas')
		);
			
		$query=$this->M_all->insert_data($data,'master_jenis_tugas');
		redirect('Master_data/jenis_tugas');
	}

	public function jenis_tugas_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jenis_tugas'=>$id);
	        $jenis = $this->M_all->selectX('master_jenis_tugas',$where)->result();
	        $data['jenis'] = $jenis[0];
			$this->load->view('shared/header');
			$this->load->view('master/jenis_tugas/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function jenis_tugas_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_jenis_tugas'=>$id);
	        $jenis = $this->M_all->selectX('master_jenis_tugas',$where)->result();
	        $data['jenis'] = $jenis[0];
			$this->load->view('shared/header');
			$this->load->view('master/jenis_tugas/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_jenis_tugas_ubah()
	{
		$data = array(
			'nama_jenis_tugas' => $this->input->post('nama_jenis_tugas'),
			'status_jenis_tugas' => $this->input->post('status_jenis_tugas')
		);
		$where = array('id_jenis_tugas'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_jenis_tugas',$data,$where);
		redirect('Master_data/jenis_tugas');
	}

	public function jenis_tugas_hapus($id)
	{
		$where = array('id_jenis_tugas' => $id);
		$this->M_all->delete_data('master_jenis_tugas',$where);
		redirect('Master_data/jenis_tugas');
	}

	public function moda_transport()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['moda'] = $this->M_all->selectSemua('master_moda_transport')->result();
			$this->load->view('shared/header');
			$this->load->view('master/moda/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function moda_transport_tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$this->load->view('shared/header');
			$this->load->view('master/moda/tambah');
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_moda_transport_tambah()
	{
		$data = array(
			'nama_moda' => $this->input->post('nama_moda'),
			'status_moda' => $this->input->post('status_moda')
		);
			
		$query=$this->M_all->insert_data($data,'master_moda_transport');
		redirect('Master_data/moda_transport');
	}

	public function moda_transport_detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_moda'=>$id);
	        $moda = $this->M_all->selectX('master_moda_transport',$where)->result();
	        $data['moda'] = $moda[0];
			$this->load->view('shared/header');
			$this->load->view('master/moda/detail', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function moda_transport_ubah($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_moda'=>$id);
	        $moda = $this->M_all->selectX('master_moda_transport',$where)->result();
	        $data['moda'] = $moda[0];
			$this->load->view('shared/header');
			$this->load->view('master/moda/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_moda_transport_ubah()
	{
		$data = array(
			'nama_moda' => $this->input->post('nama_moda'),
			'status_moda' => $this->input->post('status_moda')
		);
		$where = array('id_moda'=>$this->input->post('id'));
		$query=$this->M_all->update_data('master_moda_transport',$data,$where);
		redirect('Master_data/moda_transport');
	}

	public function moda_transport_hapus($id)
	{
		$where = array('id_moda' => $id);
		$this->M_all->delete_data('master_moda_transport',$where);
		redirect('Master_data/moda_transport');
	}

	public function agama()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['agama'] = $this->M_all->selectSemua('master_agama')->result();
			$this->load->view('shared/header');
			$this->load->view('master/agama/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function pendidikan()
	{
		if($this->session->userdata('role') == 1)
		{
			$data['pendidikan'] = $this->M_all->selectSemua('master_pendidikan')->result();
			$this->load->view('shared/header');
			$this->load->view('master/pendidikan/index', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}





	







}

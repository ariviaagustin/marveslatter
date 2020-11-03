<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('M_all');
        $this->load->model('M_master');
        $this->load->model('M_surat');
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
	{	$data['data'] = $this->M_surat->data_daftar_surat()->result();
		$this->load->view('shared/header');
		$this->load->view('inbox/index', $data);
		$this->load->view('shared/footer');
	}

	public function detail($id_daftar_surat)
	{
		$data['si'] = $this->M_surat->daftar_surat_detail($id_daftar_surat)->row();
		$data['ttd'] = $this->M_all->selectSemua('data_pegawai')->result();
		$data['jabatan'] = $this->M_all->selectSemua('master_jabatan')->result();
		$data['bag_unit'] = $this->M_all->selectSemua('master_bag_unit_kerja')->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$this->load->view('shared/header');
		$this->load->view('inbox/detail', $data);
		$this->load->view('shared/footer');
	}	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_eksternal_keluar extends CI_Controller {
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
	{
		$data['sek'] = $this->M_surat->index_sek_admin()->result();
		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_keluar/index', $data);
		$this->load->view('shared/footer');
	}

	public function tambah()
	{
		$where_jenis = array('status_jenis_surat'=>1,'use_for'=>2);
		$data['jenis'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		
		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_keluar/tambah', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/sek';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role;
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function aksi_tambah()
	{
		$file_surat = $_FILES['file_surat']['name'];
        if(isset($_FILES['file_surat']['name'])){
            $this->upload_attachment();
            if(!$this->upload->do_upload('file_surat')){
                echo $this->upload->display_errors();
            }else{
                $file_surat = $this->upload->data()['file_name'];
            }
        }
		$data = array(
			'id_internal_eksternal' =>2,
			'ket_internal_eksternal' =>'Eksternal',
			'id_surat_masuk_keluar' =>1,
			'ket_masuk_keluar' =>'Surat Keluar',
			'jenis_surat' => $this->input->post('jenis_surat'),
			'pengirim_surat' => $this->input->post('pengirim_surat'),
			'penandatangan' => $this->input->post('penandatangan'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'tujuan_surat_ke' => $this->input->post('tujuan_surat_ke'),
			'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_surat'),
			'tembusan_surat' => $this->input->post('tembusan_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'file_surat' => $file_surat,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');
		redirect('Surat_eksternal_keluar');
	}

	public function detail($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $sek = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['sek'] =  $sek[0];
        
        $where_jenis = array('status_jenis_surat'=>1);
		$data['jenis'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();

		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_keluar/detail', $data);
		$this->load->view('shared/footer');
	}

	public function hapus($id)
	{
		$where = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where);
		redirect('Surat_eksternal_keluar');
	}

	public function ubah($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $sek = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['sek'] =  $sek[0];
        
        $where_jenis = array('status_jenis_surat'=>1,'use_for'=>2);
		$data['jenis'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_keluar/ubah', $data);
		$this->load->view('shared/footer');
	}

	public function aksi_ubah()
	{
		$file_surat = $_FILES['file_surat']['name'];
        if(isset($_FILES['file_surat']['name'])){
            $this->upload_attachment();
            if(!$this->upload->do_upload('file_surat')){
                $file_surat=$this->input->post('file_sek_old');
            }else{
                $file_surat = $this->upload->data()['file_name'];
                $file_sek_old = './uploads/sek/'.$this->input->post('file_sek_old');
				if(file_exists($file_sek_old)) { unlink($file_sek_old); }
            }
        }
		$data = array(
			'id_internal_eksternal' =>2,
			'ket_internal_eksternal' =>'Eksternal',
			'id_surat_masuk_keluar' =>1,
			'ket_masuk_keluar' =>'Surat Keluar',
			'jenis_surat' => $this->input->post('jenis_surat'),
			'pengirim_surat' => $this->input->post('pengirim_surat'),
			'penandatangan' => $this->input->post('penandatangan'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'tujuan_surat_ke' => $this->input->post('tujuan_surat_ke'),
			'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_surat'),
			'tembusan_surat' => $this->input->post('tembusan_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'file_surat' => $file_surat,
			'updated_by' => $this->session->userdata('id_user'),
			'updated_date' => date('Y-m-d H:i:s')
		);
		$where = array('id_daftar_surat'=>$this->input->post('id'));
		$query=$this->M_all->update_data('daftar_surat',$data,$where);
		redirect('Surat_eksternal_keluar');
	}




}

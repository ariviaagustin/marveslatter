<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_eksternal extends CI_Controller {
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
		$role=$this->session->userdata('role');
		if($role==1){
			$data['se'] = $this->M_surat->surat_eksternal_compose()->result();
		}else{
		}
		
		$this->load->view('shared/header');
		$this->load->view('surat_eksternal/index', $data);
		$this->load->view('shared/footer');
	}

	public function tambah()
	{
		$where_jenis = array('status_jenis_surat'=>1,'nama_jenis_surat'=>'Surat');
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$where_unit = array('status_unit_kerja'=>1);
		$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where_unit)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		
		$this->load->view('shared/header');
		$this->load->view('surat_eksternal/tambah', $data);
		$this->load->view('shared/footer');
	}

	public function aksi_tambah()
	{
		$data = array(
			'id_compose'=>5,
			'id_internal_eksternal'=>2,
			'ket_internal_eksternal'=>'Eksternal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat'=>$this->input->post('jenis_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'tgl_surat' => $this->input->post('tanggal_surat'),
			'penandatangan' => $this->input->post('penandatangan_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'tujuan_surat_ke' => $this->input->post('tujuan_surat'),
			'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_surat'),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'isi_surat' => $this->input->post('isi_surat'),
			'no_surat' => $this->input->post('nomor_surat'),
			'status_surat' => 1,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');
		redirect('Surat_eksternal');
	}

	public function detail($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $se = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['se'] =  $se[0];

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();
		
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		$this->load->view('shared/header');
		$this->load->view('surat_eksternal/detail', $data);
		$this->load->view('shared/footer');
	}

	public function hapus($id)
	{
		$where = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where);
		redirect('Surat_eksternal');
	}

	public function export($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $se = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['se'] =  $se[0];

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();
		
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$data['instansi'] = $this->M_all->selectSemua('instansi')->result();
		$data['nama_file'] = "Surat Keluar - ".$se[0]->no_surat.".doc";
		if($data['instansi'][0]->kota_instansi != null)
        {
        	$kota = $data['instansi'][0]->kota_instansi;
        	$where_kota = array('id_kokab'=>$kota);
        	$kota = $this->M_all->selectX('entitas__kabupaten',$where_kota)->result();
        	$data['kota'] = $kota[0]->nama_kokab;
        }

		// print_r($data['ttd']); die();

		$this->load->view('surat_eksternal/export',$data);
	}

	public function ubah($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $se = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['se'] =  $se[0];

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$where_unit = array('status_unit_kerja'=>1);
		$data['unit'] = $this->M_all->selectX('master_unit_kerja', $where_unit)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		// print_r($data); die();
		$this->load->view('shared/header');
		$this->load->view('surat_eksternal/ubah', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/surat';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role.'eksternal-c';
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function aksi_ubah()
	{
		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }
		if($this->input->post('jumlah_file') == 0 || $this->input->post('jumlah_file') == '')
		{
        	// upload_file_surat
			$data = array(
				'sifat_surat' => $this->input->post('sifat_surat'),
				'tgl_surat' => $this->input->post('tanggal_surat'),
				'penandatangan' => $this->input->post('penandatangan_surat'),
				'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
				'perihal_surat' => $this->input->post('perihal_surat'),
				'tujuan_surat_ke' => $this->input->post('tujuan_surat'),
				'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_surat'),
				'lampiran_surat' => $this->input->post('lampiran_surat'),
				'isi_surat' => $this->input->post('isi_surat'),
				'no_surat' => $this->input->post('nomor_surat'),
				'status_surat' => $status,
				'updated_by' => $this->session->userdata('id_user'),
				'updated_date' => date('Y-m-d H:i:s')
			);
			$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query=$this->M_all->update_data('daftar_surat',$data,$where);

			$file_surat = $_FILES['file_surat']['name'];
	        if(isset($_FILES['file_surat']['name'])){
	            $this->upload_attachment();
	            if(!$this->upload->do_upload('file_surat')){
	                echo $this->upload->display_errors();
	            }else{
	                $file_surat = $this->upload->data()['file_name'];
		                $data_file = array(
						'file_surat' => $file_surat,
					);
					$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
					$query_file=$this->M_all->update_data('daftar_surat',$data_file,$where);
	            }
	        }
		}
		else
		{
			$data = array(
				'status_surat' => $status
			);
			$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query=$this->M_all->update_data('daftar_surat',$data,$where);
		}

		redirect('Surat_eksternal');
	}

}

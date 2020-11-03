<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_internal extends CI_Controller {
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
		$id_tingkat = $this->session->userdata('tingkat');
		$id_role = $this->session->userdata('role');
		
		if($id_tingkat=='1' OR $id_role=='1'){
			$data['data'] = $this->M_surat->suratkeluar_sik()->result();
		}else{
			
		}
		
		$this->load->view('shared/header');
		$this->load->view('internal/index',$data);
		$this->load->view('shared/footer');
	}

	public function tambah_surat_keluar()
	{
		$where = array('status_jenis_surat'=>1);
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$this->load->view('shared/header');
		$this->load->view('internal/tambah', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $config['upload_path']   = './uploads/sik';
        $config['file_name']     = rand(10000,99999).'_'.date('Y_m_d H:i:s').'_Dok_'.$username.'_'.$id_user;
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function aksi_tambah()
	{
		$tujuan_sik = json_encode($this->input->post('tujuan_sik'));
		$tembusan_surat = json_encode($this->input->post('tembusan_surat'));
		$jenis = $this->input->post('jenis_tujuan_sik');
		if($jenis==1){
			$ket_tujuan_surat='Perorangan';
		}else{
			$ket_tujuan_surat='Jabatan';
		}
 
		$this->load->library('upload');
		$config['upload_path'] = './uploads/sik';
	    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
	    $this->upload->initialize($config);
	    if($this->upload->do_upload('file_surat')){
	    $data=$this->upload->data();      
	      //$config['file_name'];
	    $file_surat = $data["file_name"];       
	    }else{ $file_surat = NULL; }

		$data = array(
			'id_internal_eksternal'=>1,
			'ket_internal_eksternal'=>'Internal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat' => $this->input->post('jenis_surat'),
			'pengirim_surat' => $this->input->post('pengirim_surat'),
			'penandatangan' => $this->input->post('penandatangan'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'jenis_tujuan_surat' => $this->input->post('jenis_tujuan_sik'),
			'ket_tujuan_surat' => $ket_tujuan_surat,
			'tujuan_surat_ke' => $tujuan_sik,
			'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_surat'),
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'tgl_surat_diterima' => $this->input->post('tgl_surat_diterima'),
			'tembusan_surat' => $tembusan_surat,
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'file_surat' => $file_surat,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s'),

		);
		$query=$this->M_all->insert_data($data,'daftar_surat');
		$id_daftar_surat=$this->db->insert_id($query);
		
		$jenis_tujuan_surat=$this->input->post('jenis_tujuan_sik');
		if($jenis_tujuan_surat==1){
			$ket_tujuan_surat='Perorangan';
		}else{
			$ket_tujuan_surat='Jabatan';
		}
		$tujuan_surat = $this->input->post('tujuan_sik');

		foreach ($this->input->post('tujuan_sik') as $key) 
		{
			$data_tujuan = array(
				'id_daftar_surat' => $id_daftar_surat,
				'jenis_tujuan_surat' => $this->input->post('jenis_tujuan_sik'),
				'ket_jenis_tujuan' => $ket_tujuan_surat,
				'tujuan_surat' => $key,
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		}

		$tembusan_surat = $this->input->post('tembusan_surat');
		foreach ($this->input->post('tembusan_surat') as $key1) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id_daftar_surat,
				'tembusan' => $key1,
			);
			$query_temb=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}

		echo $this->session->set_flashdata('msg2', "
          <div class='alert alert-primary alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='true'>x</button>
                  <h6>
                  	<i class='icon fas fa-check'></i>
                  	Berhasil! Data berhasil di Simpan.
                  </h6>
                  
        </div>");
		redirect('Surat_internal');
	}

	public function detail($id_daftar_surat)
	{
		$data['detail_sik'] = $this->M_surat->detail_sik($id_daftar_surat)->row();
		$this->load->view('shared/header');
		$this->load->view('internal/detail', $data);
		$this->load->view('shared/footer');
	}

	public function modal_file(){
      $where = array('id_daftar_surat'=>$_POST['id_daftar_surat']);
      $data['lampiran'] = $this->M_all->selectX('daftar_surat',$where);
      $this->load->view('internal/modal_file',$data); 
    }

    public function download($id_daftar_surat){
      $this->load->helper('download');
      $where = array('id_daftar_surat'=>$id_daftar_surat);
      $fileinfo = $this->M_surat->download_sik($id_daftar_surat);
      $download_path = 'uploads/sik/'.$fileinfo['file_surat'];
      $file_to_download = $download_path; // file to be downloaded
      header("Expires: 0");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");  header("Content-type: application/file");
      header('Content-length: '.filesize($file_to_download));
      header('Content-disposition: attachment; filename='.basename($file_to_download));
      readfile($file_to_download);
      exit; 
    }

    public function cetak($id_daftar_surat){
        $data['dpX'] = $this->M_surat->detail_sik($id_daftar_surat)->row();
        $where = $this->session->userdata('id_instansi');
		$data['instansi'] = $this->M_surat->instansi($where)->row();
        $this->load->view('internal/cetak',$data);        
    }

	public function hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat', $where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat', $where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat', $where3);
		redirect('Surat_internal');
	}





}

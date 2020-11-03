<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_eksternal_masuk extends CI_Controller {
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
		$role = $this->session->userdata('role');
		if($role!='1'){
							
			 
		}else{
			$data['data'] = $this->M_surat->suratmasuk_sem()->result();
			$this->load->view('shared/header');
			$this->load->view('eksternal/surat_masuk/index',$data);
			$this->load->view('shared/footer');
		}
	}

	public function tambah()
	{
		$where = array('status_jenis_surat'=>1);
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$where4 = array('status_tingkat_pengamanan'=>1);
		$data['tingkat_pengamanan'] = $this->M_all->selectX('master_tingkat_pengamanan',$where4)->result();
		$where5 = array('status_keaslian'=>1);
		$data['keaslian'] = $this->M_all->selectX('master_keaslian',$where5)->result();
		$where6 = array('status_aksi'=>1);
		$data['aksi'] = $this->M_all->selectX('master_aksi',$where6)->result();
		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_masuk/tambah', $data);
		$this->load->view('shared/footer');
	}

	public function aksi_tambah()
	{
		$this->load->library('upload');
		$config['upload_path'] = './uploads/sem';
	    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
	    $this->upload->initialize($config);
	    if($this->upload->do_upload('file_surat')){
	    $data=$this->upload->data();  
	    $file_surat = $data["file_name"];       
	    }else{ $file_surat = NULL; }
 
	    $tujuan_surat_ke = json_encode($this->input->post('tujuan_surat_ke'));
		$data = array(
			'id_internal_eksternal' =>2,
			'ket_internal_eksternal' =>'Eksternal',
			'id_surat_masuk_keluar' =>2,
			'ket_masuk_keluar' =>'Surat Masuk',
			'jenis_surat' => $this->input->post('jenis_surat'),
			'pengirim_surat' => $this->input->post('pengirim_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'jenis_tujuan_surat' =>2,
			'ket_tujuan_surat'=>'Jabatan',
			'tujuan_surat_ke' => $tujuan_surat_ke,
			'no_surat' => $this->input->post('no_surat'),
			'tgl_surat' => $this->input->post('tgl_surat'),
			'tgl_surat_diterima' => $this->input->post('tgl_surat_diterima'),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'keaslian_surat' => $this->input->post('keaslian_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'tingkat_pengamanan' => $this->input->post('tingkat_pengamanan'),
			'file_surat' => $file_surat,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');
		$id_daftar_surat=$this->db->insert_id($query);

		foreach ($this->input->post('tujuan_surat_ke') as $key) 
		{
			$data_tujuan = array(
				'id_daftar_surat' => $id_daftar_surat,
				'jenis_tujuan_surat' => 2,
				'ket_jenis_tujuan' => 'Jabatan',
				'tujuan_surat' => $key,
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		}
		$tujuan_surat_ke = json_encode($this->input->post('tujuan_surat_ke'));
		$data1 = array(
			'dari_pengirim' => $this->input->post('pengirim_surat'),
			'id_jenis_tujuan' =>2,
			'ket_jenis'=>'Jabatan',
			'kepada_tujuan' => $tujuan_surat_ke,
			'nomor_surat' => $this->input->post('no_surat'),
			'tanggal_diterima' => $this->input->post('tgl_surat_diterima'),
			'status_input' => 2,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s'),
			'is_read' => 1,
			'read_by' => $this->session->userdata('id_user'),
			'read_date' => date('Y-m-d H:i:s'),
			'teruskan_by' => $this->session->userdata('id_user'),
			'teruskan_date' => date('Y-m-d H:i:s'),
		);
		$query1=$this->M_all->insert_data($data1,'daftar_input_surat');

		echo $this->session->set_flashdata('msg2', "
          <div class='alert alert-primary alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='true'>x</button>
                  <h6>
                  	<i class='icon fas fa-check'></i>
                  	Berhasil! Data berhasil di Simpan.
                  </h6>
                  
        </div>");
		redirect('Surat_eksternal_masuk');
	}

	public function detail($id_daftar_surat)
	{	$data['detail_sem'] = $this->M_surat->detail_sem($id_daftar_surat)->row();
		$this->load->view('shared/header');
		$this->load->view('eksternal/surat_masuk/detail', $data);
		$this->load->view('shared/footer');
	}

	public function hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat',$where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_input_surat',$where3);
		redirect('Surat_eksternal_masuk');
	}

	public function download($id_daftar_surat){
      $this->load->helper('download');
      $where = array('id_daftar_surat'=>$id_daftar_surat);
      $fileinfo = $this->M_surat->download_sik($id_daftar_surat);
      $download_path = 'uploads/sem/'.$fileinfo['file_surat'];
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

    public function modal_file(){
      $where = array('id_daftar_surat'=>$_POST['id_daftar_surat']);
      $data['lampiran'] = $this->M_all->selectX('daftar_surat',$where);
      $this->load->view('eksternal/surat_masuk/modal_file',$data); 
    }

    public function cetak($id_daftar_surat){
        $data['dpX'] = $this->M_surat->detail_sem($id_daftar_surat)->row();
        $where = $this->session->userdata('id_instansi');
		$data['instansi'] = $this->M_surat->instansi($where)->row();
        $this->load->view('eksternal/surat_masuk/cetak',$data);        
    }

}

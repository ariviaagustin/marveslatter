<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry_surat extends CI_Controller {
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

        if(!isset($username) && ($id_role!='10')){
             redirect('Login/logout');
        }
    } 
	
	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data['surat']=$this->M_surat->data_input_surat($id_user)->result();
        $data['jmlh_all']=$this->M_surat->jmlh_entry_all($id_user);
        $data['jmlh_all_user']=$this->M_surat->jmlh_entry_all_user();
        //$data['jmlh_all_hari']=$this->M_surat->jmlh_entry_all_hari($id_user);
		$this->load->view('shared/header');
		$this->load->view('entry/surat', $data);
		$this->load->view('shared/footer');
	}

	public function tambah_surat(){
        $this->load->view('entry/surat_tambah'); 
    }

    public function tambah_surat_aksi()
    {
        $kodeunik=$this->M_surat->getkodeunik();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
  
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './uploads/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '150'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$kodeunik.$this->session->userdata('id_user').'-'.time().'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $kodeunik.$this->session->userdata('id_user').'-'.time(); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);
    	$data = array(
				'dari_pengirim' => $this->input->post('dari_pengirim'),
				'kepada_tujuan' => $this->input->post('kepada_tujuan'),
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_diterima' => $this->input->post('tanggal_diterima'),
                'yang_menyerahkan' => $this->input->post('yang_menyerahkan'),
                'no_ticket'=>$kodeunik,
                'barcode_input'   => $image_name,
				'status_input' => 0,
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('id_user'),
		);
		$query=$this->M_all->insert_data($data,'daftar_input_surat');

		echo $this->session->set_flashdata('msg2', "
        	<div class='alert alert-success alert-dismissible fade show' role='alert'>
            	<strong>Berhasil!</strong> Input Data berhasil Dilakukan
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
        </div>");
		redirect('Entry_surat');
    }

    public function detail_surat(){
    	$id_daftar_input = $_POST['id'];
      	$data['data'] = $this->M_surat->modal_detail_surat($id_daftar_input)->row();
        $this->load->view('entry/surat_detail', $data); 
    }

    public function ubah_surat(){
    	$id_daftar_input = $_POST['id'];
      	$data['data'] = $this->M_surat->modal_detail_surat($id_daftar_input)->row();
        $this->load->view('entry/surat_edit', $data); 
    }

    public function edit_surat_aksi()
    {
    	$id_daftar_input = $this->input->post('id_daftar_input');
    	$data = array(
				'dari_pengirim' => $this->input->post('dari_pengirim'),
				'kepada_tujuan' => $this->input->post('kepada_tujuan'),
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tanggal_diterima' => $this->input->post('tanggal_diterima'),
                'yang_menyerahkan' => $this->input->post('yang_menyerahkan'),
				'updated_date' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_user'),
		);
    	$where = array('id_daftar_input' => $id_daftar_input);
    	$this->M_all->update_data('daftar_input_surat',$data,$where);
    	echo $this->session->set_flashdata('msg3', "
        	<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            	<strong>Berhasil!</strong> Edit Data berhasil Dilakukan
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
        </div>");
    	redirect('Entry_surat');
    }

    public function surat_hapus($id)
	{
		$where1 = array('id_daftar_input' => $id);
		$this->M_all->delete_data('daftar_input_surat',$where1);
		redirect('Entry_surat');
	}

    public function cetak_tanda($id_daftar_input){
        $data['dpX'] = $this->M_surat->modal_detail_surat($id_daftar_input)->row();
        $where = $this->session->userdata('id_instansi');
        $data['instansi'] = $this->M_surat->instansi($where)->row();
        $this->load->view('entry/tanda_terima',$data);        
    }

}

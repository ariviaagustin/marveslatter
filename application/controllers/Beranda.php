<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('M_all');
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
        if($role==1 || $role==11){
            $data['jmlh_ski']=$this->M_surat->jmlh_ski();
            $data['jmlh_sme']=$this->M_surat->jmlh_sme();
            $data['jmlh_ske']=$this->M_surat->jmlh_ske();
            $data['jmlh_srt']=$this->M_surat->jmlh_srt();
            $data['jmlh_nd']=$this->M_surat->jmlh_nd();
            $data['jmlh_st']=$this->M_surat->jmlh_st();
            $data['jmlh_u']=$this->M_surat->jmlh_u();
        }else{

        }
		$this->load->view('shared/header');
		$this->load->view('shared/index', $data);
		$this->load->view('shared/footer');
	}

    public function instansi()
    {
        $role = $this->session->userdata('role');
        if($role==1){
            $data['prov'] = $this->M_all->selectSemua('entitas__provinsi')->result();
            $instansi = $this->M_all->selectSemua('instansi')->result();
            $data['instansi'] = $instansi[0];
            if($instansi[0]->provinsi_instansi != null)
            {
                $prov = $instansi[0]->provinsi_instansi;
                $where_kab = array('id_provinsi'=>$prov);
                $data['kab'] = $this->M_all->selectX('entitas__kabupaten',$where_kab)->result();
            }
            if($instansi[0]->kota_instansi != null)
            {
                $kota = $instansi[0]->kota_instansi;
                $where_kec = array('id_kokab'=>$kota);
                $data['kec'] = $this->M_all->selectX('entitas__kecamatan',$where_kec)->result();
            }
            if($instansi[0]->kecamatan_instansi != null)
            {
                $kec = $instansi[0]->kecamatan_instansi;
                $where_kel = array('id_kecamatan'=>$kec);
                $data['kel'] = $this->M_all->selectX('entitas__kelurahan',$where_kel)->result();
            }
            // print_r($data);die();
            $this->load->view('shared/header');
            $this->load->view('instansi/instansi', $data);
            $this->load->view('shared/footer');

        }else{
            $this->load->view('shared/not_access');
        }
    }

    public function get_kecamatan($kabupaten)
    {
        $query = $this->db->get_where('entitas__kecamatan', array('id_kokab' => $kabupaten));
        $data = "<option disabled >--Pilih Kecamatan--</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kecamatan."'>".$value->nama_kecamatan."</option>";
        }
        echo $data;
    }

    public function get_kelurahan($kecamatan)
    {
        $query = $this->db->get_where('entitas__kelurahan', array('id_kecamatan' => $kecamatan));
        $data = "<option disabled >--Pilih Kelurahan--</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_deskel."'>".$value->nama_deskel."</option>";
        }
        echo $data;
    }

    public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './assets/img/logo_instansi';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role;
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

    public function aksi_ubah()
    {
        $logo_instansi = $_FILES['logo_instansi']['name'];
        if(isset($_FILES['logo_instansi']['name'])){
            $this->upload_attachment();
            if(!$this->upload->do_upload('logo_instansi')){
                $logo_instansi=$this->input->post('logo_instansi_old');
            }else{
                $logo_instansi = $this->upload->data()['file_name'];
                $logo_instansi_old = './assets/img/logo_instansi/'.$this->input->post('logo_instansi_old');
                if(file_exists($logo_instansi_old)) { unlink($logo_instansi_old); }
            }
        }
        $data = array(
            'no_instansi' => $this->input->post('no_instansi'),
            'nama_instansi' => $this->input->post('nama_instansi'),
            'provinsi_instansi' => $this->input->post('provinsi_instansi'),
            'kota_instansi' => $this->input->post('kota_instansi'),
            'kecamatan_instansi' => $this->input->post('kecamatan_instansi'),
            'kelurahan_instansi' => $this->input->post('kelurahan_instansi'),
            'alamat_instansi' => $this->input->post('alamat_instansi'),
            'kode_pos' => $this->input->post('kode_pos'),
            'logo_instansi' => $logo_instansi,
            'updated_by' => $this->session->userdata('username'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $where = array('id'=>$this->input->post('id'));
        $query=$this->M_all->update_data('instansi', $data, $where);
        redirect('Beranda/instansi');
    }




}

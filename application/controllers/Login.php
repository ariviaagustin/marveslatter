<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('M_all');
        $this->load->library('user_agent');
        date_default_timezone_set("Asia/Jakarta");   
    }
	
	public function index()
	{
		$this->load->view('login/login');
	}

	public function aksi_login(){
		$username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $data = $this->M_all->cek_login($username, $password);
        $row = json_encode($data);
        
        if($row == 0) 
        {
            $message['msg3'] = 'Akun Belum Terdaftar';
            $this->session->set_userdata($message);
            redirect('Login/');
        }
        else
        {
            $where=array('username'=>$username,'password'=>$password);
            $query_=$this->M_all->selectX('user',$where);
            if(count($query_->result()) > 0)
            {
                $query = $query_->row();
                $instansi = $this->db->get('instansi')->row();
                $where_peg=array('id_data_pegawai'=>$query->id_pegawai);
                $pegawai=$this->M_all->selectX('data_pegawai',$where_peg)->row();
                $session = array(
                  'id_user' => $query->id_user,
                  'username' => $query->username,
                  'password' => $query->password,
                  'role' => $query->role,
                  'tingkat' => $query->tingkat,
                  'nama_user' => $query->nama_user,
                  'status' => $query->status_user,
                  'no_pegawai' => $query->no_pegawai,
                  'id_pegawai' => $query->id_pegawai,
                  'id_instansi' => $instansi->id,
                  'nama_instansi' => $instansi->nama_instansi,
                  'nama_pegawai' => $pegawai->nama_pegawai,
                  'jabatan' => $pegawai->jabatan,
                  'unit_kerja' => $pegawai->unit_kerja,
                  'bagian_unit_kerja' =>$pegawai->bagian_unit_kerja,
                  'sub_bagian_unit' =>$pegawai->sub_bagian_unit
                );
                $this->session->set_userdata($session);

                $id_user      = $query->id_user;
                $username     = $query->username;
                $this->session->set_userdata($session);
                
                  if ($this->agent->is_browser())
			      {
			        $agent = $this->agent->browser();
			      }
			      elseif ($this->agent->is_robot())
			      {
			        $agent = $this->agent->robot();
			      }
			      elseif ($this->agent->is_mobile())
			      {
			         $agent = $this->agent->mobile();
			      }
			      else
			      {
			        $agent = 'Unidentified User Agent';
			      }
      
			      $id_user      = $query->id_user;
			      $browser_log    = $agent;
			      $browser_version  = $this->agent->version();
			      $platform_log     = $this->agent->platform(); 
			      $ip_log       = $this->input->ip_address();
			      $data = array(
			        'id_user'=>$id_user,
			        'browser_log'=>$browser_log,
			        'browser_version'=>$browser_version,
			        'platform_log'=>$platform_log,
			        'ip_log'=>$ip_log,
			        'date_login'=>date('Y-m-d H:i:s')
			      );
			      $id_log = $this->db->insert('user__logs',$data);
			      $log= $this->db->insert_id($id_log);

                  if($query->status_user == '1') 
                  {
                     if($query->role == 10){
                        redirect('Entry_surat');
                     }elseif($query->role == 11){
                        redirect('Entry_persuratan');
                     }else{
                        redirect('Beranda');
                     }
                    
                  }
            }
            else
            {
                $message['msg2'] = 'Username atau password salah';
                $this->session->set_userdata($message);
                redirect('Login/');
            }
        }
	}

	public function logout()
  	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}

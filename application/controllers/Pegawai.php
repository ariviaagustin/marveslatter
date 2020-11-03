<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
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
		$role = $this->session->userdata('role');
		if($role==1){
			$data['pegawai'] = $this->M_master->data_pegawai()->result();
			$this->load->view('shared/header');
			$this->load->view('pegawai/index', $data);
			$this->load->view('shared/footer');
		}else{
			$this->load->view('shared/not_access');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('status'=>1);
			$data['lembaga'] = $this->M_all->selectX('instansi',$where)->result();
			$where2 = array('status_jabatan'=>1);
			$data['jabatan'] = $this->M_all->selectX('master_jabatan',$where2)->result();
			$where3 = array('status_golongan'=>1);
			$data['golongan'] = $this->M_all->selectX('master_golongan',$where3)->result();
			$where4 = array('status_agama'=>1);
			$data['agama'] = $this->M_all->selectX('master_agama',$where4)->result();
			$where5 = array('status_pendidikan'=>1);
			$data['pendidikan'] = $this->M_all->selectX('master_pendidikan',$where5)->result();
			$data['prov'] = $this->M_all->selectSemua('entitas__provinsi')->result();
			$this->load->view('shared/header');
			$this->load->view('pegawai/tambah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	function get_unit(){  
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
        
        $data = $this->M_master->get_jabatan_unit($id_instansi, $id_unit_kerja);
              
        echo '<select required class="form-control select2" style="width: 100%;" name="jabatan" id="div_jabatan">
        <option value="">--Pilih Jabatan--</option>';

        foreach($data as $c){
            echo '<option value="'.$c->id_jabatan.'">'.$c->nama_jabatan.'</option>';
        }
        echo '</select>';
  	}

  	function get_jabatan(){
        $this->load->model('M_master');
        $id_instansi = $this->input->post('id_instansi');
        $id_unit_kerja = $this->input->post('id_unit_kerja');
        $id_bagian_unit = $this->input->post('id_bagian_unit');
        
        $data = $this->M_master->get_jabatan($id_instansi, $id_unit_kerja, $id_bagian_unit);
             
        echo '<select required class="form-control select2" style="width: 100%;" name="jabatan" id="jab">
        <option value="0">--Pilih Jabatan--</option>';

        foreach($data as $c){
            echo '<option value="'.$c->id_jabatan.'">'.$c->nama_jabatan.'</option>';
        }
        echo '</select>';
  	}

  	public function upload_attachment()
    {
        $id = $this->session->userdata('id_user');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './assets/img/pegawai';
        $config['file_name']     = rand(10000,99999).'_'.$id.'_'.$role;
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

    public function aksi_tambah()
	{
		$foto_pegawai = $_FILES['foto_pegawai']['name'];
        if(isset($_FILES['foto_pegawai']['name'])){
            $this->upload_attachment();
            if(!$this->upload->do_upload('foto_pegawai')){
                echo $this->upload->display_errors();
            }else{
                $foto_pegawai = $this->upload->data()['file_name'];
            }
        }
        $id_instansi = $this->input->post('id_instansi');
        $id_unit_kerja = $this->input->post('id_unit_kerja');
        $id_jabatan = $this->input->post('jabatan');

        $where = array('id_jabatan'=>$id_jabatan, 'id_unit_kerja'=>$id_unit_kerja, 'id_instansi'=>$id_instansi);
        $dt = $this->M_all->selectX('master_jabatan', $where)->row();
        $bagian_unit_kerja = $dt->id_bagian_unit;
        $sub_bagian = $dt->id_sub_bagian;
        $eselon_id = $dt->eselon_id;
        $nama_jabatan = $dt->nama_jabatan;
        $jabatan_parent = $dt->jabatan_parent;

		$data = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'unit_kerja' =>$this->input->post('id_unit_kerja'),
			'bagian_unit_kerja' => $bagian_unit_kerja,
			'sub_bagian_unit' => $sub_bagian,
			'eselon_id' => $eselon_id,
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'gelar_sebelum' => $this->input->post('gelar_sebelum'),
			'gelar_setelah' => $this->input->post('gelar_setelah'),
			'no_pegawai' => $this->input->post('no_pegawai'),
			'nik' => $this->input->post('nik'),
			'jabatan' => $this->input->post('jabatan'),
			'nama_jabatan' => $nama_jabatan,
			'jabatan_parent' => $jabatan_parent,
			'ref_tmt_jabatan' => $this->input->post('ref_tmt_jabatan'),
			'sampai_tmt' => $this->input->post('sampai_tmt'),
			'id_golongan' => $this->input->post('id_golongan'),
			'ref_tmt_pangkat' => $this->input->post('ref_tmt_pangkat'),
			'gender_id' => $this->input->post('gender_id'),		
			'agama_id' => $this->input->post('agama_id'),
			'tempat_lahir' =>$this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'kecamatan' =>$this->input->post('kecamatan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'alamat_pegawai' => $this->input->post('alamat_pegawai'),
			'kode_pos' => $this->input->post('kode_pos'),
			'foto_pegawai' =>$foto_pegawai,
			'status' => $this->input->post('status'),
			'status_plt' => $this->input->post('status_plt'),
			'email' => $this->input->post('email'),
			'pendidikan_id' => $this->input->post('pendidikan_id'),
			'created_by' => $this->session->userdata('id_user'),
			'created_at' => date('Y-m-d H:i:s')
		);
			
		$query=$this->M_all->insert_data($data,'data_pegawai');

		$id = $this->db->insert_id();

		$where_eselon = array('id_eselon'=>$eselon_id);
		$eselon = $this->M_all->selectX('master_eselon',$where_eselon)->row();

		$where_role = array('id_role'=>$eselon->tingkat_eselon);
		$role_ = $this->M_all->selectX('entitas__role',$where_role)->row();
		$role = $role_->id_role;
		$tingkat = $role_->alias_role;
		
		$data_user = array(
			'id_pegawai' => $id,
			'no_pegawai' => $this->input->post('no_pegawai'),
			'nama_user' => $this->input->post('nama_pegawai'),
			'username' => 'user'.$id.$role,
			'password' => md5('user'.$id.$role),
			'role' => $role,
			'tingkat' => $tingkat,
			'nama_user' => $this->input->post('nama_pegawai'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_unit_kerja' =>$this->input->post('id_unit_kerja'),
			'id_bagian_unit' => $bagian_unit_kerja,
			'id_sub_bagian' => $sub_bagian,
			'status_user' => $this->input->post('status'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
		);
			
		$query_user=$this->M_all->insert_data($data_user,'user');
		redirect('Pegawai');
	}


	public function detail($id)
	{
		if($this->session->userdata('role') == 1)
		{
			$where = array('id_data_pegawai'=>$id);
	        $pegawai = $this->M_all->selectX('data_pegawai',$where)->result();
	        $data['pegawai'] = $pegawai[0];
	        $where_jab = array('status_jabatan'=>1);
			$data['jabatan'] = $this->M_all->selectX('master_jabatan',$where_jab)->result();
			$where_unit = array('status_unit_kerja'=>1);
			$data['unit_kerja'] = $this->M_all->selectX('master_unit_kerja',$where_unit)->result();
			$where_bag = array('status_bagian'=>1);
			$data['bagian'] = $this->M_all->selectX('master_bag_unit_kerja', $where_bag)->result();
			if($pegawai[0]->provinsi)
			{
				$where_prov = array('id_provinsi'=>$pegawai[0]->provinsi);
				$prov = $this->M_all->selectX('entitas__provinsi', $where_prov)->result();
				$data['prov'] = $prov[0]->nama_provinsi;
			}
			if($pegawai[0]->kota)
			{
				$where_kab = array('id_kokab'=>$pegawai[0]->kota);
				$kab = $this->M_all->selectX('entitas__kabupaten', $where_kab)->result();
				$data['kab'] = $kab[0]->nama_kokab;
			}
			if($pegawai[0]->kecamatan)
			{
				$where_kec = array('id_kecamatan'=>$pegawai[0]->kecamatan);
				$kec = $this->M_all->selectX('entitas__kecamatan', $where_kec)->result();
				$data['kec'] = $kec[0]->nama_kecamatan;
			}
			if($pegawai[0]->kelurahan)
			{
				$where_kel = array('id_deskel'=>$pegawai[0]->kelurahan);
				$kel = $this->M_all->selectX('entitas__kelurahan', $where_kel)->result();
				$data['kel'] = $kel[0]->nama_deskel;
			}
			$this->load->view('shared/header');
			$this->load->view('pegawai/detail', $data);
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
			$where = array('id_data_pegawai'=>$id);
	        $pegawai = $this->M_all->selectX('data_pegawai',$where)->result();
	        $data['pegawai'] = $pegawai[0];
	        $where_jab = array('status_jabatan'=>1);
			$data['jabatan'] = $this->M_all->selectX('master_jabatan',$where_jab)->result();
			$where_unit = array('status_unit_kerja'=>1);
			$data['unit_kerja'] = $this->M_all->selectX('master_unit_kerja',$where_unit)->result();
			$where_bag = array('status_bagian'=>1);
			$data['bagian'] = $this->M_all->selectX('master_bag_unit_kerja', $where_bag)->result();
			$data['prov'] = $this->M_all->selectSemua('entitas__provinsi')->result();
			if($pegawai[0]->kota)
			{
				$where_kab = array('id_kokab'=>$pegawai[0]->provinsi);
				$data['kab'] = $this->M_all->selectX('entitas__kabupaten', $where_kab)->result();
			}
			if($pegawai[0]->kecamatan)
			{
				$where_kec = array('id_kecamatan'=>$pegawai[0]->kota);
				$data['kec'] = $this->M_all->selectX('entitas__kecamatan', $where_kec)->result();
			}
			if($pegawai[0]->kelurahan)
			{
				$where_kel = array('id_deskel'=>$pegawai[0]->kecamatan);
				$data['kel'] = $this->M_all->selectX('entitas__kelurahan', $where_kel)->result();
			}
			// print_r($data); die();
			$this->load->view('shared/header');
			$this->load->view('pegawai/ubah', $data);
			$this->load->view('shared/footer');
		}
		else
		{
			$this->load->view('shared/not_access');
		}
	}

	public function aksi_ubah()
	{
		$foto_pegawai = $_FILES['foto_pegawai']['name'];
        if(isset($_FILES['foto_pegawai']['name'])){
            $this->upload_attachment();
            if(!$this->upload->do_upload('foto_pegawai')){
                $foto_pegawai=$this->input->post('foto_pegawai_old');
            }else{
                $foto_pegawai = $this->upload->data()['file_name'];
                $foto_pegawai_old = './assets/img/pegawai/'.$this->input->post('foto_pegawai_old');
				if(file_exists($foto_pegawai_old)) { unlink($foto_pegawai_old); }
            }
        }
		$data = array(
			'no_pegawai' => $this->input->post('no_pegawai'),
			'nik' => $this->input->post('nik'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'alamat_pegawai' => $this->input->post('alamat_pegawai'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'kecamatan' =>$this->input->post('kecamatan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kode_pos' => $this->input->post('kode_pos'),
			'tempat_lahir' =>$this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'jabatan' => $this->input->post('jabatan'),
			'unit_kerja' =>$this->input->post('unit_kerja'),
			'bagian_unit_kerja' => $this->input->post('bagian_unit_kerja'),
			'status' => $this->input->post('status'),
			'foto_pegawai' =>$foto_pegawai,
			'updated_by' => $this->session->userdata('id_user'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$where = array('id_data_pegawai'=>$this->input->post('id'));
		$query=$this->M_all->update_data($where,$data,'data_pegawai');

		$where_jab = array('id_jabatan'=>$this->input->post('jabatan'));
		$jabatan = $this->M_all->selectX('master_jabatan',$where_jab)->result();

		$where_role = array('id_role'=>$jabatan[0]->id_role);
		$role_ = $this->M_all->selectX('entitas__role',$where_role)->result();
		$role = $role_[0]->id_role;
		$tingkat = $role_[0]->alias_role;

		$where_user_1 =  array('id_pegawai'=>$this->input->post('id'));
		$user_ = $this->M_all->selectX('user',$where_user_1)->result();
		$id_user = $user_[0]->id_user;
		
		$data_user = array(
			'no_pegawai' => $this->input->post('no_pegawai'),
			'role' => $role,
			'tingkat' => $tingkat,
			'nama_user' => $this->input->post('nama_pegawai'),
			'id_instansi' => $this->session->userdata('id_instansi'),
			'status_user' => $this->input->post('status'),
			'created_at' => date('Y-m-d H:i:s')
		);
		$where_user = array('id_user'=>$id_user);
		$query_user =$this->M_all->update_data('user', $data_user, $where_user);
		redirect('Pegawai');
	}

	public function hapus($id)
	{
		$where = array('id_data_pegawai' => $id);
		$this->M_all->delete_data('data_pegawai', $where);
		$where_user = array('id_pegawai' => $id);
		$this->M_all->delete_data('user', $where_user);
		redirect('Pegawai');
	}


	

}

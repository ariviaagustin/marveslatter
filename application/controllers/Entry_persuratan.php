<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry_persuratan extends CI_Controller {
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

        if(!isset($username) && ($id_role=='11')){
             redirect('Login/logout');
        }
    }
	
	public function index()
	{
		$data['data']=$this->M_surat->data_input_masuk()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$this->load->view('shared/header');
		$this->load->view('persuratan/index', $data);
		$this->load->view('shared/footer');
	}

	public function input($id_daftar_input)
	{
		$data=array(
			'status_input'=>1,
			'is_read'=>1,
			'read_by'=>$this->session->userdata('id_user'),
			'read_date'=>date('Y-m-d H:i:s'),
		);
		$where=array('id_daftar_input'=>$id_daftar_input);
		$query=$this->M_all->update_data('daftar_input_surat', $data, $where);
		$datadetail['detail']=$this->M_surat->modal_detail_surat($id_daftar_input)->row();
		$datadetail['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$datadetail['tembusan']=$this->M_surat->tembusan()->result();
		$datadetail['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$datadetail['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$datadetail['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$datadetail['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('persuratan/input', $datadetail);
		$this->load->view('shared/footer');
	}

	public function input_baca($id_daftar_input)
	{
		$datadetail['detail']=$this->M_surat->modal_detail_surat($id_daftar_input)->row();
		$datadetail['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$datadetail['tembusan']=$this->M_surat->tembusan()->result();
		$datadetail['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$datadetail['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$datadetail['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$datadetail['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('persuratan/input', $datadetail);
		$this->load->view('shared/footer');
	}

	public function aksi_ubah()
	{
		$data1=array(
			'status_input'=>2,
			'teruskan_by'=>$this->session->userdata('id_user'),
			'teruskan_date'=>date('Y-m-d H:i:s'),
		);
		$where1=array('id_daftar_input'=>$this->input->post('id_daftar_input'));
		$query1=$this->M_all->update_data('daftar_input_surat', $data1, $where1);

		$jenis_tujuan_surat = $this->input->post('id_jenis_tujuan');
		$tujuan_surat_ke = json_encode($this->input->post('tujuan_surat_ke'));

		if($jenis_tujuan_surat==1){
			$ket_jenis_tujuan='Perorangan';
		}elseif($jenis_tujuan_surat==2){
			$ket_jenis_tujuan='Jabatan';
		}elseif($jenis_tujuan_surat==3){
			$ket_jenis_tujuan='Bagian Unit Kerja';
		}else{
			$ket_jenis_tujuan='Unit Kerja';
		}
		$data=array(
			'id_daftar_input'=>$this->input->post('id_daftar_input'),
			'id_internal_eksternal'=>2,
			'ket_internal_eksternal'=>'Eksternal',
			'id_surat_masuk_keluar'=>2,
			'ket_masuk_keluar'=>'Surat Masuk',
			'pengirim_surat'=>$this->input->post('dari_pengirim'),
			'jenis_tujuan_surat'=>$this->input->post('id_jenis_tujuan'),
			'ket_tujuan_surat'=>$ket_jenis_tujuan,
			'tujuan_surat_ke'=>$tujuan_surat_ke,
			'no_surat'=>$this->input->post('nomor_surat'),
			'tgl_surat_diterima'=>$this->input->post('tgl_surat_diterima'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'perihal_surat'=>$this->input->post('perihal_surat'),
			'created_by'=>$this->session->userdata('id_user'),
			'created_date'=>date('Y-m-d H:i:s'),
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');
		$id = $this->db->insert_id();

		foreach ($this->input->post('tujuan_surat_ke') as $key) 
		{
			$data_tujuan = array(
				'id_daftar_surat' => $id,
				'jenis_tujuan_surat' => $this->input->post('id_jenis_tujuan'),
				'ket_jenis_tujuan'=>$ket_jenis_tujuan,
				'tujuan_surat' => $key,
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		}
		echo $this->session->set_flashdata('msg2', "
        	<div class='alert alert-success alert-dismissible fade show' role='alert'>
            	<strong>Berhasil!</strong> Input Identitas berhasil Dilakukan
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
        </div>");
		redirect('Entry_persuratan/kirim_surat/'.$id);
	}

	public function kirim_surat($id_daftar_input)
	{
		$data['detail']=$this->M_surat->daftar_kirim_surat($id_daftar_input)->row();
		$where = array('status_jenis_surat'=>1);
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where4 = array('status_tingkat_pengamanan'=>1);
		$data['tingkat_pengamanan'] = $this->M_all->selectX('master_tingkat_pengamanan',$where4)->result();
		$where5 = array('status_keaslian'=>1);
		$data['keaslian'] = $this->M_all->selectX('master_keaslian',$where5)->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		$this->load->view('shared/header');
		$this->load->view('persuratan/kirim_surat', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/sem';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role;
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function aksi_kirim()
	{
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
		            $id_daftar_surat=$this->input->post('id_daftar_surat');
					$where1 = array('id_daftar_surat'=>$id_daftar_surat);
					$query_file=$this->M_all->update_data('daftar_surat',$data_file, $where1);
	            }
	    }

        $data = array(
			'jenis_surat' => $this->input->post('jenis_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'keaslian_surat' => $this->input->post('keaslian_surat'),
			'sifat_surat' => $this->input->post('sifat_surat'),
			'tingkat_pengamanan' => $this->input->post('tingkat_pengamanan'),
			'status_surat'=>2,
			'updated_by' => $this->session->userdata('id_user'),
			'updated_date' => date('Y-m-d H:i:s'),
		);
		$where=array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
		$query=$this->M_all->update_data('daftar_surat', $data, $where);

		$data2=array(
			'status_input'=>3,
		);
		$where2=array('id_daftar_input'=>$this->input->post('id_daftar_input'));
		$query2=$this->M_all->update_data('daftar_input_surat', $data2, $where2);
		echo $this->session->set_flashdata('msg2', "
          <div class='alert alert-primary alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='true'>x</button>
                  <h6>
                  	<i class='icon fas fa-check'></i>
                  	Berhasil! Surat berhasil di KIRIM.
                  </h6>
                  
        </div>");
        redirect('Entry_persuratan');
	}

	public function cetak_tanda($id_daftar_input){
        $data['dpX'] = $this->M_surat->modal_detail_surat($id_daftar_input)->row();
        $where = $this->session->userdata('id_instansi');
        $data['instansi'] = $this->M_surat->instansi($where)->row();
        $this->load->view('persuratan/tanda_terima',$data);        
    }

    public function cetak_tanda_2($id_daftar_input){
        $data['dpX'] = $this->M_surat->modal_detail_surat($id_daftar_input)->row();
        $where = $this->session->userdata('id_instansi');
        $data['instansi'] = $this->M_surat->instansi($where)->row();
        $data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
        $this->load->view('persuratan/tanda_terima_2',$data);        
    }






}

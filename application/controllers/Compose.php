<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compose extends CI_Controller {
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
		$tingkat=$this->session->userdata('tingkat');
		$id_data_pegawai=$this->session->userdata('id_pegawai');
		$jabatan=$this->session->userdata('jabatan');
		$user=$this->session->userdata('id_user');

		if($tingkat=='1'){
			$data['notadinas'] = $this->M_surat->notadinas()->result();
			// print_r($data['notadinas']);
			// die();
		}else{
			// $data['notadinas'] = $this->M_all->notadinas_user($id_data_pegawai, $jabatan, $user)->result();
		}
		$this->load->view('shared/header');
		$this->load->view('compose/notadinas',$data);
		$this->load->view('shared/footer');
	}

	public function notadinas_tambah()
	{
		$where = array('status_jenis_surat'=>1,'nama_jenis_surat'=>'Nota Dinas');
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/notadinas_tambah', $data);
		$this->load->view('shared/footer');
	}

	public function notadinas_aksi()
	{
		$tembusan_nota_dinas = json_encode($this->input->post('tembusan_nota_dinas'));
		$data = array(
			'id_compose'=>1,
			'id_internal_eksternal'=>1,
			'ket_internal_eksternal'=>'Internal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat' => $this->input->post('jenis_surat'),
			'sifat_surat' => $this->input->post('sifat_nota_dinas'),
			'tgl_surat' => $this->input->post('tanggal_nota_dinas'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_nota_dinas'),
			'perihal_surat' => $this->input->post('perihal_nota_dinas'),
			'no_surat' => $this->input->post('nomor_nota_dinas'),
			'jenis_tujuan_surat'=>2,
			'ket_tujuan_surat'=>'Jabatan',
			'tujuan_surat_ke' => $this->input->post('tujuan_nota_dinas'),
			'tembusan_surat' => $tembusan_nota_dinas,
			'isi_surat' => $this->input->post('isi_nota_dinas'),
			'lampiran_surat' => $this->input->post('lampiran_nota_dinas'),
			'penandatangan' => $this->input->post('penandatangan_nota_dinas'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
			'status_surat' => 1,
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');

		$id = $this->db->insert_id();

		$data_tujuan = array(
			'id_daftar_surat' => $id,
			'jenis_tujuan_surat'=>2,
			'ket_jenis_tujuan'=>'Jabatan',
			'tujuan_surat' => $this->input->post('tujuan_nota_dinas'),
		);
		$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');

		foreach ($this->input->post('tembusan_nota_dinas') as $key) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id,
				'tembusan' => $key,
			);
			$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}
		redirect('Compose');
	}

	public function notadinas_hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat',$where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat',$where3);
		redirect('Compose');
	}

	public function notadinas_detail($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->notadinas_detail($id_daftar_surat)->row();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/notadinas_detail',$data);
		$this->load->view('shared/footer');
	}

	public function export_notadinas($id_daftar_surat)
	{
		header ("Content-type: text/html; charset=utf-8");
	    $this->load->library('word');
	    
	    
	    $PHPWord = new PHPWord();
	    $document = $PHPWord->loadTemplate('assets/template/notadinas.docx');
       	    
	    $query = $this->M_surat->notadinas_export($id_daftar_surat)->row();
	    //print_r($query->isi_nota_dinas);
	    //die();

	    $document->setValue('{nomor_nota_dinas}', $query->no_surat);
	    $document->setValue('{perihal_nota_dinas}', $query->perihal_surat);
	    $document->setValue('{isi_nota}', html_special($query->isi_surat));
	    $document->setValue('{nama_pegawai_ttd}', $query->nama_pegawai);
	    $document->setValue('{tanggal_nota_dinas}', $query->tgl_surat);
	    $document->setValue('{nama_jabatan_yth}', $query->nama_jabatan);

	    	   
	    $tembusan = json_decode($query->tembusan_surat);
	    $nomer = '1';
	    foreach ($tembusan as $key) {
	        $key;
	        $where=array('id_data_pegawai'=>$key);
	        $query_=$this->M_all->selectX('data_pegawai', $where)->result();

	         foreach ($query_ as $q1) {
	             $nama_pegawai1[] = $q1->nama_pegawai;
	             $nama_jabatan1[] = $q1->nama_jabatan;
	             $nomer2[] = $nomer++;
	         }
	     }

	    $data1 = array(
	         'no' => $nomer2,
	         'nama_pegawai_tembusan' => $nama_pegawai1,
	         'nama_jabatan_tembusan' => $nama_jabatan1,
	     );
	     
	    // // clone rows 
	    $document->cloneRow('TBL1', $data1);
	    $tmp_file = 'Nota_Dinas.docx';
	    $document->save('./file_export/'.$tmp_file);

	    // $filePath = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? $file_docx : $file_pdf ;

	    set_time_limit(0);
	    header('Connection: Keep-Alive');
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($tmp_file).'"');
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize('./file_export/'.$tmp_file));
	    ob_clean();
	    flush();
	    readfile('./file_export/'.$tmp_file);
	}

	public function notadinas_edit($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->notadinas_detail($id_daftar_surat)->row();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
	    $data['ttd'] = $this->M_surat->pegawai_jab()->result();

		$this->load->view('shared/header');
		$this->load->view('compose/notadinas_edit',$data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment_notadinas()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/notadinas';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role.'_nd';
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function notadinas_aksiedit()
	{	
		$tembusan_nota_dinas = json_encode($this->input->post('tembusan_nota_dinas'));
		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }
		if($this->input->post('jumlah_file') == 0 || $this->input->post('jumlah_file')=='')
		{
			$data = array(
				'sifat_surat' => $this->input->post('sifat_nota_dinas'),
				'tgl_surat' => $this->input->post('tanggal_nota_dinas'),
				'klasifikasi_surat' => $this->input->post('klasifikasi_nota_dinas'),
				'perihal_surat' => $this->input->post('perihal_nota_dinas'),
				'no_surat' => $this->input->post('nomor_nota_dinas'),
				'tujuan_surat_ke' => $this->input->post('tujuan_nota_dinas'),
				'tembusan_surat' => $tembusan_nota_dinas,
				'isi_surat' => $this->input->post('isi_nota_dinas'),
				'lampiran_surat' => $this->input->post('lampiran_nota_dinas'),
				'penandatangan' => $this->input->post('penandatangan_nota_dinas'),
				'status_surat' => $status,
				'updated_by' => $this->session->userdata('id_user'),
				'updated_date' => date('Y-m-d H:i:s')
			);
			$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query=$this->M_all->update_data('daftar_surat',$data,$where);

			$file_surat = $_FILES['file_surat']['name'];
	        if(isset($_FILES['file_surat']['name'])){
	            $this->upload_attachment_notadinas();
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
	        $id_daftar_surat = $this->input->post('id_daftar_surat');
	        $where_tujuan = array('id_daftar_surat'=> $id_daftar_surat);
			$this->M_all->delete_data('daftar_tujuan_surat',$where_tujuan);

			$data_tujuan = array(
				'id_daftar_surat' => $this->input->post('id_daftar_surat'),
				'jenis_tujuan_surat'=>2,
				'ket_jenis_tujuan'=>'Jabatan',
				'tujuan_surat' => $this->input->post('tujuan_nota_dinas'),
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');

			$id_daftar_surat=$this->input->post('id_daftar_surat');
			$where_tembusan = array('id_daftar_surat' => $id_daftar_surat);
			$this->M_all->delete_data('daftar_tembusan_surat',$where_tembusan);

			foreach ($this->input->post('tembusan_nota_dinas') as $key) 
			{
				$data_tembusan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'tembusan' => $key,
				);
				$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
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
		redirect('Compose');
	}

	public function surat()
	{	
		$role = $this->session->userdata('role');

		if($role=='1'){
			$data['si'] = $this->M_surat->surat_internal()->result();
		}else{
				// $a = $this->session->userdata('id_pegawai');
				// $b = $this->session->userdata('jabatan');
				// $user = $this->session->userdata('id_user');
				// //$c = $this->session->userdata('bagian_unit_kerja');
				// //$d = $this->session->userdata('unit_kerja');
				// $data['si'] = $this->M_all->surat_internal_user($a, $b, $user)->result();
		}
		
		$this->load->view('shared/header');
		$this->load->view('compose/surat', $data);
		$this->load->view('shared/footer');
	}

	public function surat_tambah()
	{
		$where_jenis = array('status_jenis_surat'=>1,'nama_jenis_surat'=>'Surat');
		$data['jenis'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();

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
		$this->load->view('compose/surat_tambah', $data);
		$this->load->view('shared/footer');
	}

	public function aksi_surat_tambah()
	{	
		$tembusan_surat = json_encode($this->input->post('tembusan_surat'));
		$jenis_tujuan_surat = $this->input->post('unit_tujuan');
		if($jenis_tujuan_surat==1){
			$ket_jenis_tujuan='Perorangan';
		}elseif($jenis_tujuan_surat==2){
			$ket_jenis_tujuan='Jabatan';
		}elseif($jenis_tujuan_surat==3){
			$ket_jenis_tujuan='Bagian Unit Kerja';
		}else{
			$ket_jenis_tujuan='Unit Kerja';
		}
		$data = array(
			'id_compose'=>2,
			'id_internal_eksternal'=>1,
			'ket_internal_eksternal'=>'Internal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat'=>$this->input->post('jenis_surat'),
			'tembusan_surat'=>$tembusan_surat,
			'sifat_surat' => $this->input->post('sifat_surat'),
			'tgl_surat' => $this->input->post('tanggal_surat'),
			'penandatangan' => $this->input->post('penandatangan_surat'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
			'ket_tujuan_surat'=>$ket_jenis_tujuan,
			'tujuan_surat_ke' => json_encode($this->input->post('tujuan_surat')),
			'lampiran_surat' => $this->input->post('lampiran_surat'),
			'isi_surat' => $this->input->post('isi_surat'),
			'no_surat' => $this->input->post('nomor_surat'),
			'status_surat' => 1,
			'created_by' => $this->session->userdata('id_user'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$query=$this->M_all->insert_data($data,'daftar_surat');

		$id = $this->db->insert_id();
		foreach ($this->input->post('tujuan_surat') as $key) 
		{
			$data_tujuan = array(
				'id_daftar_surat' => $id,
				'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
				'ket_jenis_tujuan'=>$ket_jenis_tujuan,
				'tujuan_surat' => $key,
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		}

		foreach ($this->input->post('tembusan_surat') as $key2) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id,
				'tembusan' => $key2,
			);
			$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}
		redirect('Compose/surat');
	}

	public function surat_detail($id_daftar_surat)
	{
		$where = array('id_daftar_surat'=>$id_daftar_surat);
        $data['si'] = $this->M_all->selectX('daftar_surat',$where)->row();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();
		
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		$this->load->view('shared/header');
		$this->load->view('compose/surat_detail', $data);
		$this->load->view('shared/footer');
	}

	public function surat_hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat',$where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat',$where3);
		redirect('Compose/surat');
	}

	public function surat_export($id)
	{ 
		$where = array('id_daftar_surat'=>$id);
        $si = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['si'] =  $si[0];

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$data['instansi'] = $this->M_all->selectSemua('instansi')->result();
		$data['nama_file'] = "Surat Internal - ".$si[0]->no_surat.".doc";
		if($data['instansi'][0]->kota_instansi != null)
        {
        	$kota = $data['instansi'][0]->kota_instansi;
        	$where_kota = array('id_kokab'=>$kota);
        	$kota = $this->M_all->selectX('entitas__kabupaten',$where_kota)->result();
        	$data['kota'] = $kota[0]->nama_kokab;
        }

		// print_r($data); die();

		$this->load->view('compose/surat_export',$data);
	}

	public function surat_ubah($id)
	{
		$where = array('id_daftar_surat'=>$id);
        $si = $this->M_all->selectX('daftar_surat',$where)->result();
        $data['si'] =  $si[0];

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
		$this->load->view('compose/surat_ubah', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment_surat()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/surat';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role.'si';
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

	public function aksi_surat_ubah()
	{
		$tembusan_surat = json_encode($this->input->post('tembusan_surat'));
		$jenis_tujuan_surat = $this->input->post('unit_tujuan');
		if($jenis_tujuan_surat==1){
			$ket_jenis_tujuan='Perorangan';
		}elseif($jenis_tujuan_surat==2){
			$ket_jenis_tujuan='Jabatan';
		}elseif($jenis_tujuan_surat==3){
			$ket_jenis_tujuan='Bagian Unit Kerja';
		}else{
			$ket_jenis_tujuan='Unit Kerja';
		}

		if($this->input->post('unit_tujuan') == 1)
		{
			$tujuan = json_encode($this->input->post('tujuan_surat_p'));
		}
		else if($this->input->post('unit_tujuan') == 2)
		{
			$tujuan = json_encode($this->input->post('tujuan_surat_j'));
		}
		else if($this->input->post('unit_tujuan') == 3)
		{
			$tujuan = json_encode($this->input->post('tujuan_surat_b'));
		}
		else if($this->input->post('unit_tujuan') == 4)
		{
			$tujuan = json_encode($this->input->post('tujuan_surat_u'));
		}

		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }

		if($this->input->post('jumlah_file') == 0)
		{
			$data = array(
				'sifat_surat' => $this->input->post('sifat_surat'),
				'tgl_surat' => $this->input->post('tanggal_surat'),
				'penandatangan' => $this->input->post('penandatangan_surat'),
				'klasifikasi_surat' => $this->input->post('klasifikasi_surat'),
				'perihal_surat' => $this->input->post('perihal_surat'),
				'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
				'ket_tujuan_surat' => $ket_jenis_tujuan,
				'tujuan_surat_ke' => $tujuan,
				'lampiran_surat' => $this->input->post('lampiran_surat'),
				'tembusan_surat'=>$tembusan_surat,
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
	            $this->upload_attachment_surat();
	            if(!$this->upload->do_upload('file_surat')){
	                echo $this->upload->display_errors();
	            }else{
	                $file_surat = $this->upload->data()['file_name'];
		                $data_file = array(
						'file_surat' => $file_surat,
					);
					$where1 = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
					$query_file=$this->M_all->update_data('daftar_surat',$data_file,$where1);
	            }
	        }

	        $where_tujuan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tujuan_surat',$where_tujuan);

	        foreach (json_decode($tujuan) as $key) 
			{
				$data_tujuan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
					'ket_jenis_tujuan'=>$ket_jenis_tujuan,
					'tujuan_surat' => $key,
				);
				$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
			}

			$where_tembusan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tembusan_surat',$where_tembusan);

	        foreach ($this->input->post('tembusan_surat') as $key2) 
			{
				$data_tembusan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'tembusan' => $key2,
				);
				$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
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
		redirect('Compose/surat');
	}

	public function surattugas()
	{	
		$data['data'] = $this->M_surat->surattugas()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/surattugas',$data);
		$this->load->view('shared/footer');
	}

	public function surattugas_tambah()
	{
		$where = array('status_jenis_surat'=>1, 'nama_jenis_surat'=>'Surat Tugas');
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where4 = array('status_jenis_tugas'=>1);
		$data['jenis_tugas'] = $this->M_all->selectX('master_jenis_tugas',$where4)->result();
		$where5 = array('status_moda'=>1);
		$data['moda'] = $this->M_all->selectX('master_moda_transport',$where5)->result();
		$data['wilayah']=$this->M_surat->wilayah()->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/surattugas_tambah', $data);
		$this->load->view('shared/footer');
	}

	public function surattugas_aksi(){
		$yang_diberi_tugas = json_encode($this->input->post('yang_diberi_tugas'));
		$tembusan_sti = json_encode($this->input->post('tembusan_sti'));
		$menimbang = json_encode($this->input->post('menimbang'));
		$dasar = json_encode($this->input->post('dasar'));
		$penandatangan_sti = $this->input->post('penandatangan_sti');
		$where=array('id_data_pegawai'=>$penandatangan_sti);
		$dt=$this->M_all->selectX('data_pegawai', $where)->row();
		$jabatan=$dt->jabatan;
		$data = array(
			'id_compose'=>3,
			'id_internal_eksternal'=>1,
			'ket_internal_eksternal'=>'Internal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat'=>$this->input->post('jenis_surat'),
			'no_surat' => $this->input->post('nomer_sti'),
			'tgl_surat' => $this->input->post('tanggal_sti'),
			'penandatangan' => $this->input->post('penandatangan_sti'),
			'jabatan_penandatangan' => $jabatan,
			'tembusan_surat' => $tembusan_sti,
			'klasifikasi_surat'=>$this->input->post('klasifikasi_sti'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
			'status_surat' => 1,
		); 
		$query=$this->M_all->insert_data($data,'daftar_surat');
		$id = $this->db->insert_id();

		$data_tugas = array(
			'id_daftar_surat'=>$id,
			'kata_pembuka_sti' => $menimbang,
			'dasar_sti' => $dasar,
			'tanggal_mulai_bertugas' => $this->input->post('tanggal_mulai_bertugas'),
			'tanggal_selesai_bertugas' => $this->input->post('tanggal_selesai_bertugas'),
			'tempat_tugas' => $this->input->post('tempat_tugas'),
			'tujuan_tugas' => $this->input->post('tujuan_tugas'),
			'maksud_tugas' => $this->input->post('maksud_tugas'),
			'yang_diberi_tugas' => $yang_diberi_tugas,
			'jenis_tugas' => $this->input->post('jenis_tugas'),
			'mode_transportasi' => $this->input->post('mode_transportasi'),
			'sumber_biaya' => $this->input->post('sumber_biaya'),
			'klasifikasi_sti' => $this->input->post('klasifikasi_sti'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
			'status_tugas' => 1,
		); 
		$query2=$this->M_all->insert_data($data_tugas,'daftar_surat_tugas');
			
		foreach ($this->input->post('yang_diberi_tugas') as $key) 
		{
		 	$data_tujuan = array(
		 		'id_daftar_surat' => $id,
		 		'jenis_tujuan_surat' => 1,
		 		'ket_jenis_tujuan' => 'Perorangan',
		 		'tujuan_surat' => $key,
			);
		 	$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		 }

		foreach ($this->input->post('tembusan_sti') as $key) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id,
				'tembusan' => $key,
			);
			$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}

		foreach ($this->input->post('menimbang') as $key3) 
		{
			$data_menimbang = array(
				'id_daftar_surat' => $id,
				'ket_menimbang' => $key3,
				'created_date' => date('Y-m-d H:i:s')
			);
			$query_menimbang=$this->M_all->insert_data($data_menimbang,'data_menimbang');
		}

		foreach ($this->input->post('dasar') as $key4) 
		{
			$data_dasar = array(
				'id_daftar_surat' => $id,
				'ket_dasar' => $key4,
				'created_date' => date('Y-m-d H:i:s')
			);
			$query_dasar=$this->M_all->insert_data($data_dasar,'data_dasar');
		}
		redirect('Compose/surattugas');
	}

	public function surattugas_print($id_daftar_surat)
  	{
	    header ("Content-type: text/html; charset=utf-8");
	    $this->load->library('word');
	    
	    
	    $PHPWord = new PHPWord();
	    $document = $PHPWord->loadTemplate('assets/template/surat_tugas.docx');
	    
	    $postdata['id_daftar_surat'] = $id_daftar_surat;
	     
	    $query = $this->M_surat->data_sti_print($postdata)->row();

	    $pecah = $query->tanggal_mulai_bertugas;
        $pecah2 = $query->tanggal_selesai_bertugas;
        $number = range($pecah,$pecah2);
        $ib = count($number);
	       
	    $document->setValue('{nomer_sti}', $query->no_surat);
	    $document->setValue('{tanggal_sti}', $query->tgl_surat);
	    $document->setValue('{nama_jabatan}', $query->nama_jabatan);
	    $document->setValue('{nama_pegawai}', $query->nama_pegawai);
	    $document->setValue('{maksud_tugas}', $query->maksud_tugas);
	    $document->setValue('{tanggal_mulai}', $query->tanggal_mulai_bertugas);
	    $document->setValue('{tanggal_selesai}', $query->tanggal_selesai_bertugas);
	    $document->setValue('{tempat_tugas}', $query->tempat_tugas);
	    $document->setValue('{nama_kokab}', $query->nama_kokab);
	    $document->setValue('{lama}', $ib);

	   
	    $menimbang = json_decode($query->kata_pembuka_sti);
	    $nomer = 'a';
	    foreach ($menimbang as $key) {
	        $id_daftar_surat = $query->id_daftar_surat;
	        $key;
	        $where=array('id_daftar_surat'=>$id_daftar_surat,'ket_menimbang'=>$key);
	        $query_menimbang=$this->M_all->selectX('data_menimbang', $where)->result();
	        
	        foreach ($query_menimbang as $q1) {
	            $ket_menimbang2[] = $q1->ket_menimbang;
	            $nomer2[] = $nomer++;
	        }
	    }

	    $dasar = json_decode($query->dasar_sti);
	    $nomer_dasar = 'a';
	    foreach ($dasar as $key2) {
	        $id_daftar_surat = $query->id_daftar_surat;
	        $key2;
	        $where2=array('id_daftar_surat'=>$id_daftar_surat,'ket_dasar'=>$key2);
	        $query_dasar=$this->M_all->selectX('data_dasar', $where2)->result();
	        
	        foreach ($query_dasar as $q2) {
	            $ket_dasar2[] = $q2->ket_dasar;
	            $nomer_dasar2[] = $nomer_dasar++;
	        }
	    }

	    $kepada = json_decode($query->yang_diberi_tugas);
	    $nomer_kepada = '1';
	    foreach ($kepada as $key3) {
	        $key3;
	        $where3=array('id_data_pegawai'=>$key3);
	        $query_kepada=$this->M_all->selectX('data_pegawai', $where3)->result();
	        
	        foreach ($query_kepada as $q3) {
	            $nama_pegawai1[] = $q3->nama_pegawai;
	            $nama_jabatan1[] = $q3->nama_jabatan;
	            $nomer_kepada1[] = $nomer_kepada++;
	        }
	    }

	    $data1 = array(
	        'no' => $nomer2,
	        'ket_menimbang3' => $ket_menimbang2,
	    );
	     
	    $data2 = array(
	        'no_d' => $nomer_dasar2,
	        'ket_dasar3' => $ket_dasar2,
	    );

	    $data3 = array(
	        'nomer_kep' => $nomer_kepada1,
	        'nama_jabatan_kpd' => $nama_jabatan1,
	        'nama_pegawai_kpd' => $nama_pegawai1,
	    );

	    // clone rows 
	    $document->cloneRow('TBL1', $data1);
	    $document->cloneRow('TBL2', $data2);
	    $document->cloneRow('TBL3', $data3);
	    $tmp_file = 'Surat_Tugas.docx';
	    $document->save('./file_export/'.$tmp_file);

	    // $filePath = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? $file_docx : $file_pdf ;

	    set_time_limit(0);
	    header('Connection: Keep-Alive');
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($tmp_file).'"');
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize('./file_export/'.$tmp_file));
	    ob_clean();
	    flush();
	    readfile('./file_export/'.$tmp_file);
  	}

  	public function surattugas_detail($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->surattugas_detail($id_daftar_surat)->row();
	    $data['ttd'] = $this->M_surat->pegawai_jab()->result();
	    $id_instansi = $this->session->userdata('id_instansi');
	    $where=array('id'=>$id_instansi);
	    $data['instansi'] = $this->M_all->selectX('instansi', $where)->row();
		$this->load->view('shared/header');
		$this->load->view('compose/surattugas_detail',$data);
		$this->load->view('shared/footer');
	}

	public function surattugas_hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat_tugas',$where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat',$where3);
		$where4 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat',$where4);
		$where5 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('data_dasar',$where5);
		$where6 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('data_menimbang',$where6);
		redirect('Compose/surattugas');
	}

	public function surattugas_edit($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->surattugas_detail($id_daftar_surat)->row();
		$where = array('status_jenis_surat'=>1);
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where4 = array('status_jenis_tugas'=>1);
		$data['jenis_tugas'] = $this->M_all->selectX('master_jenis_tugas',$where4)->result();
		$where5 = array('status_moda'=>1);
		$data['moda'] = $this->M_all->selectX('master_moda_transport',$where5)->result();
		$data['wilayah']=$this->M_surat->wilayah()->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		
	    $data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/surattugas_edit',$data);
		$this->load->view('shared/footer');
	}

	public function tambah_menimbang(){
  	 	$id_daftar_surat = $_POST['id'];
      	$data['data'] = $this->M_surat->modal_menimbang($id_daftar_surat)->row();
        $this->load->view('compose/tambah_menimbang',$data); 
    }

    public function tambah_menimbang_aksi()
    {
    	$id_daftar_surat = $this->input->post('id_daftar_surat');
    	$data=array(
    		'ket_menimbang'=>$this->input->post('ket_menimbang'),
    		'id_daftar_surat'=>$this->input->post('id_daftar_surat'),
    		'created_date'=>date('Y-m-d h:i:s'),
    	);
    	$this->M_all->insert_data($data, 'data_menimbang');
    	redirect('Compose/surattugas_edit/'.$id_daftar_surat);
    }

    public  function simpan_menimbang()
    {
    	$data=array(
    		'ket_menimbang'=>$this->input->post('ket_menimbang'),
    		'id_menimbang'=>$this->input->post('id'),
    		'created_date'=>date('Y-m-d h:i:s'),
    	);
    	$where=array('id_menimbang'=>$this->input->post('id'));
    	$query=$this->M_all->update_data('data_menimbang',$data,$where);
    }

    public function menimbang_hapus($id_menimbang)
	{
		$where1 = array('id_menimbang' => $id);
		$this->M_all->delete_data($where1,'surat_tugas_internal');
		
		redirect('Compose/surattugas_edit/');
	}

	public function tambah_dasar(){
  	 	$id_daftar_surat = $_POST['id'];
      	$data['data'] = $this->M_surat->modal_dasar($id_daftar_surat)->row();
        $this->load->view('compose/tambah_dasar',$data); 
    }

    public function tambah_dasar_aksi()
    {
    	$id_daftar_surat = $this->input->post('id_daftar_surat');
    	$data=array(
    		'ket_dasar'=>$this->input->post('ket_dasar'),
    		'id_daftar_surat'=>$this->input->post('id_daftar_surat'),
    		'created_date'=>date('Y-m-d h:i:s'),
    	);
    	$this->M_all->insert_data($data, 'data_dasar');
    	redirect('Compose/surattugas_edit/'.$id_daftar_surat);
    }

    public  function simpan_dasar()
    {
    	$data=array(
    		'ket_dasar'=>$this->input->post('ket_dasar'),
    		'id_dasar'=>$this->input->post('id'),
    		'created_date'=>date('Y-m-d h:i:s'),
    	);
    	$where=array('id_dasar'=>$this->input->post('id'));
    	$query=$this->M_all->update_data('data_dasar',$data,$where);
    }

    public function upload_attachment_surattugas()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/surat_tugas';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role.'_sti';
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

    public function surattugas_aksiedit()
	{	
		$id_daftar_surat = $this->input->post('id_daftar_surat');
		$ket_menimbang = json_encode($this->input->post('ket_menimbang'));
		$ket_dasar = json_encode($this->input->post('ket_dasar'));

		$yang_diberi_tugas = json_encode($this->input->post('yang_diberi_tugas'));
		$tembusan_sti = json_encode($this->input->post('tembusan_sti'));
		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }
		// echo $status; die();
		if($this->input->post('jumlah_file') == 0 || $this->input->post('jumlah_file')=='')
		{
			$penandatangan_sti = $this->input->post('penandatangan_sti');
			$where=array('id_data_pegawai'=>$penandatangan_sti);
			$dt=$this->M_all->selectX('data_pegawai', $where)->row();
			$jabatan=$dt->jabatan;
			$data = array(
				'no_surat' => $this->input->post('nomer_sti'),
				'tgl_surat' => $this->input->post('tanggal_sti'),
				'penandatangan' => $this->input->post('penandatangan_sti'),
				'jabatan_penandatangan' => $jabatan,
				'tembusan_surat' => $tembusan_sti,
				'klasifikasi_surat'=>$this->input->post('klasifikasi_sti'),
				'updated_date' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_user'),
				'status_surat' => $status,
			); 
			$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query=$this->M_all->update_data('daftar_surat',$data,$where);

			$data_tugas = array(
				'kata_pembuka_sti' => $ket_menimbang,
				'dasar_sti' => $ket_dasar,
				'tanggal_mulai_bertugas' => $this->input->post('tanggal_mulai_bertugas'),
				'tanggal_selesai_bertugas' => $this->input->post('tanggal_selesai_bertugas'),
				'tempat_tugas' => $this->input->post('tempat_tugas'),
				'tujuan_tugas' => $this->input->post('tujuan_tugas'),
				'maksud_tugas' => $this->input->post('maksud_tugas'),
				'yang_diberi_tugas' => $yang_diberi_tugas,
				'jenis_tugas' => $this->input->post('jenis_tugas'),
				'mode_transportasi' => $this->input->post('mode_transportasi'),
				'sumber_biaya' => $this->input->post('sumber_biaya'),
				'klasifikasi_sti' => $this->input->post('klasifikasi_sti'),
				'updated_date' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_user'),
				'status_tugas' => $status,
			); 
			$where1 = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query1=$this->M_all->update_data('daftar_surat_tugas',$data_tugas,$where1);

			$file_surat = $_FILES['file_surat']['name'];
	        if(isset($_FILES['file_surat']['name'])){
	            $this->upload_attachment_surattugas();
	            if(!$this->upload->do_upload('file_surat')){
	                echo $this->upload->display_errors();
	            }else{
	                $file_surat = $this->upload->data()['file_name'];
		                $data_file = array(
						'file_surat' => $file_surat,
					);
					$where2 = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
					$query_file=$this->M_all->update_data('daftar_surat',$data_file,$where2);
	            }
	        }

	        $where_tujuan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tujuan_surat',$where_tujuan);

	        foreach (json_decode($yang_diberi_tugas) as $key) 
			{
				$data_tujuan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'jenis_tujuan_surat' => 1,
		 			'ket_jenis_tujuan' => 'Perorangan',
					'tujuan_surat' => $key,
				);
				$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
			}

			$where_tembusan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tembusan_surat',$where_tembusan);

			foreach ($this->input->post('tembusan_sti') as $key) 
			{
				$data_tembusan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'tembusan' => $key,
				);
				$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
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
		redirect('Compose/surattugas');
	}

	public function undangan()
	{	
				
		$role=$this->session->userdata('role');
		if($role=='1'){
			$data['data'] = $this->M_surat->undangan()->result();
		}else{
			// $id_data_pegawai=$this->session->userdata('id_pegawai');
			// $jabatan=$this->session->userdata('jabatan');
			// $id_bagian_unit=$this->session->userdata('bagian_unit_kerja');
			// $id_unit_kerja=$this->session->userdata('unit_kerja');
			// $user=$this->session->userdata('id_user');
			// $data['data'] = $this->M_all->undangan_user($id_data_pegawai, $jabatan, $id_bagian_unit, $id_unit_kerja, $user)->result();
			// print_r($data['notadinas']);
			// die();
		}

		$this->load->view('shared/header');
		$this->load->view('compose/undangan',$data);
		$this->load->view('shared/footer');
	}

	public function undangan_tambah()
	{
		$where = array('status_jenis_surat'=>1,'nama_jenis_surat'=>'Undangan');
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where4 = array('status_jenis_tugas'=>1);
		$data['jenis_tugas'] = $this->M_all->selectX('master_jenis_tugas',$where4)->result();
		$where5 = array('status_moda'=>1);
		$data['moda'] = $this->M_all->selectX('master_moda_transport',$where5)->result();
		$data['wilayah']=$this->M_surat->wilayah()->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/undangan_tambah', $data);
		$this->load->view('shared/footer');
	}

	public function undangan_aksi(){
		$tujuan_undangan = json_encode($this->input->post('tujuan_undangan'));
		$tembusan_undangan = json_encode($this->input->post('tembusan_undangan'));
		$jenis_tujuan_surat = $this->input->post('unit_tujuan');
		if($jenis_tujuan_surat==1){
			$ket_jenis_tujuan='Perorangan';
		}elseif($jenis_tujuan_surat==2){
			$ket_jenis_tujuan='Jabatan';
		}elseif($jenis_tujuan_surat==3){
			$ket_jenis_tujuan='Bagian Unit Kerja';
		}else{
			$ket_jenis_tujuan='Unit Kerja';
		}

		$data = array(
			'id_compose'=>4,
			'id_internal_eksternal'=>1,
			'ket_internal_eksternal'=>'Internal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat'=>$this->input->post('jenis_surat'),
			'no_surat' => $this->input->post('nomor_undangan'),
			'penandatangan' => $this->input->post('penandatangan_undangan'),
			'perihal_surat' => $this->input->post('perihal_undangan'),
			'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
			'ket_tujuan_surat'=>$ket_jenis_tujuan,
			'tujuan_surat_ke' => $tujuan_undangan,
			'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_undangan'),
			'tembusan_surat' => $tembusan_undangan,
			'isi_surat' => $this->input->post('isi_undangan'),
			'klasifikasi_surat' => $this->input->post('klasifikasi_undangan'),
			'tgl_surat' => $this->input->post('tanggal_undangan'),
			'sifat_surat' => $this->input->post('sifat_undangan'),
			'lampiran_surat' => $this->input->post('lampiran_undangan'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
			'status_surat' => 1,
		); 
		$query=$this->M_all->insert_data($data,'daftar_surat');
		$id = $this->db->insert_id();

		$data_tugas = array(
			'id_daftar_surat'=>$id,
			'tanggal_dimulai_acara' => $this->input->post('tanggal_dimulai_acara'),
			'tanggal_selesai_acara' => $this->input->post('tanggal_selesai_acara'),
			'jam_dimulai_acara' => $this->input->post('jam_dimulai_acara'),
			'jam_selesai_acara' => $this->input->post('jam_selesai_acara'),
			'lokasi_acara' => $this->input->post('lokasi_acara'),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user'),
		); 
		$query2=$this->M_all->insert_data($data_tugas,'daftar_surat_undangan');

		foreach ($this->input->post('tujuan_undangan') as $key) 
		{
			$data_tujuan = array(
				'id_daftar_surat' => $id,
				'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
				'ket_jenis_tujuan'=>$ket_jenis_tujuan,
				'tujuan_surat' => $key,
			);
			$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
		}

		foreach ($this->input->post('tembusan_undangan') as $key) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id,
				'tembusan' => $key,
			);
			$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}
		redirect('Compose/undangan');
	}

	public function undangan_detail($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();
	    $data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$this->load->view('shared/header');
		$this->load->view('compose/undangan_detail',$data);
		$this->load->view('shared/footer');
	}

	public function undangan_hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat_undangan',$where2);
		$where3 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tujuan_surat',$where3);
		$where4 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat',$where4);
		redirect('Compose/undangan');
	}

	public function export_undangan($id_daftar_surat)
	{
		$data['data'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();
		$data['peg_jab'] = $this->M_surat->pegawai_jab()->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		$data['instansi'] = $this->M_all->selectSemua('instansi')->result();
		$data['nama_file'] = "Undangan Internal - ".$data['data']->no_surat.".doc";
		if($data['instansi'][0]->kota_instansi != null)
        {
        	$kota = $data['instansi'][0]->kota_instansi;
        	$where_kota = array('id_kokab'=>$kota);
        	$kota = $this->M_all->selectX('entitas__kabupaten',$where_kota)->result();
        	$data['kota'] = $kota[0]->nama_kokab;
        }
		$this->load->view('compose/undangan_export',$data);
	}

	public function undangan_edit($id_daftar_surat)
	{	
		$data['data'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();
		$where = array('status_jenis_surat'=>1);
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat',$where)->result();
		$where2 = array('status_klasifikasi'=>1);
		$data['klasifikasi_surat'] = $this->M_all->selectX('master_klasifikasi',$where2)->result();
		$where3 = array('status_sifat_surat'=>1);
		$data['sifat_surat'] = $this->M_all->selectX('master_sifat_surat',$where3)->result();
		$where4 = array('status_jenis_tugas'=>1);
		$data['jenis_tugas'] = $this->M_all->selectX('master_jenis_tugas',$where4)->result();
		$where5 = array('status_moda'=>1);
		$data['moda'] = $this->M_all->selectX('master_moda_transport',$where5)->result();
		$data['wilayah']=$this->M_surat->wilayah()->result();
		$data['pegawai_jabatan']=$this->M_surat->pegawaijabatan()->result();
		$data['tembusan']=$this->M_surat->tembusan()->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		
		$this->load->view('shared/header');
		$this->load->view('compose/undangan_edit',$data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment_undangan()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/undangan';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role.'_ui';
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

    public function undangan_aksiedit()
	{	
		if($this->input->post('unit_tujuan') ==  1)
		{
			$tujuan_undangan = json_encode($this->input->post('tujuan_undangan_p'));
		}
		else if($this->input->post('unit_tujuan') ==  2)
		{
			$tujuan_undangan = json_encode($this->input->post('tujuan_undangan_j'));
		}
		else if($this->input->post('unit_tujuan') ==  3)
		{
			$tujuan_undangan = json_encode($this->input->post('tujuan_undangan_bu'));
		}
		else if($this->input->post('unit_tujuan') ==  4)
		{
			$tujuan_undangan = json_encode($this->input->post('tujuan_undangan_u'));
		}
				
		$tembusan_undangan = json_encode($this->input->post('tembusan_undangan'));
		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }
		// echo $status; die();
		if($this->input->post('jumlah_file') == 0 || $this->input->post('jumlah_file') == '')
		{
			$jenis_tujuan_surat = $this->input->post('unit_tujuan');
			if($jenis_tujuan_surat==1){
				$ket_jenis_tujuan='Perorangan';
			}elseif($jenis_tujuan_surat==2){
				$ket_jenis_tujuan='Jabatan';
			}elseif($jenis_tujuan_surat==3){
				$ket_jenis_tujuan='Bagian Unit Kerja';
			}else{
				$ket_jenis_tujuan='Unit Kerja';
			}

			$data = array(
				'no_surat' => $this->input->post('nomor_undangan'),
				'penandatangan' => $this->input->post('penandatangan_undangan'),
				'perihal_surat' => $this->input->post('perihal_undangan'),
				'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
				'ket_tujuan_surat'=>$ket_jenis_tujuan,
				'tujuan_surat_ke' => $tujuan_undangan,
				'alamat_tujuan_surat' => $this->input->post('alamat_tujuan_undangan'),
				'tembusan_surat' => $tembusan_undangan,
				'isi_surat' => $this->input->post('isi_undangan'),
				'klasifikasi_surat' => $this->input->post('klasifikasi_undangan'),
				'tgl_surat' => $this->input->post('tanggal_undangan'),
				'sifat_surat' => $this->input->post('sifat_undangan'),
				'lampiran_surat' => $this->input->post('lampiran_undangan'),
				'updated_date' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_user'),
				'status_surat' => $status,
			); 
			$where = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query=$this->M_all->update_data('daftar_surat',$data,$where);

			$data_tugas = array(
				'tanggal_dimulai_acara' => $this->input->post('tanggal_dimulai_acara'),
				'tanggal_selesai_acara' => $this->input->post('tanggal_selesai_acara'),
				'jam_dimulai_acara' => $this->input->post('jam_dimulai_acara'),
				'jam_selesai_acara' => $this->input->post('jam_selesai_acara'),
				'lokasi_acara' => $this->input->post('lokasi_acara'),
				'updated_date' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_user'),
			); 
			$where2 = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
			$query2=$this->M_all->update_data('daftar_surat_undangan',$data_tugas,$where2);

			$file_surat = $_FILES['file_surat']['name'];
	        if(isset($_FILES['file_surat']['name'])){
	            $this->upload_attachment_undangan();
	            if(!$this->upload->do_upload('file_surat')){
	                echo $this->upload->display_errors();
	            }else{
	                $file_surat = $this->upload->data()['file_name'];
		                $data_file = array(
						'file_surat' => $file_surat,
					);
					$where3 = array('id_daftar_surat'=>$this->input->post('id_daftar_surat'));
					$query_file=$this->M_all->update_data('daftar_surat',$data_file, $where3);
	            }
	        }

	        $where_tujuan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tujuan_surat',$where_tujuan);

	        foreach (json_decode($tujuan_undangan) as $key) 
			{
				$data_tujuan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'jenis_tujuan_surat' => $this->input->post('unit_tujuan'),
					'ket_jenis_tujuan'=>$ket_jenis_tujuan,
					'tujuan_surat' => $key,
				);
				$query_tujuan=$this->M_all->insert_data($data_tujuan,'daftar_tujuan_surat');
			}

			$where_tujuan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tembusan_surat',$where_tujuan);

			foreach ($this->input->post('tembusan_undangan') as $key) 
			{
				$data_tembusan = array(
					'id_daftar_surat' => $this->input->post('id_daftar_surat'),
					'tembusan' => $key,
				);
				$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
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
		redirect('Compose/undangan');
	} 





}

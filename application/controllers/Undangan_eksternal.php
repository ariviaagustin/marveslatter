<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class undangan_eksternal extends CI_Controller {
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
		if($role==1){
			$data['ue'] = $this->M_surat->data_undangan_eks_co()->result();
		}else{
			
		}
		
		$this->load->view('shared/header');
		$this->load->view('undangan_eksternal/index', $data);
		$this->load->view('shared/footer');
	}

	public function tambah()
	{
		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();
		$where_jenis = array('status_jenis_surat'=>1,'nama_jenis_surat'=>'Undangan');
		$data['jenis_surat'] = $this->M_all->selectX('jenis_surat', $where_jenis)->result();
		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		
		$this->load->view('shared/header');
		$this->load->view('undangan_eksternal/tambah', $data);
		$this->load->view('shared/footer');
	}

	public function upload_attachment()
    {
        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $config['upload_path']   = './uploads/undangan';
        $config['file_name']     = rand(10000,99999).'_'.$username.'_'.$role."_undangan_co";
        $config['overwrite']     = true;
        $config['allowed_types']     = '*';
        $this->upload->initialize($config);
    }

    public function aksi_tambah()
	{
		$tembusan_undangan=json_encode($this->input->post('tembusan_undangan'));
		$data = array(
			'id_compose'=>6,
			'id_internal_eksternal'=>2,
			'ket_internal_eksternal'=>'Eksternal',
			'id_surat_masuk_keluar'=>1,
			'ket_masuk_keluar'=>'Surat Keluar',
			'jenis_surat'=>$this->input->post('jenis_surat'),
			'no_surat' => $this->input->post('nomor_undangan'),
			'penandatangan' => $this->input->post('penandatangan_undangan'),
			'perihal_surat' => $this->input->post('perihal_undangan'),
			'tujuan_surat_ke' => $this->input->post('tujuan_undangan'),
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

		foreach ($this->input->post('tembusan_undangan') as $key) 
		{
			$data_tembusan = array(
				'id_daftar_surat' => $id,
				'tembusan' => $key,
			);
			$query_tembusan=$this->M_all->insert_data($data_tembusan,'daftar_tembusan_surat');
		}
		redirect('Undangan_eksternal');
	}

	public function detail($id_daftar_surat)
	{
		$data['ue'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();
		$this->load->view('shared/header');
		$this->load->view('undangan_eksternal/detail', $data);
		$this->load->view('shared/footer');
	}

	public function hapus($id)
	{
		$where1 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat',$where1);
		$where2 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_surat_undangan',$where2);
		$where4 = array('id_daftar_surat' => $id);
		$this->M_all->delete_data('daftar_tembusan_surat',$where4);
		redirect('Undangan_eksternal');
	}

	public function export($id_daftar_surat)
	{
		$data['ue'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();
		$data['peg_jab'] = $this->M_surat->pegawai_jab()->result();
		$data['unit'] = $this->M_all->selectSemua('master_unit_kerja')->result();
		$data['ttd'] = $this->M_surat->pegawai_jab()->result();
		$data['jabatan'] = $this->M_surat->jab_bag_unit()->result();
		$data['bag_unit'] = $this->M_surat->unit_bag_unit()->result();

		$data['instansi'] = $this->M_all->selectSemua('instansi')->result();
		$data['nama_file'] = "Undangan Internal - ".$data['ue']->no_surat.".doc";
		if($data['instansi'][0]->kota_instansi != null)
        {
        	$kota = $data['instansi'][0]->kota_instansi;
        	$where_kota = array('id_kokab'=>$kota);
        	$kota = $this->M_all->selectX('entitas__kabupaten',$where_kota)->result();
        	$data['kota'] = $kota[0]->nama_kokab;
        }

		$this->load->view('undangan_eksternal/export',$data);
	}

	public function ubah($id_daftar_surat)
	{
		$data['ue'] = $this->M_surat->undangan_detail($id_daftar_surat)->row();

		$where_sifat = array('status_sifat_surat'=>1);
		$data['sifat'] = $this->M_all->selectX('master_sifat_surat', $where_sifat)->result();

		$where_klasifikasi = array('status_klasifikasi'=>1);
		$data['klasifikasi'] = $this->M_all->selectX('master_klasifikasi', $where_klasifikasi)->result();

		$data['ttd'] = $this->M_surat->pegawai_jab()->result();

		// print_r($data); die();
		$this->load->view('shared/header');
		$this->load->view('undangan_eksternal/ubah', $data);
		$this->load->view('shared/footer');
	}

	public function aksi_ubah()
	{
		if($this->input->post('draft')) { $status = 1; }
		if($this->input->post('sent')) { $status = 2; }
		// echo $status; die();
		if($this->input->post('jumlah_file') == 0 || $this->input->post('jumlah_file') == '')
		{
			$tembusan_undangan = json_encode($this->input->post('tembusan_undangan'));
			$data = array(
				'no_surat' => $this->input->post('nomor_undangan'),
				'penandatangan' => $this->input->post('penandatangan_undangan'),
				'perihal_surat' => $this->input->post('perihal_undangan'),
				'tujuan_surat_ke' => $this->input->post('tujuan_undangan'),
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

	        $where_tembusan = array('id_daftar_surat' => $this->input->post('id_daftar_surat'));
			$this->M_all->delete_data('daftar_tembusan_surat',$where_tembusan);

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
		redirect('Undangan_eksternal');
	}

	public function print_undangan($id_daftar_surat)
  	{
	    $query = $this->M_surat->undangan_detail($id_daftar_surat)->row();
	    $data_pegawai = $this->M_all->selectSemua('data_pegawai')->result();

	    if($query->tembusan_surat != "null")
	    {
		    $tembusan = json_decode($query->tembusan_surat);
		    $nomor = 1;
		    foreach ($tembusan as $key) 
		    {
		    	foreach ($data_pegawai as $data) 
		    	{
		    		if($data->id_data_pegawai == $key)
		    		{
		    			$temb[] = $nomor++.". ".$data->nama_jabatan." - ".$data->nama_pegawai;
		    		}
		    	}
		    }
		}
		else
		{
			$temb[] = " - ";
		}

	    $isi = strip_tags($query->isi_surat);

	    if($query->tanggal_selesai_acara != '0000-00-00') 
	    { 
	    	if($query->tanggal_dimulai_acara == $query->tanggal_selesai_acara)
		    { 
		    	$selesai = ''; 
		    }
		    else if($query->tanggal_dimulai_acara != $query->tanggal_selesai_acara)
		    {
		    	$selesai = "- ".$this->tanggal_indo($query->tanggal_selesai_acara); 
		    }
	    }
	    else if($query->tanggal_selesai_acara == '0000-00-00')
	    { 
	    	$selesai = '- Selesai'; 
	    }
	    $tanggal_acara = $this->tanggal_indo($query->tanggal_dimulai_acara, true)." ".$selesai;

	    if($query->jam_selesai_acara != '00:00:00'){ $waktu = "- ".date('H:i', strtotime($query->jam_selesai_acara))." WIB"; }
	    else if($query->jam_selesai_acara == '00:00:00'){ $waktu = "WIB"; }
	    $waktu_acara = date('H:i', strtotime($query->jam_dimulai_acara))." ".$waktu;


	    header ("Content-type: text/html; charset=utf-8");
	    $this->load->library('word');
	    
	    $PHPWord = new PHPWord();
	    $document = $PHPWord->loadTemplate('assets/template/undangan_eks.docx');

	    $document->setValue('{no_surat}', $query->no_surat);
	    $document->setValue('{sifat_surat}', $query->nama_sifat_surat);
	    $document->setValue('{lampiran}', $query->lampiran_surat);
	    $document->setValue('{perihal}', $query->perihal_surat);
	    $document->setValue('{jabatan_ttd}', $query->nama_jabatan);
	    $document->setValue('{nama_ttd}', $query->nama_pegawai);
	    $document->setValue('{isi_undangan}', html_special($isi));
	    $document->setValue('{tanggal_acara}', $tanggal_acara);
	    $document->setValue('{waktu_acara}', $waktu_acara);
	    $document->setValue('{lokasi_acara}', $query->lokasi_acara);
	    $document->setValue('{tujuan}', $query->tujuan_surat_ke);


    	$data2 = array(
	        'tembusan' => $temb
	    );
	    $document->cloneRow('TBL2', $data2);

	    $nomor_surat = $query->no_surat;
	    $no_surat = str_replace('/', '-', $nomor_surat );
	    $nama_file = 'Undangan-'.$no_surat.'.docx';
	    
	    $tmp_file = $nama_file;
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

  	public function tanggal_indo($tanggal, $cetak_hari = false)
	{
	  $hari = array ( 1 =>    'Senin',
	    'Selasa',
	    'Rabu',
	    'Kamis',
	    'Jumat',
	    'Sabtu',
	    'Minggu'
		);

		  $bulan = array (1 =>   'Januari',
		    'Februari',
		    'Maret',
		    'April',
		    'Mei',
		    'Juni',
		    'Juli',
		    'Agustus',
		    'September',
		    'Oktober',
		    'November',
		    'Desember'
		);
		  $split    = explode('-', $tanggal);
		  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

		  if ($cetak_hari) {
		    $num = date('N', strtotime($tanggal));
		    return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}


}

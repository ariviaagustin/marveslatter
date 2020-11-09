<?php
	public function suratinternal_print($id_daftar_surat)
  	{
	    $query = $this->M_surat->si_print($id_daftar_surat)->row();
	   	// print_r($query); die();
	    $data_pegawai = $this->M_all->selectSemua('data_pegawai')->result();
	    $jabatan = $this->M_all->selectSemua('master_jabatan')->result();
	    $bag_unit = $this->M_all->selectSemua('master_bag_unit_kerja')->result();
	    $unit_kerja = $this->M_all->selectSemua('master_unit_kerja')->result();

	    $jenis_tujuan = $query->jenis_tujuan_surat;
	    if($jenis_tujuan == 1)
	    {
	    	$tujuan = json_decode($query->tujuan_surat_ke);
	    	$no = 1;
	    	foreach ($tujuan as $key) 
	    	{
	    		foreach ($data_pegawai as $data) 
	    		{
	    			if($data->id_data_pegawai == $key)
	    			{
	    				$kepada[] = $no++.". ".$data->nama_pegawai;
	    			}
	    		}
	    	}
	    }
	    else if($jenis_tujuan == 2)
	    {
	    	$tujuan = json_decode($query->tujuan_surat_ke);
	    	$no = 1;
	    	foreach ($tujuan as $key) 
	    	{
	    		foreach ($jabatan as $data) 
	    		{
	    			if($data->id_jabatan == $key)
	    			{
	    				$kepada[] = $no++.". ".$data->nama_jabatan;
	    			}
	    		}
	    	}
	    }
	    else if($jenis_tujuan == 3)
	    {
	    	$tujuan = json_decode($query->tujuan_surat_ke);
	    	$no = 1;
	    	foreach ($tujuan as $key) 
	    	{
	    		foreach ($bag_unit as $data) 
	    		{
	    			if($data->id_bag_unit_kerja == $key)
	    			{
	    				$kepada[] = $no++.". ".$data->nama_bagian;
	    			}
	    		}
	    	}
	    }
	    else if($jenis_tujuan == 4)
	    {
	    	$tujuan = json_decode($query->tujuan_surat_ke);
	    	$no = 1;
	    	foreach ($tujuan as $key) 
	    	{
	    		foreach ($unit_kerja as $data) 
	    		{
	    			if($data->id_unit_kerja == $key)
	    			{
	    				$kepada[] = $no++.". ".$data->nama_unit_kerja;
	    			}
	    		}
	    	}
	    }

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
	    $isi = strip_tags($query->isi_surat);

	    header ("Content-type: text/html; charset=utf-8");
	    $this->load->library('word');
	    
	    $PHPWord = new PHPWord();
	    $document = $PHPWord->loadTemplate('assets/template/surat_internal.docx');

	    $document->setValue('{no_surat}', $query->no_surat);
	    $document->setValue('{sifat_surat}', $query->nama_sifat_surat);
	    $document->setValue('{lampiran}', $query->lampiran_surat);
	    $document->setValue('{perihal}', $query->perihal_surat);
	    $document->setValue('{jabatan_ttd}', $query->nama_jabatan);
	    $document->setValue('{nama_ttd}', $query->nama_pegawai);
	    $document->setValue('{isi_surat}', $isi);
		
	    $data1 = array(
	        'kepada' => $kepada
	    );
	    $document->cloneRow('TBL1', $data1);

	    $data2 = array(
	        'tembusan' => $temb
	    );
	    $document->cloneRow('TBL2', $data2);
	    

	    $nomor_surat = $query->no_surat;
	    $no_surat = str_replace('/', '-', $nomor_surat );
	    $nama_file = 'Surat_Internal-'.$no_surat.'.docx';
	    
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
?>
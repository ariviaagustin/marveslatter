<?php 
	function rupiah($data){
		return number_format($data, 0, ".", ".");
	}
	function html_special($data)
{
	return htmlspecialchars($data, ENT_COMPAT,'UTF-8');
}
 ?>
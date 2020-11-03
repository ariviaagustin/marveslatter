<?php
header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 2010 05:00:00 GMT");
header("content-disposition: attachment;filename=".$nama_file);
?>
<table width="100%" border="1" align="center">
  <tr>
    <td><h4><b><?= $instansi[0]->nama_instansi; ?></b></h4></td>
    <td><?= $instansi[0]->alamat_instansi; ?></td>
  </tr>
</table>
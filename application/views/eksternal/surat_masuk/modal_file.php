<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

<div class="col-lg-12">
		<div id="lightgallery" class="row lightGallery">

<?php 

$l=$lampiran->row();
$id=$l->file_surat;
$file = substr($id,-3);
$b=base_url('uploads/sem/'.$id); 

?>
		
		
		<?php if(($file == 'pdf' || $file == 'PDF'))
			{ ?>
				<embed src="<?php echo base_url('uploads/sem/'.$id);?>" type='application/pdf' width='100%' height='400px'/>
			<?php ;}
		elseif(($file == 'png' || $file == 'PNG'))
			{ ?>
				 <a href="<?php echo base_url('uploads/sem/'.$id);?>" class="image-tile" alt="image large">
				 	<img class="img-responsive" height="150px" src="<?php echo base_url('uploads/sem/'.$id);?>">
				 </a>
				
                   <?php ;}

			elseif(($file == 'jpg' || $file == 'peg' || $file == 'JPG' || $file == 'PEG'))
			{ ?>
				<img class="img-responsive" height="150px" src="<?php echo base_url('uploads/sem/'.$id);?>">
				
                   <?php ;}	
		else { ?>
			<p style="text-align: center;">Tidak Ada yang diLampirkan</p>
			<img class="img-responsive" height="400px" style="text-align: center;" src="<?php echo base_url('assets/img/no-image.png');?>">
		<?php }
?>
</div>
</div>
</body>
</html>


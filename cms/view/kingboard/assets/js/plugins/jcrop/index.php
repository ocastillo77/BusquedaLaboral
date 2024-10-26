<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$targ_w = 300;
	$targ_h = 200;
	$jpeg_quality = 90;

	$src = 'upload/pool.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	
	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Recortar Imagen ::</title>
<meta charset="utf-8" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
<script language="Javascript">
$(function(){	
	$('#cropbox').Jcrop({
    aspectRatio: 0,
    onSelect: updateCoords
  },function(){
    this.animateTo([0,0,500,300]);
  });
});

function updateCoords(c) {
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}
</script>
</head>
<body>
<div class="article">
	<img src="upload/pool.jpg" id="cropbox" />
	<form action="index.php" method="post">
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
		<input type="submit" value="Recortar Imagen" />
	</form>
</div>
</body>
</html>

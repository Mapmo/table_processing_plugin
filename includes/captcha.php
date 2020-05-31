<?php
	session_start();
	session_regenerate_id(true);
	header("Content-Type: image/png");
	header("Expires: 0");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, no-store, must-revalidate");

	//$rnd = base64_encode(openssl_random_pseudo_bytes(3));
	$allowed_letters = '23456789abdefghjkmnqrtuABDEFGHJKLMPQRTU!@#$%&?=';
	$rnd = "";
	for($i=0; $i<6; $i++){
		$rnd .= $allowed_letters[rand(0, strlen($allowed_letters)-1)];
	}
	
	$_SESSION['captcha'] = $rnd;
	
	// GD library required
	$image = imagecreatetruecolor(200, 60);
	$background = imagecolorallocate($image, rand(200,255), rand(200,255), rand(200,255));
	imagefilledrectangle($image, 0, 0, 200, 60, $background);
	
	$files = glob("./fonts/*.?tf");
	
	for($i=0; $i<strlen($rnd); $i++){
		$color = imagecolorallocate($image, rand(0,180), rand(0,180), rand(0,180));
		$font = realpath($files[array_rand($files)]);
		imagettftext($image, rand(18,26), rand(-20,20), 10+$i*rand(28,30), rand(30,50), $color, $font, $rnd[$i]);
	}
	
	imagepng($image);
?>	

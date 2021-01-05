<?php
//WATERMARK with Image
$watermark = imagecreatefrompng('watermark.png');
$imageURL = imagecreatefromjpeg('JPEG_Antra kapsul pien tze wuang yen tu jing_001.jpg');
$watermarkX = imagesx($watermark);
$watermarkY = imagesy($watermark);

// imagecopy($imageURL, $watermark, imagesx($imageURL)/5, imagesy($imageURL)/5, 0, 0, $watermarkX, $watermarkY);
imagecopymerge($imageURL, $watermark, imagesx($imageURL)/3-500, imagesy($imageURL)/3, 0, 0,  $watermarkX,  $watermarkY, 18);
header('Content-type: image/jpeg');
imagejpeg($imageURL, 'watermarked.jpg');
imagedestroy($imageURL);


//Watermark string
// $font = 5;
// $x=1130;
// $y=917;
// $imageURL = "mountain alps.jpg";
// list($width,$height) = getimagesize($imageURL);
// $imageProperties = imagecreatetruecolor($width, $height);
// $targetLayer = imagecreatefromjpeg($imageURL);
// // imagecopyresampled($imageProperties, $targetLayer, 0, 0,0, 0, $width, $height, $width, $height);
// imagecopyresampled($imageProperties, $targetLayer, 0, 0,0, 0, $width, $height, $width, $height);
// $WaterMarkText = 'CONFIDENTIAL';
// $watermarkColor = imagecolorallocate($imageProperties, 191,191,191);
// imagestring($imageProperties,$font,$x,$y, $WaterMarkText, $watermarkColor);
// header('Content-type: image/jpeg');
// imagepng ($imageProperties);
// imagedestroy($targetLayer);
// imagedestroy($imageProperties);



//pakai library percobaan blm bisa
// $norwayLayer = ImageWorkshop::initFromPath('/path/to/images/norway.jpg');
// $watermarkLayer = ImageWorkshop::initFromPath('/path/to/images/watermark.png');
// $norwayLayer->addLayer(1, $watermarkLayer, 12, 12, "LB");
// $image = $norwayLayer->getResult();

//test
// Load the stamp and the photo to apply the watermark to
// $im = imagecreatefromjpeg('JPEG_Antra kapsul pien tze wuang yen tu jing_001.jpg');

// // First we create our stamp image manually from GD
// $stamp = imagecreatetruecolor(100, 70);
// imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
// imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
// imagestring($stamp, 5, 10, 20, 'Ban Tjie Tong', 0x0000FF);
// imagestring($stamp, 3, 10, 40, '(c)2020', 0x0000FF);

// // Set the margins for the stamp and get the height/width of the stamp image
// $marge_right = 10;
// $marge_bottom = 10;
// $sx = imagesx($stamp);
// $sy = imagesy($stamp);

// // Merge the stamp onto our photo with an opacity of 50%
// imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

// // Save the image to file and free memory
// imagejpeg($im, 'watermark.jpg');
// imagedestroy($im);





?>
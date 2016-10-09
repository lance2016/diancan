
<?php
header("Content-Type:text/html;charset=utf-8");
$ver=$_POST['text'];
$dir=dirname(__FILE__);
include 'phpqrcode.php';  
product($ver,$dir);

function product($ver,$dir){

$value = $ver; //二维码内容   
$errorCorrectionLevel = 'L';//容错级别   
$matrixPointSize = 6;//生成图片大小   
//生成二维码图片   
QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);   
$QR = 'qrcode.png';//已经生成的原始二维码图 
  $QR = imagecreatefromstring(file_get_contents($QR)); 
  
imagepng($QR, 'test.jpg');   
echo '<center><img src="test.jpg"></center></br>'."<center><a href='doDownload.php?filename=test.jpg'>保存二维码</a></cenetr>";
}
?>
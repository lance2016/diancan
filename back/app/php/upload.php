<?php 
require_once "../../db.func.php";
$pdo=getConnection();
$upload_dir=getcwd()."\\../images\\";
if(!is_dir($upload_dir))
	mkdir($upload_dir);
function makefilename(){
	$curtime=getdate();
	
	if ($curtime['mon']<10)
		$curtime['mon']='0'.$curtime['mon'];
	if ($curtime['mday']<10)
		$curtime['mday']='0'.$curtime['mday'];
	if ($curtime['hours']<10)
		$curtime['hours']='0'.$curtime['hours'];
	if ($curtime['minutes']<10)
		$curtime['minutes']='0'.$curtime['minutes'];
	if ($curtime['seconds']<10)
		$curtime['seconds']='0'.$curtime['seconds'];
	$filename=$curtime['year']."-".$curtime['mon'].'-'.$curtime['mday'].'-'.$curtime['hours'].'-'.$curtime['minutes'].'-'.$curtime['seconds'].".jpg";
	return $filename;
}


$newfilename=makefilename();
$newfile=$upload_dir.$newfilename;
	if(file_exists($_FILES['upfile']['tmp_name'])){
		move_uploaded_file( $_FILES['upfile']['tmp_name'], $newfile);
		// echo '文件上传成功[<a href="#" onclick="history.go(-1)">返回</a>]
		// <p>下面是上传的文件</p>
		// <img src="../../images/'.$newfilename.'" width="180px" height="240px">';
	}
	else	
		echo "上传失败，错误类型".$_FILES['upfile']['error'];


	
	
	$c_name = $_POST['name'];
	$c_price = $_POST['price'];
	$c_jieshao = $_POST['introduce'];
	$img ='images/'.$newfilename;
	$a=$_POST['type'];
	 $arr=explode('_',$a);
	$c_type = $arr[1];
	$shunxu=$arr[2];

	
	
		
		$sql = "insert into caidan(c_name,c_price,c_jieshao,img,c_type,shunxu)  values ('".$c_name."',  ".$c_price.",  '".$c_jieshao."','".$img."',  ".$c_type.", ".$shunxu.")";
		
		$rw = $pdo->exec($sql);
		if($rw>0){
				echo ('<script>alert("增加成功"),history.go(-1);</script>');
		}else{

			echo ('<script>alert("增加失败，请重新上传"),history.go(-1);</script>');
			unlink('../../'.$src);
			

		} 	
			$pdo=null;

?>
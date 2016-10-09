<?php
session_start();


$code = trim($_GET['code']);

	if($code==$_SESSION["helloweba_num"]){
       echo '1';
    }


?>

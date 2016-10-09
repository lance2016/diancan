<?php
    //载入配置文件
    require_once 'common.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<title>易宝支付接口测试</title>
<style type="text/css">
body {
    margin:0;
	padding:0;
    font-size:12px;
    font-family:Arial;
    margin:0 auto;
}
ul {
    list-style-type:none;
}
body h1 {
    font-size:14px;
}
body form {
   
}
body form ul li {
    
}
body form ul li input.text {
    border:1px solid #ccc;
    width:220px;
    height:22px;
}
body form ul li input.submit {
   
    cursor:pointer;
}
</style>
</head>
<body>
<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
	<br>
	<span style="color:white;font-size:20px;"><b>支付页面</b></span>
</div>
<div style="height:80px"></div>
    <?php 
	$a=$_GET['a'];
	if(isset($_POST['send'])){
        $p0_Cmd='Buy';//业务类型，固定值是'Buy'
        $p1_MerId='10001126856';//商户编号
        $p2_Order=$_POST['p2_Order'];//商户订单号
        $p3_Amt=$_POST['p3_Amt'];//支付金额
        $p4_Cur='CNY';//交易币种，固定值是'CNY' 人民币
        $p5_Pid='';//商品名称
        $p6_Pcat='';//商品种类
        $p7_Pdesc='';//商品描述
        $p8_Url='http://localhost:8080/test/payback.php';//回调地址
        $p9_SAF='0';//送货地址
        $pa_MP='';//商品扩展信息
        $pd_FrpId=$_POST['pd_FrpId'];//各种银行的支付通道
        $pr_NeedResponse='1';//应答机制
        switch($pd_FrpId){
            case 'CMBCHINA-NET' :
                $bank='招商银行';
                break;
            case 'ICBC-NET' :
                $bank='工商银行';
                break;
            case 'ABC-NET' :
                $bank='农业银行';
                break;
            case 'CCB-NET' :
                $bank='建设银行';
                break;
        }
        $data=$data.$p0_Cmd;
        $data=$data.$p1_MerId;
        $data=$data.$p2_Order;
        $data=$data.$p3_Amt;
        $data=$data.$p4_Cur;
        $data=$data.$p5_Pid;
        $data=$data.$p6_Pcat;
        $data=$data.$p7_Pdesc;
        $data=$data.$p8_Url;
        $data=$data.$p9_SAF;
        $data=$data.$pa_MP;
        $data=$data.$pd_FrpId;
        $data=$data.$pr_NeedResponse;
        $key='69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl';//商户密钥
        $hmac=HmacMd5($data,$key);//mac签名用于验证
    ?>
    <h1>您的订单信息如下：</h1>
    <form action="https://www.yeepay.com/app-merchant-proxy/node" method="post">
        <input type="hidden" name="p0_Cmd" class="text" value="<?php echo $p0_Cmd;?>" />
        <input type="hidden" name="p1_MerId" class="text" value="<?php echo $p1_MerId;?>" />
        <input type="hidden" name="p2_Order" class="text" value="<?php echo $p2_Order;?>" />
        <input type="hidden" name="p3_Amt" class="text" value="<?php echo $p3_Amt;?>" />
        <input type="hidden" name="p4_Cur" class="text" value="<?php echo $p4_Cur;?>" />
        <input type="hidden" name="p5_Pid" class="text" value="<?php echo $p5_Pid;?>" />
        <input type="hidden" name="p6_Pcat" class="text" value="<?php echo $p6_Pcat;?>" />
        <input type="hidden" name="p7_Pdesc" class="text" value="<?php echo $p7_Pdesc;?>" />
        <input type="hidden" name="p8_Url" class="text" value="<?php echo $p8_Url;?>" />
        <input type="hidden" name="p9_SAF" class="text" value="<?php echo $p9_SAF;?>" />
        <input type="hidden" name="pa_MP" class="text" value="<?php echo $pa_MP;?>" />
        <input type="hidden" name="pd_FrpId" class="text" value="<?php echo $pd_FrpId;?>" />
        <input type="hidden" name="pr_NeedResponse" class="text" value="<?php echo $pr_NeedResponse;?>" />
        <input type="hidden" name="hmac" class="text" value="<?php echo $hmac;?>" />
        <ul>
            <li>您的　订单号：<input type="text" name="p2_Order" class="text" value="<?php echo $p2_Order;?>" /></li>
            <li>您支付的金额：<input type="text" name="p3_Amt" class="text" value="<?php echo $p3_Amt;?>" /> 元</li>
            <li>要支付的银行：<span><?php echo $bank;?></span></li>
            <li><input type="submit" name="send" value="确认支付" class="submit"/></li>
        </ul>
    </form>    
    <?php }else{ ?>
    <h1>欢迎来到易宝支付平台</h1>
    <form action="payment.php" method="post">
        <ul>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;您的订单号：<input type="text" name="p2_Order" class="text"  readonly= "true" style='color:gray' value="<?php echo $a;?>"/></li>
            <li>输入您的金额：<input type="text" name="p3_Amt" class="text"/> 元</li>
            <li>请选择要支付的银行：</li>
            <li>
                <input type="radio" name="pd_FrpId" value="CMBCHINA-NET"/> 招商银行　
                <input type="radio" name="pd_FrpId" value="ICBC-NET"/> 工商银行　
                <input type="radio" name="pd_FrpId" value="ABC-NET"/> 农业银行　
                <input type="radio" name="pd_FrpId" value="CCB-NET"/> 建设银行　
            </li>
            <li><input type="submit" name="send" value="确认支付" class="submit"/></li>
        </ul>
    </form>        
    <?php }?>
</body>
</html>
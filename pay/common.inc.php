<?php
    function HmacMd5($data,$key){
        $key=iconv('gb2312','utf-8',$key);
        $data=iconv('gb2312','utf-8',$data);
        $b=64;
        if(strlen($key)>$b){
            $key=pack('H*',md5($key));
        }
        $key=str_pad($key,$b,chr(0x00));
        $ipad=str_pad('',$b,chr(0x36));
        $opad=str_pad('',$b,chr(0x5c));
        $k_ipad=$key^$ipad;
        $k_opad=$key^$opad;
        return md5($k_opad.pack('H*',md5($k_ipad.$data)));
    }
?>
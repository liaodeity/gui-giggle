<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/5/30
 */

namespace App\Libs;

////将多个空格替换成一个空格
//$str = Units::empty_replace ('你好     我好大家好');
//var_dump ($str);
////将符号替换成空格
//$str = Units::symbol_replace ('你好*我好，大家好');
//var_dump ($str);
////关键字高亮内容
//$str = Units::highlight_Key ('你好我好大家好', '好');
//var_dump ($str);
////截取字符串文字
//$str = Units::utf8_cutchar ('你好我好大家好', 4);
//var_dump ($str);
////随机字符串
//$str = Units::randchar (8);
//var_dump ($str);
class Units
{

    public static function empty_replace($str,$repStr=' '){
        $str = str_replace('　', ' ', $str);
        $str = str_replace(' ', ' ', $str);
        $str = preg_replace("/[\s]+/is",' ',$str);
        $noe = false;
        for ($i=0 ; $i<strlen($str); $i++) {
            if($noe && $str[$i]==' ')
                $str[$i] = $repStr;
            elseif($str[$i]!=' ')
                $noe=true;
        }

        return $str;
    }


    public static function symbol_replace($text,$repStr=' '){
        if(trim($text)=='') return '';
        $text = preg_replace("/[[:punct:]\s]/",$repStr,$text);
        $text = urlencode($text);
        $text = preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",$repStr,$text);

        $text = urldecode($text);

        return self::empty_replace(trim($text));
    }




    //高亮关键字
    public static function highlight_Key($content,$key) {
        $content=trim($content);
        $key=trim($key);
        if( ord($key[1]) > 127 ){
            $kLength += 3;
        }else{
            $kLength += 1;
        }

        $k_fi=substr($key,0,$kLength);              //取得关键词第一个字符
        $k_len=strlen($key);                        //计算关键词字数
        $l_len=strlen($content);                    //计算备查字符串字数
        $i=0;$newlen=0;
        for($l_n=0;$l_n<$l_len;$l_n++){             //根据备查文章字数开始循环
            $strLength=0;

            if($i==3){
                $i=0;
            }
            //当检测到一个中文字符时
            if( ord($content[$l_n]) > 127 ){
                $strLength += 3;
                $width     += 2;               //大概按一个汉字宽度相当于两个英文字符的宽度

                if($i==0 && $l_n>2){
                    $newlen=$l_n;
                }
                $i++;
            }else{
                $strLength += 1;
                $width     += 1;
                $newlen=$l_n;
            }

            $l_s=substr($content,$newlen,$strLength);    //取得备查文章当前字符
            if(strtolower($l_s)==strtolower($k_fi)){
                $l_key=substr($content,$newlen,$k_len);

                if(strtolower($l_key)==strtolower($key)){
                    $con.="<span style=\"color:#f00;\">";
                    $con.=$l_key;
                    $con.="</span>";
                    $n_key=substr($content,0,$newlen);
                    $tn_key=substr($content,$newlen+$k_len);

                    break;
                }

            }

        }
        return $n_key.$con.$tn_key;
    }



    // UTF8截取字符
    public static function utf8_cutchar($string, $length = 80,$more=1 , $etc = '..'){
        $strcut = '';
        $strLength = 0;
        $width  = 0;
        if(strlen($string) > $length) {
            //将$length换算成实际UTF8格式编码下字符串的长度
            for($i = 0; $i < $length; $i++) {
                if ( $strLength >= strlen($string) ){
                    break;
                }
                if ( $width>=$length){
                    break;
                }
                //当检测到一个中文字符时
                if( ord($string[$strLength]) > 127 ){
                    $strLength += 3;
                    $width     += 2;              //大概按一个汉字宽度相当于两个英文字符的宽度
                }else{
                    $strLength += 1;
                    $width     += 1;
                }
            }
            return substr($string, 0, $strLength).$etc;
        } else {
            return $string;
        }
    }



    // 随机生成字符串
    public static function randchar($len=8,$format='ALL',$custr=''){
        $is_abc = $is_numer = 0;
        $password = $tmp ='';
        switch($format){
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                if($custr!=''){
                    $chars .= $custr;
                }
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                if($custr!=''){
                    $chars .= $custr;
                }
                break;
            case 'upper':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                if($custr!=''){
                    $chars .= $custr;
                }
                break;
            case 'lower':
                $chars='abcdefghijklmnopqrstuvwxyz';
                if($custr!=''){
                    $chars .= $custr;
                }
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            case 'SYMBOL':
                $chars = "abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*(){}:,.<>?";
                if($custr!=''){
                    $chars .= $custr;
                }
                break;
            case 'CUSTOM':
                if($custr!=''){
                    $chars = $custr;
                }else{
                    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                }
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }

        mt_srand(time ());

        while(strlen($password)<$len){
            $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
            if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
                $is_numer = 1;
            }
            if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
                $is_abc = 1;
            }
            $password.= $tmp;
        }
        if($is_numer <> 1 || $is_abc <> 1 || empty($password) ){
            $password = self::randchar($len,$format);
        }
        return $password;
    }
}

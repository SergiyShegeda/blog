<?php
class Blog_Action_Helper_UrlConverter extends Zend_Controller_Action_Helper_Abstract
{
    public function direct($url)
    {
        $transform = array("ä" => "ae", "Ä" => "AE", "ü" => "ue", "Ü" => "UE", "ö" => "oe", "Ö" => "OE", "ø" => "oe", "ß" => "ss", " " => "-", "." => "", "/" => "-", "---" => "-", "--" => "-", "é" => "e", "É" => "E", "&nbsp;" => "-", "&" => "und", "(" => "", ")" => "", "\'" => "", ":" => "",
        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t", "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya",
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K", "Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P", "Р"=>"R","С"=>"S","Т"=>"T","У"=>"Y","Ф"=>"F", "Х"=>"H","Ц"=>"C","Ч"=>"Ch","Ш"=>"Sh","Щ"=>"Sh", "Ы"=>"I","Э"=>"E","Ю"=>"U","Я"=>"Ya",
        "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"","®"=>"","©"=>"","™"=>"", "–"=>"-"
        );
        $transform2 = array("---" => "-", "--" => "-");
        $url_temp = strtr(trim($url), $transform);
        $url_complite = strtr($url_temp, $transform2);

        return strtolower($url_complite);
    }   
}

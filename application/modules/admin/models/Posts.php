<?php
class Admin_Model_Posts extends Zend_Db_Table
{
    protected $_name = "posts";

    public function getUrl($url)
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
    
    public function findAll()
    {       
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('posts'), array('*'))
                       ->join('categories', 'posts.category = categories.id',array('cat_title','cat_url'))
                       ->join('users', 'posts.user = users.id','username')
                       ->order('date DESC');

        return $this->fetchAll($select);   
    }
    
    public function getPostsById($id) 
    { 
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('posts'), array('*'))
                       ->join('categories', 'posts.category = categories.id',array('cat_url','cat_title'))
                       ->join('users', 'posts.user = users.id','username')    
                       ->where('category = ' . $id);
        
       return $this->fetchAll($select);
    }
    
    public function getPostById($id) 
    { 
        $row = $this->fetchRow('id = '.$id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        
        return $row->toArray();     
    }

    public function getPostByUrl($url) 
    { 
    $select = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('posts'), array('*'))
                    ->join('categories', 'posts.category = categories.id','cat_title')
                    ->join('users', 'posts.user = users.id','username')    
                    ->where('url = "' . $url . '"');
    if (!$select) {
        throw new Exception('Could not find row with url ' . $url);
    }
    
    return $this->fetchRow($select);
    }
    
    public function addPost($title, $full_text, $url, $is_active, $category, $user, $date)
    {
    if (!$url) {
        $url = $title;
    }
    $data = array('title'=> $title,
            'full_text' => $full_text,
            'url' =>  $this->getUrl($url),
            'is_active' => (bool)$is_active,
            'category' => $category,
            'user' => (int)$user,
            'date' => $date,
            ); 
    $this->insert($data);
    }

    public function deletePost($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function updatePost($id, $title, $full_text, $url, $is_active, $category, $date)
    {
        if (!$url) {
            $url = $title;
        }
        $data = array('id' => $id,
                'title'=> $title,
                'full_text' => $full_text,
                'url' => $this->getUrl($url),
                'is_active' => $is_active,
                'category' => $category,
                'date' => $date,
                );
        $this->update($data, 'id =' . (int)$id );
    }
}
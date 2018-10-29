<?php
require 'ProLang.php';
require 'util.php';
class Database
{

    function __contrsuct($filename){
            $this->filename = $filename;
    }

    public function getID()
    {
        $file=fopen($this->filename,'a+');

        $max_id = 0;

        if (!$file){
            echo "OPEN FILE ERROR";
        }else{
            while (!feof($file)){
                $text=fgets($file);
                $deli = ",,,";
                $pro_lang_array = explode($text, $deli);
                $max_id = max($max_id, $pro_lang_array[0]);
            }
        }

        fclose($file);

        return $max_id+1;
    }

    public function read(){
        $file=fopen($this->filename,'a+');
        $pro_lang_array= array();

        if (!$file){
            echo "OPEN FILE ERROR";
        }else{
            while (!feof($file)){
                $text=fgets($file);
                $deli = ",,,";
                $par = explode($text, $deli);
                $pro_lang_item=new ProLang($par[0],$par[1],$par[2],$par[3],$par[4],$par[5],$par[6]);
                array_push($pro_lang_array,$pro_lang_item);
            }
        }

        fclose($file);
        return $pro_lang_array;
    }

    public function add(ProLang $proLang){
        $file=fopen($this->filename,'a+');

        if (!$file){
            echo "OPEN FILE ERROR";
        }else{
            $text=$proLang->toText();
            fwrite($file,$text.chr(0x0A));
        }

        fclose($file);
    }

    public function delete($id){

    }
    
    public function update(ProLang $proLang){

    }
}
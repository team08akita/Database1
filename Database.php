<?php
require_once 'ProLang.php';
require_once 'util.php';

class Database
{
    public $filename;
    public $deli = "|";

    function __construct($file)
    {
        $this->filename = $file;
    }

    public function getID()
    {
        $file = fopen($this->filename, 'a+');

        $max_id = 0;

        if (!$file) {
            echo "OPEN FILE ERROR";
        } else {
            while (!feof($file)) {
                $text = fgets($file);
                $pro_lang_array = explode($this->deli, $text);
                $max_id = max($max_id, $pro_lang_array[0]);
            }
        }

        fclose($file);

        return $max_id + 1;
    }

    public function read()
    {
        $file = fopen($this->filename, 'a+');
        $pro_lang_array = array();

        if (!$file) {
            echo "OPEN FILE ERROR";
        } else {
            while (!feof($file)) {
                $text = fgets($file);
                $text = trim($text);
                $par = explode($this->deli, $text);
                if ($par[0] != "") {
                    $pro_lang_item = new ProLang($par[0], $par[1], $par[2], $par[3], $par[4], $par[5], $par[6]);
                    array_push($pro_lang_array, $pro_lang_item);
                }
            }
        }

        var_dump($pro_lang_array);

        fclose($file);
        return $pro_lang_array;
    }

    public function add(ProLang $proLang)
    {
        $file = fopen($this->filename, 'a+');

        if (!$file) {
            echo "OPEN FILE ERROR";
        } else {
            $text = $proLang->toText();
            fwrite($file, $text . chr(0x0A));
        }

        fclose($file);
    }

    public function addAll($proLangArray)
    {
        $file = fopen($this->filename, 'w');

        if (!$file) {
            echo "OPEN FILE ERROR";
        } else {
            for ($i = 0, $len = count($proLangArray); $i < $len; $i++) {
                $text = $proLangArray[$i]->toText();
                fwrite($file, $text . chr(0x0A));
            }
        }

        fclose($file);
    }

    public function delete($id)
    {
        $pro_lang_array = $this->read();
        $renew_pro_lang_array = array();

        for ($i = 0, $len = count($pro_lang_array); $i < $len; $i++) {
            if ($pro_lang_array[$i]->getId() != $id) {
                array_push($renew_pro_lang_array, $pro_lang_array[$i]);
            }
        }

        $this->addAll($renew_pro_lang_array);
    }

    public function update(ProLang $proLang)
    {
        
    }
}
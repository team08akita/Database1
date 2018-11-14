<?php
require_once 'ProLang.php';
require_once 'util.php';

class Database
{
    public $filename;
    public $deli = "|||||";
    public $deli_reg = "/\|\|\|\|\|/";

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
                $pro_lang_array = preg_split($this->deli_reg, $text);
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
                $par = preg_split($this->deli_reg, $text);
                if ($par[0] != "") {
                    $pro_lang_item = new ProLang($par[0], $par[1], $par[2], $par[3], $par[4], $par[5], str_replace("[[[[[", "aa", $par[6]));
                    array_push($pro_lang_array, $pro_lang_item);
                }
            }
        }

        fclose($file);
        return $pro_lang_array;
    }

    public function add(ProLang $proLang)
    {
        $file = fopen($this->filename, 'a+');
        $proLang->setId($this->getID());

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
        $pro_lang_array = $this->read();

        for ($i = 0, $len = count($pro_lang_array); $i < $len; $i++) {
            if ($pro_lang_array[$i]->getId() == $proLang->getId()) {
                $pro_lang_array[$i] = $proLang;
                continue;
            }
        }

        $this->addAll($pro_lang_array);
    }

    public function sort($type, $order)
    {
        $pro_lang_array = $this->read();

        usort($pro_lang_array, function ($proLang1, $proLang2) use ($type, $order) {
            $type = "get" . $type;
            if ($type === "Name" || $type === "Writer" || $type === "Extension" || $type == "Comment") {
                return $order * strcmp($proLang1->callComp($type), $proLang2->callComp($type));
            } else {
                return (int)($proLang1->callComp($type)) < (int)($proLang2->callComp($type)) ? $order : -$order;
            }
        });

        return $pro_lang_array;
    }

    public function search($types, $keyword)
    {
        $pro_lang_array = $this->read();
        $result = array();

        for ($i = 0, $len = count($pro_lang_array); $i < $len; $i++) {
            for ($j = 0, $lenType = count($types); $j < $lenType; $j++) {
                $type = "get" . $types[$j];
                $text = $pro_lang_array[$i]->callComp($type);

                if (strpos($text, $keyword) === false) continue;

                array_push($result, $pro_lang_array[$i]);
                break;
            }
        }
        return $result;
    }
}
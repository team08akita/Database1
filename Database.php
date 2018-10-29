<?php
/**
 * Created by PhpStorm.
 * User: s7016516
 * Date: 2018/10/29
 * Time: 12:37
 */

class Database
{
    public function read()
    {
        $file=fopen('data.txt','a+');

        if (!$file){
            echo "OPEN FILE ERROR";
        }else{
            while (!feof($file)){
                echo fgets($file);
            }
        }

        fclose($file);
    }

    public function add(){

    }

    public function update(){

    }

    public function write($text){
        $file=fopen('data.txt','a+');

        if (!$file){
            echo "OPEN FILE ERROR";
        }else{
            fwrite($file,$text.chr(0x0A));
        }

        fclose($file);
    }
}
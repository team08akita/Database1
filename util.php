<?php

function es($string) {
    if (is_array($string)) {
        return array_map("myhtmlspecialchars", $string);
    } else {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

function ex_explode($word_array, $str) {
    $return = array();

    //文字列を配列に入れる
    $array = array($str);

    //分割文字ごとにforeach
    foreach ($word_array as $value1){

        //文字列の配列を分割
        foreach ($array as $key => $value2) {
            $return = array_merge($return, explode($value1, $value2));

            //配列の最後になったら初期化
            if(count($array) - 1 === $key) {
                $array = $return;
                $return = array();
            }
        }
    }
    return $array;
}
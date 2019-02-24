<?php

// Конфигурация
$conf = ['char' => 'UTF-8', 'mimetype' => 'text/plain'];

// Искомая строка 
$search_substr = 'ер';

// Имя файла с текстом
$filename = 'text.txt';

searchStr($search_substr, $filename, $conf);

function searchStr($search, $filename, $conf) {

    $mimetype = $conf['mimetype'];
    $char = $conf['char'];

    if (!empty($filename)) {

        if (mime_content_type($filename) == $mimetype) {
            $lines = file($filename);
            $k = 0;

            foreach ($lines as $line) {

                if (!empty($line)) {
                    $k++;

                    if (substr_count($line, $search) == 1) {
                        echo 'Строка: ' . $k . ' Позиция: ' . mb_strpos($line, $search, 0, $char) . "<br>";
                    }

                    if (substr_count($line, $search) > 1) {
                        $pos_num = 0;
                        foreach (explode($search, $line, -1) as $value) {
                            $pos_num = $pos_num + mb_strpos($value . $search, $search, 0, $char);
                            echo 'Строка: ' . $k . ' Позиция: ' . $pos_num . "<br>";
                            $pos_num = $pos_num + mb_strlen($search, $char);
                        }
                    }
                } else {
                    return;
                }
            }
        } else {
            echo 'Неправильный формат файла!';
        }
    } else {
        echo 'Файл не найден!';
    }
}




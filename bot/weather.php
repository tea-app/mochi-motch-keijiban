<?php

$locations = array(
    '滋賀県' => 250010,
    '大阪府' => 270000,
    '京都府' => 260010,
    '兵庫県' => 280010,
    '和歌山県' => 300010,
    '奈良県' => 280010,
    '三重県' => 240010);
    $text = $_POST['content'];
    $location_code;
    if( array_key_exists($text, $locations)){
    $location_code = $locations[$text];
    $url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=" . $location_code;
    $json = file_get_contents($url, true);
    $json = json_decode($json, true);
    $title = $json['title'];
    $description = $json['description']['text'];
    $telop_today = $json['forecasts'][0]['telop'];
    $telop_tomorrow = $json['forecasts'][1]['telop'];
    $name = "weather_kinki";
    $content = "今日の天気..." . $telop_today . "<br>" . "明日の天気は... ". $telop_tomorrow . "<br>" . $descripetion . "<br>";
    echo '{ "name" : "' . $name . '", "content" : "' . $content . '" }';
    }
    else {
    $name = "weather_kinki";
    $content = "県名が正しく入力されていません。県名を正しく入力してください。(例)天気　京都府 <br>※県は近畿圏のみしか適用されません";
    echo '{ "name" : "' . $name . '", "content" : "' . $content . '" }';
    }
    ?>
     <?php
    // echo "<pre>";
    // var_dump($json);
    // echo "</pre>";
    ?>

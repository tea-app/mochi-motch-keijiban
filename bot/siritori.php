<?php
    require_once 'lib/Igo.php';
    $name = "しりとりbot";
    $content = "";
    //最初の文字を取得
    $key = file_get_contents('next.txt', true);//最初の文字
    // var_dump($key);
    $used = file_get_contents('word.txt', true);
    // var_dump($used);
    if($key == ""){
      $key = "り";//最初はしりとりの"り"から
    }
    //入力によって処理する
    if($_GET['a'] == false) $content = "内容を入力してください。";
    else {
      ////漢字やカナをひらがなに変換
      $igo = new Igo(dirname(__FILE__) . "/ipadic");
      $text = $_GET['a'];

      $result = $igo->parse($text);
      $str = "";
      foreach($result as $value){
        $feature = explode(",", $value->feature);
        $str .= isset($feature[7]) ? $feature[7] : $value->surface;
      }
      ////
      //var_dump($key);
      $pre = mb_convert_kana($str, "c", "utf-8");
      //var_dump(substr($pre, 0,3));
      if(strpos(substr($pre, -3),'ん') !== false){
        $content =  "\"ん\"なのであなたの負け";
      }else if(strpos($used,$pre) !== false){
        $content = "使った言葉";
      }else if(strpos($key,substr($pre, 0,3)) === false){
        $content = "ちがう頭文字";
      }else{
        $filename = chmod('word.txt', 0666);
        $word = fopen('word.txt', 'a');
        $next = $pre;
        $content = $next;
        $set = $next;
        fwrite($word, $set);
        fwrite($word, " ");
        fclose($next);
        $key = substr($next, -3);
        //小文字を大文字に変換
        $key=str_replace(
          Array('ぁ','ぃ','ぅ','ぇ','ぉ','ゃ','ゅ','ょ','ゎ')
          ,Array('あ','い','う','え','お','や','ゆ','よ','わ')
          ,$key);

        var_dump($key);
        $filename = chmod('next.txt', 0666);
        $word = fopen('next.txt', 'w');
        fwrite($word, $key);
        fclose($word);
      }
    }
    echo '{ "name" : "' . $name . '", "content" : "' . $content . '" }';
?>

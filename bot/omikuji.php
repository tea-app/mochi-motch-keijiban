<?php
   $point = 0;
   $name = "もちもっちbot";
   $content = "";
   for ($i=0; $i < 10; $i++) {
     $score = rand(1,100);
     switch($score){
       case 1 <= $score && $score <= 50:
       $content .= " ・・・ <br>";
       $point += 0;
       break;
       case 51 <= $score && $score <= 70:
       $content .= "N もちもっちッ <br>";
       $point += 10;
       break;
       case 31 <= $score && $score <= 80:
       $content .= "R ﾝﾓﾁﾓｯﾁｨｲｯ <br>";
       $point += 20;
       break;
       case 81 <= $score && $score <= 94:
       $content .= "SR ﾝﾓﾁﾓｯｯﾁｨﾝｯ!! <br>";
       $point += 40;
       break;
       case 95 <= $score && $score <= 99:
       $content .= "UR ﾓｧｧﾓﾓｧﾓﾁﾓｯｯｯﾁｯｯｯ!!! <br>";
       $point += 50;
       break;
       case 100:
       $content .= "??? 失礼しました。もちもっちとでてしまいました。<br>";
       $point += 100;
       break;
       default:
       break;
     }
     $content .= "<br>";
   }
   $content .= "<br>";
  //  $content .= $point;
   switch($point){
     case $point <= 0:
     $content .= " うわぁ・・・ <br>";
     break;
     default:
     break;
   }
   echo '{ "name" : "' . $name . '", "content" : "' . $content . '" }';


?>

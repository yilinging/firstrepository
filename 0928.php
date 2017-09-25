<?php

date_default_timezone_set("Asia/Taipei");
$datetime = date("Y-m-d");
$time = date("H:i:s");
echo $datetime. " ". $time;
echo "<br>";

r140("1");
function r140($p_code)  //196-782
{
  global $rowCount; //宣告成全域變數
  $l_ac = 5; //60248098 rowCount
  $l_sl = 2;
  echo "p_code = ". $p_code."<br>";
  global $maxac;
  $maxac = 100;

  $whileend=1;
  //while (true)
  do
  {
    echo "while true" ."<br>";
    beforerow();
    function beforerow()  //onclick
    {
      echo "beforerow function";
      echo "lac ". $l_ac;
        $cn3 = $l_ac;//前端顯示欄位cn3的值=l_ac
      }
      echo "break while" ."<br>";
      break;
    }while($whileend<0);
    echo "end while" ."<br>";
  }

  ?>
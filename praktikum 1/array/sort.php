<?php
$ar_buah = ["a" => "apel" , "s" => "semangka", "d" => "duren", "m" => "mangga"];
  
  echo'<ol>';
  sort($ar_buah);
  echo '<hr/>';
  echo '</ol>';

  foreach ($ar_buah as $_key => $_value) {
      echo '<li>'.$_key.' -nama buah: '.$_value.'</li>';
  }
 echo'</ol>';
  ?>
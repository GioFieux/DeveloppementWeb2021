<?php
  echo "Hello <br>";
  $heure = date("H")+2;
  echo "Il est $heure h <br>";
  if ($heure>6 && $heure<=12){
    echo "Morning <br>";
    echo "<img src='images/Zebre.png' width='25%'>";
  }
  elseif ($heure>=13 && $heure<=16) {
    echo "Afternoon <br>";
    echo "<img src='images/Girafe.png' width='25%'>";
  }
  elseif ($heure>16 && $heure<20) {
    echo "Noon <br>";
    echo "<img src='images/Panda.png' width='25%'>";
  }
?>

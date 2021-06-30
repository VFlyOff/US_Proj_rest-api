<?php
header("Content-Type: text/html; charset=utf-8");//windows-1251
   header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
   header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
   header('Cache-Control: no-cache, must-revalidate');
   header('Pragma: no-cache');
?>
<html>
<head>
<title>Доллар</title>
</head>

<body>
<h3>Курс доллара</h3>

<?php
	require_once('connect.php');
	
$cbr = new CBRAgent();
if ($cbr->load($url)){    
    $usc = $cbr->get('USD');

}

$cbrMD = new CBRAgent();
if ($cbrMD->loadMD($urld)){    
    $uscMD = $cbrMD->get('USD');
    
}

if ($usc > $uscMD){
    $uscMD = $usc - $uscMD;
    if ($_POST['dateUsc'] == null){
    echo  "На сегодня курс доллара составляет ".$usc." рублей. > на ".$uscMD.", чем вчера.";
}else{ echo  "На ".($_POST['dateUsc'])." курс доллара составляет ".$usc."
рублей. > на ".$uscMD.", чем вчера.";}
}elseif ($usc < $uscMD){
    $uscMD = $uscMD - $usc;
    if ($_POST['dateUsc'] == null){
    echo  "На сегодня курс доллара составляет ".$usc." рублей. < на ".$uscMD.", чем вчера.";
}else{ echo  "На ".($_POST['dateUsc'])." курс доллара составляет ".$usc."
рублей. < на ".$uscMD.", чем вчера.";}
}elseif ($usc == $uscMD){
    if ($_POST['dateUsc'] == null){
    echo  "На сегодня курс доллара составляет ".$usc." рублей. Со вчерашнего дня курс никак
    не изменился";
}else{ echo  "На ".($_POST['dateUsc'])." курс доллара составляет ".$usc." рублей. Со вчерашнего
дня курс никак не изменлся";}
}
?>
<br><br>
<div><p> Изменить дату: </p>
          <form action="" method="post">
              <td>Дата</td>
              <td><input type="date" name="dateUsc"></td>
              <td colspan="2"><input type="submit" value="Сохранить"></td> 
          </form>
        </div>
</body>
</html>
<?php
header("Content-Type: text/html; charset=utf-8");//windows-1251
   header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
   header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
   header('Cache-Control: no-cache, must-revalidate');
   header('Pragma: no-cache');
?>
<html>
<head>
<title>Евро</title>
</head>

<body>
<h3>Курс евро</h3>

<?php
	require_once('connect.php');
$cbr = new CBRAgent();
if ($cbr->load()){    
    $use = $cbr->get('EUR');

}

$cbrMD = new CBRAgent();
if ($cbrMD->loadMD($urld)){    
    $useMD = $cbrMD->get('EUR');
}

if ($use > $useMD){
    $useMD = $use - $useMD;
    if ($_POST['dateUse'] == null){
    echo  "На сегодня курс евро составляет ".$use." рублей. > на ".$useMD.", чем вчера.";
}else{ echo  "На ".($_POST['dateUse'])." курс евро составляет ".$use."
рублей. > на ".$useMD.", чем вчера.";}
}elseif ($use < $useMD){
    $useMD = $useMD - $use;
    if ($_POST['dateUse'] == null){
    echo  "На сегодня курс евро составляет ".$use." рублей. < на ".$useMD.", чем вчера.";
}else{ echo  "На ".($_POST['dateUse'])." курс евро составляет ".$use."
рублей. < на ".$useMD.", чем вчера.";}
}elseif ($use == $useMD){
    if ($_POST['dateUse'] == null){
    echo  "На сегодня курс евро составляет ".$use." рублей. Со вчерашнего дня курс никак не 
    изменился";
}else{ echo  "На ".($_POST['dateUse'])." курс евро составляет ".$use." рублей. Со вчерашнего
дня курс никак не изменлся";}
}
?>
<br><br>
<div><p> Изменить дату: </p>
          <form action="" method="post">
              <td>Дата</td>
              <td><input type="date" name="dateUse"></td>
              <td colspan="2"><input type="submit" value="Сохранить"></td> 
          </form>
        </div>
</body>
</html>
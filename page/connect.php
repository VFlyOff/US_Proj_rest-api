<?php
header("Content-Type: text/html; charset=utf-8");//windows-1251
   header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
   header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
   header('Cache-Control: no-cache, must-revalidate');
   header('Pragma: no-cache');
    
class CBRAgent
{
    protected $list = array();
 
    public function load()
    {
        $xml = new DOMDocument();
        
        $date = date('d.m.Y');
        $dateUsc = date('d.m.Y', strtotime($_POST['dateUsc']));
        $dateUse = date('d.m.Y', strtotime($_POST['dateUse']));
        
        if ($_POST['dateUsc'] == null AND $_POST['dateUse'] == null)
        {
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date;
        }elseif($_POST['dateUsc'] != null AND $_POST['dateUse'] == null){
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateUsc;
        }elseif($_POST['dateUsc'] == null AND $_POST['dateUse'] != null){
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateUse;
        }
 
        if (@$xml->load($url))
        {
            $this->list = array(); 
 
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
 
            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }
 
            return true;
        } 
        
        else
            return false;
    }
     public function loadMD()
    {
       $xml = new DOMDocument();
        
        $dateMD = date('d.m.Y', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
        
        $dateUsc = date('d.m.Y', strtotime($_POST['dateUsc']));
        $dateUsc = strtotime($dateUsc);
        $dateUsc = strtotime("-1 day", $dateUsc);
        $dateUscMD = date('d.m.Y', $dateUsc); 
        $dateUse = date('d.m.Y', strtotime($_POST['dateUse']));
        $dateUse = strtotime($dateUse);
        $dateUse = strtotime("-1 day", $dateUse);
        $dateUseMD = date('d.m.Y', $dateUse);
        
        if ($_POST['dateUsc'] == null AND $_POST['dateUse'] == null)
        {
            $urld = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateMD;
        }elseif($_POST['dateUsc'] != null AND $_POST['dateUse'] == null){
            $urld = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateUscMD;
        }elseif($_POST['dateUsc'] == null AND $_POST['dateUse'] != null){
            $urld = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateUseMD;
        }
        if (@$xml->load($urld))
        {
            $this->list = array(); 
 
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
 
            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }
 
            return true;
        } 
        
        else
            return false;
    }
    public function get($cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }
}

?>
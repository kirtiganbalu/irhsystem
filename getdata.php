<?php

function sqlquery($sql){
	$db = new PDO('mysql:host=localhost;dbname=irhsyste_irhs','irhsyste_kab','m-TCs5nx6G6i');
 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = $db->prepare($sql);
	return $statement;
}

//error_reporting(E_ALL); ini_set('display_errors', 1); 
function newsparser ($url) {
if (function_exists('curl_init')) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com');
curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");	
curl_setopt($ch, CURLOPT_HEADER, 0);
return curl_exec($ch);
} else {
return file_get_contents($url);
}
}

?>

<div class="alert alert-dismissible alert-primary mt-3">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php
//$getmaxsesi=sqlquery("SELECT sesi FROM `tblsesi` order by id desc limit 1");
//$getmaxsesi->execute();
//$gtmaxsesi = $getmaxsesi->fetch(PDO::FETCH_ASSOC);
//$maxsesi=$gtmaxsesi['sesi'];
$maxsesi="1 : 2022/2023";

//$url='http://spmp.psmza.edu.my/stdasrama.jsp?ss='.$maxsesi;
$url='http://spmp.psmza.edu.my/stdasrama.jsp';
$getparse=newsparser($url);
$jparse=json_decode($getparse,true);
$records=$jparse['Records'];
	
//print_r($jparse);
	
	
$bil=0;
foreach($records as $record){
    $nokpspmp=trim($record['nokp']);
    //check dah ada kat koperasi
    $qgetahlikkop=sqlquery("select nokp from  tblasrama where nokp=? and sesisemasa=?");
    $qgetahlikkop->bindValue(1,$nokpspmp); 
	$qgetahlikkop->bindValue(2,$maxsesi); 
    $qgetahlikkop->execute();  
    $rowada=$qgetahlikkop->rowCount();
    
        $nopend=trim($record['nopend']);
        $nama=trim($record['nama']);
        $semester=trim($record['semester']);
        $kelas=trim($record['kelas']);
        $jbtn=trim($record['jbtn']);
        $jantina=trim($record['jantina']);
        $stsbilik=trim($record['stsbilik']);
		$blok=trim($record['blok']);
		$paras=trim($record['paras']);
		$nobilik=trim($record['nobilik']);
		$sesisemasa=trim($record['sesisemasa']);
    
    
    if($rowada>0){
        $qupstd=sqlquery("update tblasrama set semester=?, kelas=?, stsbilik=?, blok=?, paras=?, nobilik=? where nokp=?");
        $qupstd->bindValue(1,$semester);
        $qupstd->bindValue(2,$kelas); 
        $qupstd->bindValue(3,$stsbilik); 
        $qupstd->bindValue(4,$blok); 
		$qupstd->bindValue(5,$paras); 
		$qupstd->bindValue(6,$nobilik); 
		$qupstd->bindValue(7,$nokpspmp); 
        $qupstd->execute(); 
        
        //echo $nama." dari ".$kelas." telah dikemaskini<br>";
        
    }else{
         
        
        $qinskoperasi=sqlquery("insert into tblasrama (nokp,nopend,nama,semester, kelas, jbtn,jantina, stsbilik, blok, paras, nobilik, sesisemasa) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $qinskoperasi->bindValue(1,$nokpspmp);
        $qinskoperasi->bindValue(2,$nopend); 
        $qinskoperasi->bindValue(3,$nama); 
        $qinskoperasi->bindValue(4,$semester); 
        $qinskoperasi->bindValue(5,$kelas); 
        $qinskoperasi->bindValue(6,$jbtn); 
        $qinskoperasi->bindValue(7,$jantina);
        $qinskoperasi->bindValue(8,$stsbilik);
		$qinskoperasi->bindValue(9,$blok);
		$qinskoperasi->bindValue(10,$paras);
		$qinskoperasi->bindValue(11,$nobilik);
		$qinskoperasi->bindValue(12,$sesisemasa);
        $qinskoperasi->execute(); 
        
        //echo $nama." dari ".$kelas." telah ditambah<br>";
        
        $bil++;
    }
    
    
    //echo "Nokp :".$nokp."<br>";
}
if($bil==0){
    $bils="Tiada penambahan. Data pelajar adalah terkini.";
}else{
    $bils=$bil." orang pelajar telah dikemaskini";
}
echo $bils;
?>
</div>



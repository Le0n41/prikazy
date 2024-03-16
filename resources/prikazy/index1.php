<?php

/*function getPortal($app, $skey, $module, $param_array = null) {
         $portal = 
'https://int.istu.edu/extranet/worker/rp_view/integration/';
         $a = false;
         $i = 0;

         if (isset($param_array)) {
             $s = "";
             foreach ($param_array as $key => $value) {
                 $s = $s . urlencode($key) . '=' . urlencode($value) . '&';
             }
             $module = $module . '?' . substr($s, 0, -1);
         };
         $path = $portal . $app . '/' . $skey . '/' . $module;
         #return $path;

         while ($a == false && $i < 4) {
             $a = file_get_contents($path);
             $i++;
             if ($a == false) {
                 usleep(100000 + $i * 50000);
             }
         }
         $array = json_decode($a, true);
         

*/

     function getPortal($app, $skey, $module, $param_array = null) {
         $portal = 
'https://int.istu.edu/extranet/worker/rp_view/integration/';
         $a = false;
         $i = 0;

         if (isset($param_array)) {
             $s = "";
             foreach ($param_array as $key => $value) {
                 $s = $s . urlencode($key) . '=' . urlencode($value) . '&';
             }
             $module = $module . '?' . substr($s, 0, -1);
         };
         $path = $portal . $app . '/' . $skey . '/' . $module;
         #return $path;

         while ($a == false && $i < 4) {
             $a = file_get_contents($path);
             $i++;
             if ($a == false) {
                 usleep(100000 + $i * 50000);
             }
         }
         $array = json_decode($a, true);
         return $array;
     }

print "Проверка связи\n";
/*$resQuest = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'ping');
//print_r($resQuest);
foreach($resQuest["RecordSet"] as $res => $value){
	print_r($res);
}*/




/*     print "Студенты\n";
     print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'stud.fac', array(id => 46)));
     print "Компании\n";
     print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'practice.company'));
     print "Институты\n";
     print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'faculty'));*/





require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?php
 print "Сотрудники\n";
/* print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'worker.fac', array(id => 46)));*/
//$stud = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'stud.fac', array(id => 46));
//print_r($stud);
/*foreach($stud["RecordSet"] as $name => $value){
	print "id: ".$stud["RecordSet"][$name]["id"].'<br>';
	print "name: ".$stud["RecordSet"][$name]["name"].'<br>';
	print "grup: ".$stud["RecordSet"][$name]["grup"].'<br>';
	print '<br>';
}*/


     print "Проверка связи\n<br>";
print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'ping'));
/*
print "<h3>Сотрудники\n</h3>";
$sotr = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'worker.fac', array(id => 46));
//print_r();
foreach($sotr["RecordSet"] as $name => $value){
	print "id: ".$sotr["RecordSet"][$name]["id"].'<br>';
	print "name: ".$sotr["RecordSet"][$name]["name"].'<br>';
	print "post: ".$sotr["RecordSet"][$name]["post"].'<br>';
	print "si_title: ".$sotr["RecordSet"][$name]["si_title"].'<br>';
	print "department: ".$sotr["RecordSet"][$name]["department"].'<br>';
	print '<br>';
}*/

print "<h3>Студенты\n</h3>";
$stud = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'stud.fac', array(id => 46));
//print_r($stud);
foreach($stud["RecordSet"] as $name => $value){
	print "id: ".$stud["RecordSet"][$name]["id"].'<br>';
	print "name: ".$stud["RecordSet"][$name]["name"].'<br>';
	print "grup: ".$stud["RecordSet"][$name]["grup"].'<br>';
	print '<br>';
}
/*
print "<h3>Компании\n</h3>";
//  print_r(getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'practice.company'));
print "<h3>Институты\n</h3>";
    $inst = (getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 
'mNNxbKiXS9', 'faculty'));
//$json = json_encode($inst, true);
print $inst["1"];
foreach($inst["RecordSet"] as $name => $value){
	print $inst["RecordSet"][$name]["name"].' - '.$inst["RecordSet"][$name]["id"].'<br>';
}

foreach($inst as $i){
	foreach($i as $in){
		print($in[0]);
		foreach($in as $ins){
			//print_r($ins);
			//print "<br>";
		}

		print "<br>";
	}
}*/
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
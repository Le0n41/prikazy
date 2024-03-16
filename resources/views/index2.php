<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
function connection() {
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $db = 'Practices';
      try{
        #$connect = new mysqli($host, $user,$pass,$db);
		$connect = Bitrix\Main\Application::getConnection();
      }
      catch(Exception $e){
         die("[1] - connection_error");
      }

   return $connect;
   }

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
$connect = connection();
/*$array = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'practice.company', array('id' => 46));

     foreach ($array["RecordSet"] as $value){
	     print_r($value);
	 	 print("<br>");
		 //$connect->query("INSERT INTO Practices.companies (name) VALUES ('".$value["name"]."')");
	 }

$array = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'worker.fac', array('id' => 46));  
     foreach($array["RecordSet"] as $value){
	 	 print_r($value);
	 	 print("<br>");
		 //$connect->query("INSERT INTO Practices.teachers (fio, post, work_load) VALUES ('".$value["name"]."', '".$value["post"]."','40')");
     }
*/

/*$array = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'stud.fac', array('id' => 46));  

     foreach ($array["RecordSet"] as $value){
         $parts = explode('-', $value["grup"]);

         $resultset = $connect->query("SELECT id FROM Practices.streams Where name = '".$parts[0]."' and year = '".$parts[1]."';");
         $stream_id=$resultset->Fetch()["id"];

         $resultset = $connect->query("SELECT id FROM Practices.groups Where stream_id = '".$stream_id."' and group_number = '".$parts[2]."';");
         $group_id=$resultset->Fetch()["id"];

         if (! $stream_id or !$group_id){
             print("ERROR".$value["name"]." ".$parts[0]." ".$parts[1]." ".$parts[2]."<br>");
         }
         else{
             print($value["name"]." ".$parts[0]." ".$parts[1]." ".$parts[2]."<br>");
             $connect->query("INSERT INTO Practices.students (fio, stud_id, category, group_id) VALUES ('".$value["name"]."', '123456', 'test', '".$group_id."');");
         }
}*/
/*use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = IOFactory::load('groups.xlsx');

$worksheet = $spreadsheet->getActiveSheet();

$rows = $worksheet->getHighestRow();
$profile_id=1;

for ($row = 1; $row <= $rows; $row++) {
        $value = $worksheet->getCell("A".$row)->getValue();

        if ($value == ""){
print("Нет ни х");
          continue;
        }
        if(strstr($value,"институт") or strstr($value,"Институт")){
          $resultset = $connect->query("SELECT id FROM Practices.faculty Where name = '".$value."';");
          $faculty_id= $resultset->Fetch()["id"];
        } 
        else{
          $year = $worksheet->getCell("D".$row)->getValue();
          $times = $worksheet->getCell("E".$row)->getValue();

          $connect->query("INSERT INTO Practices.streams (name, year, full_name, code, profile_id) VALUES ('".$value."', '".$year."', 'test', '1', '".$profile_id."')");

          foreach (range(1,$times) as $group_number) {

            $resultset = $connect->query("SELECT id FROM Practices.streams Where name = '".$value."' and year = '".$year."';");
            $stream_id = $resultset->Fetch()["id"];
			print($value."-".$year."-".$group_number." ".$profile_id." ".$stream_id);
			print("<br>");
            $connect->query("INSERT INTO Practices.groups (group_number, stream_id) VALUES ('".$group_number."', '".$stream_id."')");
          }   
        }
}   */     


$stud = getPortal('3e927995-75ee-4c90-a9dc-b1c9e775e034', 'mNNxbKiXS9', 'stud.fac', array(id => 46));
//print_r($stud);
foreach($stud["RecordSet"] as $name => $value){
	print "id: ".$stud["RecordSet"][$name]["id"].'<br>';
	print "name: ".$stud["RecordSet"][$name]["name"].'<br>';
	print "grup: ".$stud["RecordSet"][$name]["grup"].'<br>';
	print '<br>';
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

Text here....

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
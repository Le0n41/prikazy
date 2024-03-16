

<?php
$institutes = array("ИИТиАД","ИАСиД");

if (isset($_GET['download'])) {
	Download_Templace($_GET['download']);
	}
if (isset($_GET['done'])) {
	$connect->query("UPDATE Practices.templates SET decanat_check = 1, comment = '' WHERE id =". $_GET['done'] .";");
	//Download_Templace($_GET['done']);
	}
if (isset($_GET['noShow'])) {
	$connect->query("UPDATE Practices.templates SET decanat_check = 0, comment = '' WHERE id =". $_GET['noShow'] .";");
	//Download_Templace($_GET['done']);
	}
if (isset($_GET['remake'])) {
	$connect->query("UPDATE Practices.templates SET decanat_check = 2, comment = '". $_GET['comment'] ."' WHERE id =". $_GET['remake'] .";");
	//Download_Templace($_GET['remake']);
	}

function Download_Templace($name){
	$file = "../../direktsiya/".$name;
	$filename = str_replace(['../../direktsiya/uploads'], "", $name);
      if(!file_exists($file)){
          die('file not found');

      } else {
         ob_end_clean();
         header("Content-Description: File Transfer");
         header("Content-Type: text/Xls");
         header("Content-Disposition: attachment; filename=".$filename);
         header("Content-Transfer-Encoding: binary");
         #header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header("Content-Length: ".filesize($file));

         readfile($file);
      }
}


/*
function Select_instituts($connect) {
  $resultset = ['Итиад', 'Иасид'];
return $resultset;
} 

function Select_profiles($connect, $id_inst) {
  $resultset = $connect->query("SELECT * FROM Practices.profiles WHERE faculty_id = '".$id_inst."';");
return $resultset;
} 

function Select_streams_b($connect, $id_prof) {
	$resultset = $connect->query("SELECT * FROM Practices.streams WHERE profile_id = '".$id_prof."' and profile_id NOT LIKE '1' and name REGEXP '.б-' ORDER BY name;");
return $resultset;
}
function Select_streams_b($connect, $id_prof) {
  $year = date("Y") - 4;
  if (date("m") > 9){
    $year++;
  }

  $resultset = $connect->query("SELECT * FROM Practices.streams as stream
                  WHERE profile_id = '".$id_prof."' 
                  and profile_id NOT LIKE '1' 
                  and name REGEXP '.б-' 
                  and year >= ".$year."
                  and (select count(*) from Practices.groups where stream_id = stream.id) > 0
                  ORDER BY name;");
return $resultset;
}


function Select_streams_m($connect, $id_prof) {
	$resultset = $connect->query("SELECT * FROM Practices.streams WHERE profile_id = '".$id_prof."' and profile_id NOT LIKE '1' and name REGEXP '.м-' ORDER BY name;");
return $resultset;
}
function Select_streams_m($connect, $id_prof) {
  $year = date("Y") - 2;
  if (date("m") > 9){
    $year++;
  }

  $resultset = $connect->query("SELECT * FROM Practices.streams as stream
                  WHERE profile_id = '".$id_prof."' 
                  and profile_id NOT LIKE '1' 
                  and name REGEXP '.м-' 
                  and year >= ".$year."
                  and (select count(*) from Practices.groups where stream_id = stream.id) > 0
                  ORDER BY name;");
return $resultset;
} 
function Select_streams_z($connect, $id_prof) {
	$resultset = $connect->query("SELECT * FROM Practices.streams WHERE profile_id = '".$id_prof."' and profile_id NOT LIKE '1' and name REGEXP '.з-' ORDER BY name;");
return $resultset;
}
function Select_streams_z($connect, $id_prof) {
  $year = date("Y") - 5;
  if (date("m") > 9){
    $year++;
  }

  $resultset = $connect->query("SELECT * FROM Practices.streams as stream
                  WHERE profile_id = '".$id_prof."' 
                  and profile_id NOT LIKE '1' 
                  and name REGEXP '.з-' 
                  and year >= ".$year."
                  and (select count(*) from Practices.groups where stream_id = stream.id) > 0
                  ORDER BY name;");
return $resultset;
} 
function Select_group($connect, $id_stream) {
  $resultset = $connect->query("SELECT * FROM Practices.groups WHERE stream_id = '".$id_stream."';");
return $resultset;
} 
function Select_templates($connect, $id_group) {
  $resultset = $connect->query("SELECT * FROM Practices.templates WHERE group_id = '".$id_group."';");
return $resultset;
} 

*/


function firstAcardion($Institute)
{
	$id = ["1","2"];
    echo '<div class="accordion" id="accordionInstitute">';
	for ($i = 0; $i <= count($Institute) - 1; $i++) {
	
        echo '
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $i . '">
			<button class="accordion-button collapsed"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">
                    ' . $Institute[$i]. '
                </button>
            </h2>
            <div id="collapse' . $i . '" class="accordion-collapse collapse " aria-labelledby="heading' . $i . '" data-bs-parent="#accordionInstitute">
                <div class="accordion-body">
    ';
		secondAcardion($i, $Institute);


        echo '
    </div>
    </div>
    </div>';
    }
    echo '</div>';
}
?>
<?
function secondAcardion($faculty_id, $faculty_name)
{
    $formEducation = ["Bakalavr", "Magis", "Zaoch"];

	echo '<div class="accordion" id="accordionFormat'.$faculty_id.'">';
	foreach($formEducation as $form){
	$formRus = " ";
	switch ($form){
	case "Bakalavr":
		$formRus = "Бакалавриат";
		break;
	case "Magis":
		$formRus = "Магистратура";
		break;
	case "Zaoch":
		$formRus = "Заочное обучение";
		break;
	}

		echo '
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $form.$faculty_id . '">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $form .$faculty_id . '" aria-expanded="false" aria-controls="collapse' . $form .$faculty_id . '">
                    ' . $formRus . '
                </button>
            </h2>
            <div id="collapse' . $form .$faculty_id . '" class="accordion-collapse collapse " aria-labelledby="heading' . $form .$faculty_id . '" data-bs-parent="#accordionFormat' . $faculty_id . '">
                <div class="accordion-body">
    ';

		thirdAcardion($faculty_id, $faculty_name, $form);
        echo '
    </div>
    </div>
    </div>';

	}
		echo '</div>';


}
?>
<?php
function thirdAcardion($faculty_id, $faculty_name, $form)
{
	
	$streams = array("a","b","c");
	
	


		echo '<div class="accordion" id="accordionStream' . $faculty_id . '">';
		for ($i = 0; $i <= count($streams) - 1; $i++){
			//print_r($streams);
		echo '
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $i . '">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">
                    ' . $streams[$i].  '
                </button>
            </h2>
            <div id="collapse' . $i . '" class="accordion-collapse collapse " aria-labelledby="heading' . $i . '" data-bs-parent="#accordionStream' . $faculty_id . '">
                <div class="accordion-body">
    	';

		LastAcardion($i);
			//LastAcardion($st['id']);
        echo '   
                </div>
            </div>
        </div>
    ';
    }

		echo '</div>';
		}



?>
<?php
function LastAcardion($stream)
{	
	echo'<body>
		<table class="table">
            <thead>
                <tr class="tr">
                    <th class="th">Группа</th>
                    <th class="th">Шаблон приказа</th>
                    <th class="th">Статус</th>
                    <th class="th">Действие</th>
                </tr>
            </thead>
            <tbody>';

			$group = array ("gr1","gr2","gr3");
			$color = "";
			$colorText = "";
			for ($i = 0; $i <= count($group) - 1; $i++){
				$templates = array("a","b","c1");
				for ($i1 = 0; $i1 <= count($templates) - 1; $i1++){
				switch ("0") {
					case "0": /* Не проверено */
					    $color = "#FEF2E5";
						$Text = "Не проверено";
						$colorText = "#CD6200";
						break;
					case "1":  /* Принято */
					    $color = "#b1f0ad";
						$Text = "Принято";
						$colorText = "#1F9254";
						break;
					 case "2": /* Переделать */
					    $color = "#fadadd";
						$Text = "Переделать";
						$colorText = "#f23a11";
						break;
				};
				$name = $stream.'-'.$group[$i];
				$doc = str_replace(['.Xlsx'], '.xls', $templates[$i1]);
					//$link = str_replace(['../../../sotrudniku/praktika/direktsiya/','uploads/', '.xlsx'], "", $tmp['name']);

			echo'
            <tr class="tr">
			<td class="td" style="width: 100px; font-family: Helvetica Neue OTS, sans-serif; text-align: center; vertical-align: middle;"><strong class="strong">' . $name . '</strong></td>
			<td class="td" style= "width: 200px; color: #1E8EC2; font-family: Helvetica Neue OTS, sans-serif; text-align: center; vertical-align: middle;"> 
				<form>
				<button name="download" value="'.$doc.'"
					style="color: #1E8EC2; font-family: Helvetica Neue OTS, sans-serif;" class="btn">Файл</button>
				</form>
 			</td>
            <td class="td" style= "width: 200px; vertical-align: middle;">
				<div style="display: flex; justify-content: center; align-items: center;"> 
					<div style="display: inline-block; background-color: '.$color.'; padding: 5px; border-radius: 15px;  font-family: Helvetica Neue OTS, sans-serif; text-align: center;">
						<span style="color: ' . $colorText . ';"> ' . $Text . '</span>
					</div>
				</div>
            </td>
			<td class="td" style= "width: 400px; text-align: center; vertical-align: middle; margin: 0;">
			<form>
				<div class="input-group input-group-sm mb-0" style= "margin: 0;">';
					if ($Text != "Принято"){
						echo '<button type="submit" name="done" value="'.$templates[$i1].'" class="btn dropdown-item1" style = "border-radius: 5px;" href="#"></button>';
					}
					echo '<textarea class="form-control" name="comment" value="'.$templates[$i1].'" id="comment'.$templates[$i1].'" rows="1" style = "display: none; border-radius: 5px;" aria-label="Комментарий" aria-describedby="basic-addon2" placeholder="Комментарий"></textarea>

					<a class="btn dropdown-item3" id="showComment'.$templates[$i1].'" style = "border-radius: 5px;" onclick=showComment('.$templates[$i1].')></a>	
					<button type="submit" value="'.$templates[$i1].'" name="remake" class="btn dropdown-item3" id="reqComment'.$templates[$i1].'" style = "border-radius: 5px; display: none;"></button>	

					<button type="submit" name="noShow" value="'.$templates[$i1].'" class="btn dropdown-item2" style = "border-radius: 5px; display: none;"></button>
				</div>
			</form>
			</td>
        </tr>';
		}
    }
echo '</tbody>
        </table>
		</body>';
}
?>



<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Демо Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
		function showComment(id) {
            let comment = document.getElementById('comment' + id);
			let bt_comment = document.getElementById('reqComment' + id);
			let sh_comment = document.getElementById('showComment' + id);
           	comment.style.display = 'block';
			bt_comment.style.display = 'block';
			sh_comment.style.display = 'none';

        }
	</script>


  <style>
    .accordion-header {
      cursor: pointer;
      border-radius: 3px;
      font-size: 14px;
      font-family: 'Helvetica Neue OTS', sans-serif;
      font-weight: 400;


    }
	.accordion-item {
    background-color: #fff;
    border: 1px solid rgba(0,0,0,125);
	border-radius: 3px;
	}



	  .accordion-button.collapsed{
      cursor: pointer;
      border-radius: 3px;
		  border-top-left: 1px solid rgba(0,0,0,125);
	  }

	.accordion-collapse.collapsing{
		border-top: 1px solid rgba(0,0,0,125);
  	}
	.accordion-collapse.collapse{
		border-top: 1px solid rgba(0,0,0,125);
  	}
    .accordion-button:not(.collapsed){
		color: #1E8EC2 !important;
		 background-color: #E1F3F9 !important;
		border-radius: 3px;
  }

.table {
    background: #ffffff !important;
    border-collapse: collapse; /* Changed to 'collapse', the original value was 'separate' */
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05); /* Modified box shadow */
    font-size: 14px;
    text-align: left;
    max-width: 1450px;
    min-width: 800px;
    width: 100%; /* Added to ensure the table fills its container */
}

.table th,
    .table td {
      text-align: center;
    }


.tr:nth-child(odd) .td {
    background-color: #ffffff !important;
}

.tr:nth-child(even) .td {
    background-color: #E1F3F9 !important;
}

.td:last-child .select {
    width: 100%; /* Ширина элемента select, чтобы он занимал всю ширину ячейки */
}

.btn {
    margin-right: 5px;
	margin-left: 5px !important;
    background: none;
    color: inherit;
    border: none;
    padding: 0;
	display: inline-block;
    font: inherit;
    cursor: pointer;
    outline: inherit;
}
.btn:hover{
	text-decoration: underline;

}
.dropdown-item1 {
	background: url(https://cdn-icons-png.flaticon.com/512/8832/8832098.png) 50% 50% no-repeat;
	background-size: cover;
	width: 30px;
	height: 30px;

}
.dropdown-item1:hover {
  box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.dropdown-item2 {
	background: url(https://cdn-icons-png.flaticon.com/512/179/179386.png) 50% 50% no-repeat;

	background-size: cover;
	width: 30px;
	height: 30px;

}
.dropdown-item2:hover {
  box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.dropdown-item3 {
	background: url(https://cdn-icons-png.flaticon.com/512/1159/1159876.png) 50% 50% no-repeat;
	background-size: cover;
	width: 30px;
	height: 30px;

}
.dropdown-item3:hover {
	box-shadow: 0 0 10px rgba(0,0,0,0.5);

}

  </style>



	</head>

<body >



    <?php

firstAcardion($institutes);
getAll();
    ?>






</body>

</html>

<?
function getAll(){
	/*$institute = Select_instituts(connection());
	while($inst = $institute->fetch()){
		print("id = ");
		print_r($inst['id']);
		print("; name = ");
		print_r($inst['name']);
		print("<br>");
	$profiles = Select_profiles(connection(), $inst['id']);
	while($pr = $profiles->fetch()){
		print("id = ");
		print_r($pr['id']);
		print("; name = ");
		print_r($pr['name']);
		print("; faculty_id = ");
		print_r($pr['faculty_id']);
		print("<br>");

	}
	print("<br>");
}*/
/*
	$tables = connection()->query("show tables from Practices;");
	while($tb = $tables->fetch()){
		print_r($tb);
		print("<br>");

	}
	$tamplates = connection()->query("SELECT * FROM Practices.templates;");
	while($tb = $tamplates->fetch()){
		print_r($tb);

		print("<br>");

	}

	/*$groups = connection()->query("SELECT * FROM Practices.groups;");
	while($gr = $groups->fetch()){
		print_r($gr);

		print("<br>");

}*/
				 }
?>

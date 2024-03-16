<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Демо Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href = "{{ mix('/css/prikazy.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    @php
$controllerPrikazy = new App\Http\Controllers\ControllerPrikazy();

@endphp
@php
if (isset($_GET['download'])) {
	$controllerPrikazy->Download_Templace($_GET['download']);
	}
if (isset($_GET['done'])) {
	DB::table('templates')
                ->where('id', $_GET['done'])
                ->update(['decanat_check' => 1, 'comment' => '']);
	}
if (isset($_GET['noShow'])) {
	DB::table('templates')
                ->where('id', $_GET['noShow'])
                ->update(['decanat_check' => 0, 'comment' => '']);

	}
if (isset($_GET['remake'])) {
	DB::table('templates')
                ->where('id', $_GET['remake'])
                ->update(['decanat_check' => 2, 'comment' => $_GET['comment']]);
	}
@endphp
@php
function firstAcardion($Institute)
{
    echo '<div class="accordion" id="accordionInstitute">';
    foreach ($Institute as $inst) {
        echo '
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $inst['id'] . '">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $inst['id'] . '" aria-expanded="false" aria-controls="collapse' . $inst['id'] . '">
                    ' . $inst['name'] . '
                </button>
            </h2>
            <div id="collapse' . $inst['id'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $inst['id'] . '" data-bs-parent="#accordionInstitute">
                <div class="accordion-body">';
            secondAcardion($inst['id'], $inst['name']);
        echo '
                </div>
            </div>
        </div>';
    }
    echo '</div>';
}
@endphp 
@php
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
@endphp

@php
function thirdAcardion($faculty_id, $faculty_name, $form)
{
    $controllerPrikazy = new App\Http\Controllers\ControllerPrikazy();
	$profiles = $controllerPrikazy->Select_profiles($faculty_id);
	foreach($profiles as $prof){
		//print_r($prof['id']);
	$streams = null;
	switch ($form){
	case "Bakalavr":
		$streams = $controllerPrikazy->Select_streams_b($prof['id']);
		break;
	case "Magis":
		$streams = $controllerPrikazy->Select_streams_m($prof['id']);
		break;
	case "Zaoch":
		$streams = $controllerPrikazy->Select_streams_z($prof['id']);
		break;
	}


		echo '<div class="accordion" id="accordionStream' . $faculty_id . '">';
		foreach ($streams as $st){
			//print_r($streams);
		echo '
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading' . $st['id'] . '">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $st['id'] . '" aria-expanded="false" aria-controls="collapse' . $st['id'] . '">
                    ' . $st['name']." - ". $st['full_name'].  '
                </button>
            </h2>
            <div id="collapse' . $st['id'] . '" class="accordion-collapse collapse " aria-labelledby="heading' . $st['id'] . '" data-bs-parent="#accordionStream' . $faculty_id . '">
                <div class="accordion-body">
    	';

		LastAcardion($st);
			//LastAcardion($st['id']);
        echo '   
                </div>
            </div>
        </div>
    ';
    }

		echo '</div>';
		}


}
@endphp

@php
function LastAcardion($stream)
{	
    $controllerPrikazy = new App\Http\Controllers\ControllerPrikazy();
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

			$group = $controllerPrikazy->Select_group($stream['id']);
			$color = "";
			$colorText = "";
            $Text = "";
			foreach ($group as $gr ){
				$templates = $controllerPrikazy->Select_templates($gr['id']);
				foreach ($templates as $tmp){
				switch ($tmp['decanat_check']) {
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
				$name = $stream['name'].'-'.$gr['group_number'];
				$doc = str_replace(['.Xlsx'], '.xls', $tmp['name']);
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
						echo '<button type="submit" name="done" value="'.$tmp['id'].'" class="btn dropdown-item1" style = "border-radius: 5px;" href="#"></button>';
					}
					echo '<textarea class="form-control" name="comment" value="'.$tmp['comment'].'" id="comment'.$tmp['id'].'" rows="1" style = "display: none; border-radius: 5px;" aria-label="Комментарий" aria-describedby="basic-addon2" placeholder="Комментарий"></textarea>

					<a class="btn dropdown-item3" id="showComment'.$tmp['id'].'" style = "border-radius: 5px;" onclick=showComment('.$tmp['id'].')></a>	
					<button type="submit" value="'.$tmp['id'].'" name="remake" class="btn dropdown-item3" id="reqComment'.$tmp['id'].'" style = "border-radius: 5px; display: none;"></button>	

					<button type="submit" name="noShow" value="'.$tmp['id'].'" class="btn dropdown-item2" style = "border-radius: 5px; display: none;"></button>
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
@endphp

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






@php
firstAcardion($controllerPrikazy->Select_instituts());

@endphp
  
</body>

</html>

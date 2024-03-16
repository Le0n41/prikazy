<?php

namespace App\Http\Controllers;

use App\Models\faculty;
use App\Models\group;
use App\Models\profile;
use App\Models\stream;
use App\Models\student;
use App\Models\template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerPrikazy extends Controller
{
    

  
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
  

    public function Select_instituts() {
      // $resultset = $connect->query("SELECT * FROM Practices.faculty;");\
      $resultset = faculty::all();
    return $resultset;
    
    } 
    
    public function Select_profiles($id_inst) {
    //   $resultset = ("SELECT * FROM Practices.profiles WHERE faculty_id = '".$id_inst."';");
    // 
    //$id_inst = '1';
    $resultset = profile::where('faculty_id', $id_inst)->get();
    return $resultset;
    } 
    
   
    public function Select_streams_b($id_prof) {
      $year = date("Y") - 4;
      if (date("m") > 9){
        $year++;
      }
 
    
    //   $resultset = ("SELECT * FROM Practices.streams as stream
    //                   WHERE profile_id = '".$id_prof."' 
    //                   and profile_id NOT LIKE '1' 
    //                   and name REGEXP '.б-' 
    //                   and year >= ".$year."
    //                   and (select count(*) from Practices.groups where stream_id = stream.id) > 0
    //                   ORDER BY name;");
    // return $resultset;
      $resultset = stream::where('profile_id', $id_prof)
      ->whereNotIn('profile_id', [1])
      ->where('name', 'like', '%б-%')
      ->where('year', '>=', $year)
      ->has('groups')
      ->orderBy('name')
      ->get();
      
      return $resultset;
    }
    
  
   
    public function Select_streams_m($id_prof) {
      $year = date("Y") - 2;
      if (date("m") > 9){
        $year++;
      }
    
    //   $resultset = $connect->query("SELECT * FROM Practices.streams as stream
    //                   WHERE profile_id = '".$id_prof."' 
    //                   and profile_id NOT LIKE '1' 
    //                   and name REGEXP '.м-' 
    //                   and year >= ".$year."
    //                   and (select count(*) from Practices.groups where stream_id = stream.id) > 0
    //                   ORDER BY name;");
    // return $resultset;

    $resultset = stream::where('profile_id', $id_prof)
      ->where('profile_id', '<>', '1')
      ->where('name', 'REGEXP', '.м-')
      ->where('year', '>=', $year)
      ->whereHas('groups', function ($query) {
          $query->where('stream_id', '=', DB::raw('streams.id'));
      })
      ->orderBy('name')
      ->get();
      return $resultset;
    } 
    
    public function Select_streams_z($id_prof) {
      $year = date("Y") - 5;
      if (date("m") > 9){
        $year++;
      }
    
    //   $resultset = $connect->query("SELECT * FROM Practices.streams as stream
    //                   WHERE profile_id = '".$id_prof."' 
    //                   and profile_id NOT LIKE '1' 
    //                   and name REGEXP '.з-' 
    //                   and year >= ".$year."
    //                   and (select count(*) from Practices.groups where stream_id = stream.id) > 0
    //                   ORDER BY name;");
    // return $resultset;
      $resultset = stream::where('profile_id', $id_prof)
        ->where('profile_id', '<>', '1')
        ->where('name', 'REGEXP', '.з-')
        ->where('year', '>=', $year)
        ->whereHas('groups', function ($query) {
            $query->where('stream_id', '=', DB::raw('streams.id'));
        })
        ->orderBy('name')
        ->get();
        return $resultset;
    } 
    
    public function Select_group($id_stream) {
    
    //   $resultset = ("SELECT * FROM Practices.groups WHERE stream_id = '".$id_stream."';");
    // return $resultset;
    $resultset = group::where('stream_id', $id_stream)->get();
    return $resultset;
    } 
    public function Select_templates($id_group) {
      
    //   $resultset = $connect->query("SELECT * FROM Practices.templates WHERE group_id = '".$id_group."';");
    // return $resultset;
    $resultset = template::where('group_id', $id_group)->get();
    return $resultset;
    }
    
    
}

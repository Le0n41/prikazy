<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\faculty;
use App\Models\group;
use App\Models\profile;
use App\Models\stream;
use App\Models\student;
use App\Models\template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ControllerPrikazy extends Controller
{
  public static function get(Request $request)
    {
        $group = Group::all();
        $stream = Stream::all();
        $profile_b = Profile::where('id', '<>', null)->with('streams_b')->get();
        $profile_m = Profile::where('id', '<>', null)->with('streams_m')->get();
        $profile_z = Profile::where('id', '<>', null)->with('streams_z')->get();
        
        // dump($profile_b);
        // dump($profile_m);
        // dd($profile_z);
        $faculty = Faculty::where('id', '<>', null)->with('profiles.streams_b.groups', 'profiles.streams_m.groups', 'profiles.streams_z.groups')->get();
        // dd($faculty);
        $color = "";
        $colorText = "";
        $Text = "";

        $formEducation = ["Bakalavr", "Magis", "Zaoch"];
        $formRusArr = [];
        $formRus = "";
        foreach($formEducation as $form){
        switch ($form) {
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
        $formRusArr[] = $formRus; 
      }
        


        return view('prikazy', [
            'groups' => $group,
            'streams' => $stream,
            'profiles_b' => $profile_b,
            'profiles_m' => $profile_m,
            'profiles_z' => $profile_z,
            'facultys' => $faculty,
            'formEducation' => $formEducation,
            'formRus' => $formRusArr,
            'color' => $color,
            'colorText' => $colorText,
            'Text' => $Text,
        ]);
    }

    public static function post(Request $request)
    {
        $id = $request->input('id');
        $comment = $request->input('comment');
    
        if ($request->has('done')) {
            DB::table('templates')->where('id', $id)->update(['decanat_check' => 1, 'comment' => '']);
        } elseif ($request->has('noShow')) {
            DB::table('templates')->where('id', $id)->update(['decanat_check' => 0, 'comment' => '']);
        } elseif ($request->has('remake')) {
            DB::table('templates')->where('id', $id)->update(['decanat_check' => 2, 'comment' => $comment]);
        } elseif ($request->has('download')) {
            return Download_Templace($request);
        }
    }

  function Select_profiles($id_inst) {
    $resultset = profile::where('faculty_id', $id_inst)->get();
    return $resultset;
    }

  function Select_streams_b($id_prof) {
    $year = date("Y") - 4;
    if (date("m") > 9){
      $year++;
    }

    $resultset = stream::where('profile_id', $id_prof)
    ->whereNotIn('profile_id', [1])
    ->where('name', 'like', '%б-%')
    ->where('year', '>=', $year)
    ->has('groups')
    ->orderBy('name')
    ->get();
    
    return $resultset;
  }
  

 
  function Select_streams_m($id_prof) {
    $year = date("Y") - 2;
    if (date("m") > 9){
      $year++;
    }

  $resultset = stream::where('profile_id', $id_prof)
  ->whereNotIn('profile_id', [1])
  ->where('name', 'like', '%м-%')
  ->where('year', '>=', $year)
  ->has('groups')
  ->orderBy('name')
  ->get();
    return $resultset;
  } 
  
  function Select_streams_z($id_prof) {
    $year = date("Y") - 5;
    if (date("m") > 9){
      $year++;
    }
  
    $resultset = stream::where('profile_id', $id_prof)
    ->whereNotIn('profile_id', [1])
    ->where('name', 'like', '%з-%')
    ->where('year', '>=', $year)
    ->has('groups')
    ->orderBy('name')
    ->get();
      return $resultset;
  }
  function Select_group($id_stream) {
    $resultset = group::where('stream_id', $id_stream)->get();
    return $resultset;
    }
    function Select_templates($id_group) {
      $resultset = template::where('group_id', $id_group)->get();
      return $resultset;
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
  
  
  }
  

    // function Select_instituts() {
    //   $resultset = faculty::all();
    // return $resultset;
    // } 
    
     
    
     
    
     
    
    
    


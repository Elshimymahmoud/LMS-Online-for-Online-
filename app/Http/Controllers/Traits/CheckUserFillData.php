<?php

namespace App\Http\Controllers\Traits;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Location\Facades\Location;
trait CheckUserFillData
{

  public function IsUserFilledData()
  {
      # code...
      $user=Auth::user();
     $first_name=$user->first_name??null;
     $last_name=$user->last_name??null;
     $name_ar=$user->name_ar??null;
     $national_id_number=$user->national_id_number??null;
     $country=$user->country??null;
     $city=$user->city??null;
     $phone=$user->phone??null;
     $data=[
        $first_name,
        $last_name,
        $name_ar,
        $national_id_number,
        $country,
        $city,
        $phone,
     ];
     
    
     if(in_array(null, $data, true)|| in_array('', $data, true)){
         return false;
     }
     else{
         return true;
     }
     

  }
  public function getUserCountry(Request $request){
    $ip = '162.159.24.227';//$request->ip(); /* Static IP address */
    
    $currentUserInfo = Location::get($ip);
   
    return $currentUserInfo?$currentUserInfo->countryName:null;
  }

}
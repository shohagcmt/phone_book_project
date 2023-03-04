<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    function onRegistrationController(Request $request){
        $firstname =$request->input('firstname');
        $lastname =$request->input('lastname');
        $city =$request->input('city');
        $username =$request->input('username');
        $password=$request->input('password');
        $gender=$request->input('gender');
        $userCount=Registration::where('username',$username)->count();
        if($userCount!=0){
            return 'User Already Exists';
        }
        else{
          $result=Registration::insert([
              'firstname'=>$firstname ,
              'lastname'=>$lastname,
              'city'=>$city,
              'username'=>$username,
              'password'=>$password,
              'gender'=>$gender
           ]);
              if($result==true){
                  return 'Registration Success';
              }
              else{
                  return 'Registration Fail';
              }
  
        }
  
        
      }
}

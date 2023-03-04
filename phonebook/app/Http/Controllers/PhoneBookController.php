<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\phoneBook;

class PhoneBookController extends Controller
{
    function onInsert(Request $request){
        $token=$request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded =JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
       
       // return response()->json($decoded);
        $user=$decoded_array['user'];
        $one=$request->input('one');
        $two=$request->input('two');
        $name=$request->input('name');
        $email=$request->input('email');

        $result=phoneBook::insert([
            'username'=>$user,
            'phone_number_one'=>$one,
            'phone_number_two'=>$two,
            'name'=>$name,
            'email'=>$email
            
         ]);
         if($result==true){
            return 'save Success';
        }
        else{
            return 'save Fail';
        }
    }

    function onSelect(Request $request){
        $token=$request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
        $user=$decoded_array['user'];
        $result=phoneBook::where('username',$user)->get();
        return $result;
    }

    function onDelete(Request $request){
        $email=$request->input('email');
        $token=$request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
        $user=$decoded_array['user'];
        $result=phoneBook::where(['username'=>$user,'email'=>$email])->delete();
        if($result==true){
            return 'delete Success';
        }
        else{
            return 'delete Fail try Again';
        }
    }
}

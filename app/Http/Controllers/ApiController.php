<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB, Hash, Mail, Illuminate\Support\Facades\Password;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class ApiController extends Controller
{

    /**
     * Store method
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $rules = [
            'username_list' => 'required',
            'message' =>  'required|max:2048',
        ];

        $input = $request->only('username_list','message');

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        
        $username_list  = $request->username_list;
        $response_array = [];
        
        /*Todo add to Queue Redis*/
        foreach($username_list as $username){
        
          $response = $this->get_user_info($username);
          
          $rules = [
            'user_location' => 'required',
            'user_email' =>  'required',
          ];
          
          $validator = Validator::make($response, $rules);
          
          if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
          }
          
          $user_weather = $this->get_user_weather($response['user_location']);
          $message =  $request->message.' - '.$user_weather;
          
          // Send Email to user
          $this->send($response['user_email'],$message);
          $response_array[] = $response;
        }   
        
       return response()->json(['success' => true, 'data' => $response_array], 200);
    }
    
    
    public function get_user_info($username)
    {
       $client = new \Github\Client();
       
      try {
            // attempt to verify the credentials and create a token for the user
            if (! $user = $client->api('user')->show($username)) {
                return false;
            }
        } catch (Exception  $e) {
            // something went wrong 
            return false;
      }
       
      return ['user_location' =>  $user['location'],'user_email'  =>  $user['email']];
      
    
    }
    
    public function get_user_weather($city_name)
    {
    
      $stack = HandlerStack::create();
      
      $client = new Client([
            'base_uri' => 'https://goweather.herokuapp.com/weather/',
            'handler' => $stack,
            'auth' => 'oauth',
            'verify' => false
        ]);

        try {
          $res = $client->request('GET', $city_name);
          $body = json_decode($res->getBody());
          
        } catch (Exception $e) {
          $body = json_decode($e->getResponse()->getBody());
        }
        
    }
    
    public function send($user_email,$user_message)
    {
      try {
      
        Mail::send('email.welcome', [ 'user_email'  => $user_email ,'content' => $user_message], function ($message)  use ($user_email)
          {

              $message->from('testapi@testapi.com', 'Test Api');

              $message->to($user_email);

          });
        } catch (Exception  $e) {
              // something went wrong 
              return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        
        return response()->json(['message' => 'Request completed']);
    }
    
    
    
}

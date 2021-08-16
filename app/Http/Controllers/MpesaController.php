<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{

    public function index(){
       try{
           $env = 'sandbox';
           $config= config("misc.mpesa.c2b.($env)");
           $token=(new TokenGenerator())->generateToken($env);
           $confirmation_url=route('api.mpesa.c2b.confirm',$config['confirmation_key']);
           $validation_url=route('api.mpesa.c2b.validate',$config['validation_key']);
           $short_code=$config['short_code'];
           
           dd("haha");

           $response = (new Registrar())->setShortCode($short_code)
                ->setValidationUrl($validation_url)
                ->setConfirmationUrl($confirmation_url)
                ->setToken($token)
                ->register($env);
       }catch(Exception $e){
           return $e->getMessage();

       }

       return $response;
    }   
}

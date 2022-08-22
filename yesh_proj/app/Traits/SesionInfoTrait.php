<?php
namespace App\Traits;

use Auth;

/*
  funções que retorna informações sobre o guard implementado pela seção
  getSesionGuard() retorna o nome do guarde ulilizado
  islogged() verifica se o usuario está logado
*/
trait SesionInfoTrait
{
   function getSesionGuard(){
      $guard = "";
      if(Auth::guard("employee")->check()){
         $guard =  "employee";
      }elseif(Auth::check()){
         $guard =  "web";
      } 
      return $guard;
   }

   function islogged(){
      $logged = false;
      if(Auth::guard("employee")->check()){
         $logged =  true;
      }elseif(Auth::check()){
         $logged =  true;
      }
      return $logged;
   }

   function getModelName(){
      $formName = "user";
      if(Auth::guard("employee")->check()){
         $formName =  "employee";
      }elseif(Auth::check()){
         $logged =  "user";
      }
      //dd($formName);
      return $formName;
   }

   function isUserADM(){
      $adm = false; 
      if(Auth::guard("employee")->check()){
         if(Auth::guard('employee')->user()->adm){
            $adm = true;
         }
      }elseif(Auth::check()){
         $adm = true;
      }
      //dd($adm,Auth::guard("employee")->check(),Auth::check());
      return $adm;
   }
   
}
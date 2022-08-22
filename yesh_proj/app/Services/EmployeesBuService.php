<?php
namespace App\Services;

use App\Models\EmployeesBu;

class EmployeesBuService{
    function getlista(){
        $bus = EmployeesBu::get();
        return $bus;
    }

    function paginate(){
        $bus = EmployeesBu::paginate();
        return $bus;
    }

    function getModel(){
        $bus = new EmployeesBu();
        return $bus;
    }
}
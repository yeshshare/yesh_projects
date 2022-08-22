<?php
namespace App\Services;

use App\Models\EmployeesOffice;

class EmployeesOfficeService{
    
    function getlista(){
        $offices = EmployeesOffice::get();
        return $offices;
    }

    function paginate(){
        $offices = EmployeesOffice::paginate();
        return $offices;
    }

    function getModel(){
        $offices = new EmployeesOffice();
        return $offices;
    }
}
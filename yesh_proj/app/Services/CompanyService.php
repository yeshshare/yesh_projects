<?php
namespace App\Services;

use App\Models\Company;

class CompanyService{
    function getlista(){
        $companies = Company::get();
        return $companies;
    }
    
    function paginate(){
        $companies = Company::paginate();
        return $companies;
    }

    function getModel(){
        $companies = new Company();
        return $companies;
    }
}
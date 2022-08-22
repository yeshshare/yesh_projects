<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Traits\SesionInfoTrait;
use App\Services\CompanyService;
use App\Services\EmployeesBuService;
use App\Services\EmployeesOfficeService;

class HomeController extends Controller
{
    use SesionInfoTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd("teste home",Auth::check('employee'));
        $variaveis = ['currentcompany','companiesList'];
        $companyService = new CompanyService();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');
            $employeesBu = new EmployeesBuService();
            $employeesOffice = new EmployeesOfficeService();
            $bus = $employeesBu->getlista();
            $offices = $employeesOffice->getlista();
        }
        //dd($companiesList);
        return view('home',compact($variaveis));
    }
}

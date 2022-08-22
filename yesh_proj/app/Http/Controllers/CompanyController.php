<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Traits\SesionInfoTrait;
use App\Services\CompanyService;
use App\Services\EmployeesBuService;
use App\Services\EmployeesOfficeService;
/**
 * Class CompanyController
 * @package App\Http\Controllers
 */

class CompanyController extends Controller
{
    use SesionInfoTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index()
    {
        //$middleware = $this->getMiddleware();
        //dd($middleware);
        $variaveis = ['companies','company','companiesList'];
        $companyService = new CompanyService();
        $companies = $companyService->paginate();
        $company = $companyService->getModel();
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');
            $employeesBuService = new EmployeesBuService();
            $employeesOfficeService = new EmployeesOfficeService();
            $bus = $employeesBuService->getlista();
            $offices = $employeesOfficeService->getlista();
        }
        return view('company.index', compact($variaveis))->with('i', (request()->input('page', 1) - 1) * $companies->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        return view('company.create', compact('company'));
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data,$create)
    {
        //dd($data);
        if($create){
            return Validator::make($data, [
                "razao" => ['required', 'string', 'max:255'],
                "fantasia" => ['required', 'string', 'max:255'],
                "cnpj" => ['required', 'string', 'max:255', 'unique:companies'],
                "contato"=> ['required', 'string', 'max:255'],
                "email"=> ['required', 'string', 'max:255']
            ]);
        }else{
            return Validator::make($data, [
                "razao" => ['required', 'string', 'max:255'],
                "fantasia" => ['required', 'string', 'max:255'],
                "cnpj" => ['required', 'string', 'max:255'],
                "contato"=> ['required', 'string', 'max:255'],
                "email"=> ['required', 'string', 'max:255']
            ]);
        }
    }

    
    
    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $img =  $request->hasfile('img') ? $request->file('img') : "";
		$validator = $this->validator($data,true);
        if ($validator->fails()) {
            $company = new Company();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        Company::create($this->get_Data($data,$img));
        toastr()->success('Company created successfully.','Success');
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $company = new Company();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        Company::where('id', $company->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('Company updated successfully.','Success');
        return redirect()->route('companies.index');
        //->with('success', 'Company updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $company = Company::find($id)->delete();
        toastr()->success('Company deleted successfully.','Success');
        return redirect()->route('companies.index');
        // ->with('success', 'Company deleted successfully');
    }

    /**
    * @param array $data
    * @param array $img
    * @return array
    * Recebe um array de dados e uma psedo image
    * e retrona um arrray com os campos que serão gravado no banco.
    * possui um array contedos valores padrões que não seram gravado 
    * no banco e não seram inclusos no array de retorno 
    */
    public function get_Data($data,$img) {
        $exceptions = ["_token", "_method","password_confirmation","id"]; 
        $temp_data =[];
        foreach($data as $key => $val){
            if(!in_array($key,$exceptions)){
                if($key == "img"){
                    $temp_data[$key] = base64_encode(file_get_contents($img));
                }elseif($key == "password"){
                    $temp_data[$key] = Hash::make($val) ;
                }else{
                    $temp_data[$key] = $val;
                }
            }
        }
        return $temp_data;
    }
    
}

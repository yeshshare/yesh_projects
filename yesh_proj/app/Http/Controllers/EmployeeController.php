<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\Employee;
use App\Models\EmployeesBu;
use App\Models\EmployeesOffice;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\SessionGuard;
use Session;
use App\Traits\SesionInfoTrait;
use App\Services\CompanyService;
use App\Services\EmployeesBuService;
use App\Services\EmployeesOfficeService;
/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */

class EmployeeController extends Controller
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
        $variaveis = ['employees','employee','currentcompany','companiesList','bus','offices'];
        $companyService = new CompanyService();
        $employeesBuService = new EmployeesBuService();
        $employeesOfficeService = new EmployeesOfficeService();
        $employees = Employee::paginate();
        $employee = new Employee();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companiesList = $companyService->getlista();
        $bus = $employeesBuService->getlista();
        $offices = $employeesOfficeService->getlista();
        return view('employee.index', compact($variaveis))->with('i', (request()->input('page', 1) - 1) * $employees->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new Employee();
        return view('employee.create', compact('employee'));
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data,$create)
    {
        $origem = $data['_origem'] ?? "";
        if($create){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:7', 'confirmed'],
            ]);
        }else{
            if($origem == "profile"){
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],                    
                ]);
            }elseif($origem == "password"){
                return Validator::make($data, [
                    'password' => ['required', 'string', 'min:7', 'confirmed'],
                ]);
            }else{
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'password' => ['required', 'string', 'min:7', 'confirmed'],
                ]);
            }   
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
            $employee = new Employee();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        Employee::create($this->get_Data($data,$img));
        toastr()->success('Employee created successfully.','Success');
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $employee = new Employee();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        Employee::where('id', $employee->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('Employee updated successfully.','Success');
        $NameRedirect = $this-> isUserADM() ? 'employees.index': 'home_staff';
        return redirect()->route($NameRedirect);
        //->with('success', 'Employee updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = Employee::find($id)->delete();
        toastr()->success('Employee deleted successfully.','Success');
        return redirect()->route('employees.index');
        // ->with('success', 'Employee deleted successfully');
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
        $exceptions = ["_token", "_method","password_confirmation","id","_origem","password_old"]; 
        $temp_data =[];
        $temp_data["adm"] = 0;
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
    
    public function login(){
        return view('employee.login');
    }

    public function doLogin(Request $request) {
        $password = Hash::make($request->password);
        $employees = Employee
        ::where('email', $request->email)
        ->where('password' , $request->password)->first();
        //dd($employees,$request->email,$request->password);
        if(Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
          //dd(Auth::guard('employee'),"Achou");
          return redirect()->route('home_staff');
        }else{
          //    dd($request, Auth::guard('employee'),"Não achou",$request->email,$request->password,$employees);
        }
        
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function home()
    {
        
        //dd(Auth::guard('employee'));
        $variaveis = ['companiesList'];
        $companyService = new CompanyService();
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');
            $employeesBu = new EmployeesBuService();
            $employeesOffice = new EmployeesOfficeService();
            $bus = $employeesBu->getlista();
            $offices = $employeesOffice->getlista();
        }
        //dd($variaveis);
        return view('home',compact($variaveis));
    }


}

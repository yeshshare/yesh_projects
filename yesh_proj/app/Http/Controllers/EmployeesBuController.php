<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\EmployeesBu;
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
 * Class EmployeesBuController
 * @package App\Http\Controllers
 */

class EmployeesBuController extends Controller
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
        $variaveis = ['employeesBus', 'employeesBu','companiesList','currentcompany'];
        $employeesBuService = new EmployeesBuService();
        $employeesBus = $employeesBuService->paginate();
        $employeesBu = $employeesBuService->getModel();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companyService = new CompanyService();
        $companiesList = $companyService->paginate();
        $company = $companyService->getModel();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');            
            $employeesOfficeService = new EmployeesOfficeService();
            $bus = $employeesBuService->getlista();
            $offices = $employeesOfficeService->getlista();
        }
        return view('employeesBu.index', compact($variaveis))->with('i', (request()->input('page', 1) - 1) * $employeesBus->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employeesBu = new EmployeesBu();
        return view('employeesBu.create', compact('employeesBu'));
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
                'name' => ['required', 'string', 'max:255'],
                'company_id' => ['required', 'string'],                
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'company_id' => ['required', 'string'],                
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
            $employeesBu = new EmployeesBu();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        EmployeesBu::create($this->get_Data($data,$img));
        toastr()->success('EmployeesBu created successfully.','Success');
        return redirect()->route('employeesBus.index')->with('success', 'EmployeesBu created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeesBu = EmployeesBu::find($id);
        return view('employeesBu.show', compact('employeesBu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employeesBu = EmployeesBu::find($id);
        return view('employeesBu.edit', compact('employeesBu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EmployeesBu $employeesBu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeesBu $employeesBu)
    {
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $employeesBu = new EmployeesBu();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        EmployeesBu::where('id', $employeesBu->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('EmployeesBu updated successfully.','Success');
        return redirect()->route('employeesBus.index');
        //->with('success', 'EmployeesBu updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employeesBu = EmployeesBu::find($id)->delete();
        toastr()->success('EmployeesBu deleted successfully.','Success');
        return redirect()->route('employeesBus.index');
        // ->with('success', 'EmployeesBu deleted successfully');
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
        $temp_data =[];
        foreach($data as $key => $val){
            if($key != "_token" && $key != "_method" && $key != "password_confirmation" && $key != "id"){
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

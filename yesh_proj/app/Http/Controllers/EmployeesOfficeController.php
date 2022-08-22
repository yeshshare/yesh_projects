<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\EmployeesOffice;
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
 * Class EmployeesOfficeController
 * @package App\Http\Controllers
 */

class EmployeesOfficeController extends Controller
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
        $variaveis = ['employeesOffices','employeesOffice','currentcompany','companiesList'];
        $employeesOfficeService = new EmployeesOfficeService();
        $employeesOffices = $employeesOfficeService->paginate();
        $employeesOffice = $employeesOfficeService->getModel();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companyService = new CompanyService();
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');
            $employeesBu = new EmployeesBuService();
            $bus = $employeesBu->getlista();
            $offices = $employeesOfficeService->getlista();
        }
        return view('employeesOffice.index', compact($variaveis))->with('i', (request()->input('page', 1) - 1) * $employeesOffices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employeesOffice = new EmployeesOffice();
        return view('employeesOffice.create', compact('employeesOffice'));
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
            $employeesOffice = new EmployeesOffice();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        EmployeesOffice::create($this->get_Data($data,$img));
        toastr()->success('EmployeesOffice created successfully.','Success');
        return redirect()->route('employeesOffices.index')->with('success', 'EmployeesOffice created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeesOffice = EmployeesOffice::find($id);
        return view('employeesOffice.show', compact('employeesOffice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employeesOffice = EmployeesOffice::find($id);
        return view('employeesOffice.edit', compact('employeesOffice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EmployeesOffice $employeesOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeesOffice $employeesOffice)
    {
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $employeesOffice = new EmployeesOffice();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        EmployeesOffice::where('id', $employeesOffice->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('EmployeesOffice updated successfully.','Success');
        return redirect()->route('employeesOffices.index');
        //->with('success', 'EmployeesOffice updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employeesOffice = EmployeesOffice::find($id)->delete();
        toastr()->success('EmployeesOffice deleted successfully.','Success');
        return redirect()->route('employeesOffices.index');
        // ->with('success', 'EmployeesOffice deleted successfully');
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

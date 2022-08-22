<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\SesionInfoTrait;
use App\Services\CompanyService;
use App\Services\EmployeesBuService;
use App\Services\EmployeesOfficeService;
use Session;
/**
 * Class UserController
 * @package App\Http\Controllers
 */

class UserController extends Controller
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
        $variaveis = ['users','user','currentcompany','companiesList'];
        $users = User::paginate();
        $user = new User();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companyService = new CompanyService();
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variaveis, 'bus');
            array_push($variaveis, 'offices');
            $employeesBuService = new EmployeesBuService();
            $employeesOfficeService = new EmployeesOfficeService();
            $bus = $employeesBuService->getlista();
            $offices = $employeesOfficeService->getlista();
        }                
        return view('user.index', compact($variaveis))->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
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
            $user = new User();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        User::create($this->get_Data($data,$img));
        toastr()->success('User created successfully.','Success');
        return redirect()->route('users.index')->with('success', 'User created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $data = $request->all();
		$origem =  $data['_origem'] ?? ""; 
        
        $img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $user = new User();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        User::where('id', $user->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('User updated successfully.','Success');
        if($origem != ""){
           return back();
        }else{
           return redirect()->route('users.index');
        } 
        
        //->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        toastr()->success('User deleted successfully.','Success');
        return redirect()->route('users.index');
        // ->with('success', 'User deleted successfully');
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
        $exceptions = ["_token", "_method","password_confirmation","id","_origem","password_old"]; 
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

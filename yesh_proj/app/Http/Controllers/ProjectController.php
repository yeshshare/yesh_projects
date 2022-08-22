<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Traits\SesionInfoTrait;
use App\Services\CompanyService;
use App\Services\EmployeesBuService;
use App\Services\EmployeesOfficeService;
/**
 * Class ProjectController
 * @package App\Http\Controllers
 */

class ProjectController extends Controller
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
        $variables = ['projects','project','currentcompany','companiesList','usersList'];
        $projectList = Project::paginate();
        $project = new Project();     
        $currentcompany = auth()->user()->company_id ?? 0;
        $companyService = new CompanyService();
        $companiesList = $companyService->getlista();
        $users = User::get();
        $usersList = [];
        $projects = [];
        foreach($users as $user ){
            array_push($usersList,json_encode((array) $user->getAttributes()));
        }
        foreach($projectList as $p ){
            $p->employees =  $p->projectEmployees()
                ->join("employees","project_employees.employees_id","employees.id")             
                ->where("project_employees.project_id",$p->id)
                ->get();
            array_push($projects,json_encode((array) $p->getAttributes()));
        }
       
        //dd($projectList);
        //$usersList = json_encode($usersList);
        //dd( json_encode($usersList));
        if($this->getSesionGuard()== "employee"){
            array_push($variables, 'bus');
            array_push($variables, 'offices');
            $employeesBuService = new EmployeesBuService();
            $employeesOfficeService = new EmployeesOfficeService();
            $bus = $employeesBuService->getlista();
            $offices = $employeesOfficeService->getlista();
        }     
        return view('project.index', compact($variables))->with('i', (request()->input('page', 1) - 1) * $projectList->perPage());
    }


    public function getList()
    {
        //dd("teste");
        $projects = Project::get();
        return response()->json($projects);
    }
    
    public function getProject($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        dd("teste");
        return view('project.create', compact('project'));
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:projects'],
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
            $project = new Project();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        Project::create($this->get_Data($data,$img));
        toastr()->success('Project created successfully.','Success');
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $variables = ['project','currentcompany','companiesList','user'];
        $userSesion = (array) Auth::guard($this->getSesionGuard())->user();
        $user = null;
        foreach($userSesion as $key => $selected){
            $user = json_encode( (array) $selected);
        }
        $project = Project::find($id);  
        $projectList = Project::paginate();
        $currentcompany = auth()->user()->company_id ?? 0;
        $companyService = new CompanyService();
        $companiesList = $companyService->getlista();
        if($this->getSesionGuard()== "employee"){
            array_push($variables, 'bus');
            array_push($variables, 'offices');
            $employeesBuService = new EmployeesBuService();
            $employeesOfficeService = new EmployeesOfficeService();
            $bus = $employeesBuService->getlista();
            $offices = $employeesOfficeService->getlista();
        }     
        return view('project.show', compact($variables));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        dd("teste");
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //dd($request,$project);
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        /*
        if ($validator->fails()) {
            $project = new Project();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        */
        $update = [];
        //dd($data["project"]);
        Project::where('id', $project->id)
        ->update($this->get_Data($data["project"],$img));
        $retorno = array(
            "status" => true,
            "message" => "Projct updated with sucess"
        );
        return response()->json($retorno);       
        //toastr()->success('Project updated successfully.','Success');
        //return redirect()->route('projects.index');
        //->with('success', 'Project updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = Project::find($id)->delete();
        toastr()->success('Project deleted successfully.','Success');
        return redirect()->route('projects.index');
        // ->with('success', 'Project deleted successfully');
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

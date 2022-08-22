<?php

namespace App\Http\Controllers;  

use Auth;
use App\Models\StatusProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
/**
 * Class StatusProjectController
 * @package App\Http\Controllers
 */

class StatusProjectController extends Controller
{
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
        $statusProjects = StatusProject::paginate();
        $statusProject = new StatusProject();
        return view('statusProject.index', compact('statusProjects', 'statusProject'))->with('i', (request()->input('page', 1) - 1) * $statusProjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusProject = new StatusProject();
        return view('statusProject.create', compact('statusProject'));
    }
    
    public function getList($project_id)
    {
        $datas = [];
        $statusProjects = StatusProject
        ::where('project_id',$project_id)
        ->select(
            'status_projects.id',
            'status_projects.company_id',
            'status_projects.employee_id',
            'status_projects.status',
            'status_projects.description',
            DB::raw('DATE_FORMAT(status_projects.created_at,"%Y-%m-%d") as data')
        )
        ->orderBy('created_at', 'DESC')
        ->get();
        $data = [];
        $iten = [];
        $currentValueDate = $statusProjects[0]->data;
        foreach ($statusProjects as $key => $status) {
            if($currentValueDate == $status->data){
                array_push($iten,$status);
            }else{
                array_push($data,[$currentValueDate,$iten]);
                $iten = [];
                $currentValueDate = $status->data;
                array_push($iten,$status);
            }
              
        } 
        array_push($data,[$currentValueDate,$iten]);
        return response()->json($data);
    }
    
    public function getProject($id)
    {
        $statusProject = StatusProject::find($id);
        return response()->json($statusProject);
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:statusProjects'],
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
        //dd("store",$request);
        $data = $request->all();
        $img =  $request->hasfile('img') ? $request->file('img') : "";
		/*
        $validator = $this->validator($data,true);
        if ($validator->fails()) {
            $statusProject = new StatusProject();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();*/
        StatusProject::create($this->get_Data($data,$img));
        $retorno = array(
            "status" => true,
            "message" => "Status of projct updated with sucess"
        );
        return response()->json($retorno);  
        //toastr()->success('StatusProject created successfully.','Success');
        //return redirect()->route('statusProjects.index')->with('success', 'StatusProject created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statusProject = StatusProject::find($id);
        return view('statusProject.show', compact('statusProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statusProject = StatusProject::find($id);
        return view('statusProject.edit', compact('statusProject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  StatusProject $statusProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusProject $statusProject)
    {
        dd("update", $request);
        $data = $request->all();
		$img =  $request->hasfile('img') ? $request->file('img') : "";
        $validator = $this->validator($data,false);
        if ($validator->fails()) {
            $statusProject = new StatusProject();
            $errors = $validator->errors();
            foreach($errors->messages() as $key => $error ){
                toastr()->error($error[0],'Error');
            }
        }
        $validator->validate();
        $update = [];
        StatusProject::where('id', $statusProject->id)
        ->update($this->get_Data($data,$img));
        toastr()->success('StatusProject updated successfully.','Success');
        return redirect()->route('statusProjects.index');
        //->with('success', 'StatusProject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $statusProject = StatusProject::find($id)->delete();
        toastr()->success('StatusProject deleted successfully.','Success');
        return redirect()->route('statusProjects.index');
        // ->with('success', 'StatusProject deleted successfully');
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

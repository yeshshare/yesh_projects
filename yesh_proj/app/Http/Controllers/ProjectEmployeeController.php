<?php

namespace App\Http\Controllers;

use App\Models\ProjectEmployee;
use Illuminate\Http\Request;

/**
 * Class ProjectEmployeeController
 * @package App\Http\Controllers
 */
class ProjectEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectEmployees = ProjectEmployee::paginate();

        return view('project-employee.index', compact('projectEmployees'))
            ->with('i', (request()->input('page', 1) - 1) * $projectEmployees->perPage());
    }


    public function getList($project_id)
    {
        //dd("teste");
        $projectEmployees = ProjectEmployee
        ::join("employees","project_employees.employees_id","employees.id")
        ->where('project_id',$project_id)
        ->select(
            'employees.id', 
            'employees.company_id', 
            'employees.name', 
            'employees.email', 
            'employees.telefone', 
            'employees.vinculo', 
            'employees.endereco',
            'employees.img'
        )
        ->get();
        return response()->json($projectEmployees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectEmployee = new ProjectEmployee();
        return view('project-employee.create', compact('projectEmployee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProjectEmployee::$rules);

        $projectEmployee = ProjectEmployee::create($request->all());

        return redirect()->route('project-employees.index')
            ->with('success', 'ProjectEmployee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectEmployee = ProjectEmployee::find($id);

        return view('project-employee.show', compact('projectEmployee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectEmployee = ProjectEmployee::find($id);

        return view('project-employee.edit', compact('projectEmployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectEmployee $projectEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectEmployee $projectEmployee)
    {
        request()->validate(ProjectEmployee::$rules);

        $projectEmployee->update($request->all());

        return redirect()->route('project-employees.index')
            ->with('success', 'ProjectEmployee updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectEmployee = ProjectEmployee::find($id)->delete();

        return redirect()->route('project-employees.index')
            ->with('success', 'ProjectEmployee deleted successfully');
    }
}

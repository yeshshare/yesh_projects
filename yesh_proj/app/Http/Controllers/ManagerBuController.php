<?php

namespace App\Http\Controllers;

use App\Models\ManagerBu;
use Illuminate\Http\Request;

/**
 * Class ManagerBuController
 * @package App\Http\Controllers
 */
class ManagerBuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managerBus = ManagerBu::paginate();

        return view('manager-bu.index', compact('managerBus'))
            ->with('i', (request()->input('page', 1) - 1) * $managerBus->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managerBu = new ManagerBu();
        return view('manager-bu.create', compact('managerBu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ManagerBu::$rules);

        $managerBu = ManagerBu::create($request->all());

        return redirect()->route('manager-bus.index')
            ->with('success', 'ManagerBu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $managerBu = ManagerBu::find($id);

        return view('manager-bu.show', compact('managerBu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $managerBu = ManagerBu::find($id);

        return view('manager-bu.edit', compact('managerBu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ManagerBu $managerBu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagerBu $managerBu)
    {
        request()->validate(ManagerBu::$rules);

        $managerBu->update($request->all());

        return redirect()->route('manager-bus.index')
            ->with('success', 'ManagerBu updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $managerBu = ManagerBu::find($id)->delete();

        return redirect()->route('manager-bus.index')
            ->with('success', 'ManagerBu deleted successfully');
    }
}

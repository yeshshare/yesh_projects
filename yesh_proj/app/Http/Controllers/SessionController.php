<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

/**
 * Class SessionController
 * @package App\Http\Controllers
 */
class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::paginate();

        return view('session.index', compact('sessions'))
            ->with('i', (request()->input('page', 1) - 1) * $sessions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = new Session();
        return view('session.create', compact('session'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Session::$rules);

        $session = Session::create($request->all());

        return redirect()->route('sessions.index')
            ->with('success', 'Session created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::find($id);

        return view('session.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::find($id);

        return view('session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        request()->validate(Session::$rules);

        $session->update($request->all());

        return redirect()->route('sessions.index')
            ->with('success', 'Session updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $session = Session::find($id)->delete();

        return redirect()->route('sessions.index')
            ->with('success', 'Session deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Core\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    private $teamService;

    /**
     * Create a new controller instance.
     * @param TeamService $teamService
     */
    public function __construct(TeamService $teamService)
    {
        $this->middleware('auth');
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the team.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = $this->teamService->listTeams();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created team in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->only(['name']);

        // Create team
        $team = $this->teamService->createTeam($data);

        Session::flash('message', 'Successfully created the team!');

        return redirect(route('team.index'));
    }

    /**
     * Get a validator for an incoming creation request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:teams',
        ]);
    }


    /**
     * Display the specified team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = $this->teamService->findTeams($id);

        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified team in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->editValidator($id, $request->all())->validate();

        $data = $request->only(['name']);

        $this->teamService->updateTeam($id, $data);

        Session::flash('message', 'Successfully updated the team!');

        return redirect(route('team.index'));
    }


    /**
     * Get a validator for an incoming update team request.
     *
     * @param $id
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     * @internal param $email
     */
    protected function editValidator($id, array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:teams,name,' . $id,
        ]);
    }

    /**
     * Remove the specified team from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $this->teamService->deleteTeams($id);

        // redirect
        Session::flash('message', 'Successfully deleted the team!');
        return redirect(route('team.index'));
    }
}

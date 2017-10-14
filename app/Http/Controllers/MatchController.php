<?php

namespace App\Http\Controllers;

use Core\Services\CommentService;
use Core\Services\TeamService;
use Illuminate\Http\Request;
use Core\Services\MatchService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    /**
     * @var MatchService
     */
    private $matchService;
    private $teamService;
    private $commentService;

    /**
     * Create a new controller instance.
     * @param MatchService $matchService
     * @param TeamService $teamService
     * @param CommentService $commentService
     */
    public function __construct(MatchService $matchService, TeamService $teamService, CommentService $commentService)
    {
        $this->middleware('auth');
        $this->matchService = $matchService;
        $this->teamService = $teamService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the matches.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = $this->matchService->listMatches();

        return view('matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new match.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all teams without pagination
        $teams = $this->teamService->listAllTeams();

        return view('matches.create', compact('teams'));
    }

    /**
     * Store a newly created match in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->only(['first_team', 'second_team']);

        // Create team
        $team = $this->matchService->createMatch($data);

        Session::flash('message', 'Successfully created the match!');

        return redirect(route('match.index'));
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
            'first_team' => 'required|not_in:null',
            'second_team' => 'required|not_in:null|different:first_team',
        ]);
    }

    /**
     * Display the specified match.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = $this->matchService->viewMatch($id);
        $commentTypes = $this->matchService->getCommentTypes();
        $comments = $this->commentService->getCommentsForMatch($id);

        return view('matches.show', compact('match', 'commentTypes', 'comments'));
    }

    /**
     * Show the form for editing the specified match.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams = $this->teamService->listAllTeams();
        $match = $this->matchService->findMatch($id);

        return view('matches.edit', compact('teams', 'match'));
    }

    /**
     * Update the specified match in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();

        $data = $request->only(['first_team', 'second_team']);

        $this->matchService->updateMatch($id, $data);

        Session::flash('message', 'Successfully updated the match!');

        return redirect(route('match.index'));
    }

    /**
     * Remove the specified match from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $this->matchService->deleteMatches($id);

        // redirect
        Session::flash('message', 'Successfully deleted the match!');
        return redirect(route('match.index'));
    }
}

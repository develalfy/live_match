<?php

namespace App\Http\Controllers;

use App\Events\CommentInserted;
use Core\Services\CommentService;
use Core\Services\MatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    private $matchService;
    private $commentService;

    /**
     * CommentController constructor.
     * @param $matchService
     * @param $commentService
     */
    public function __construct(MatchService $matchService, CommentService $commentService)
    {
        $this->matchService = $matchService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param $matchId
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($matchId, Request $request)
    {
        // validate data
        $this->validator($request->all())->validate();

        // insert new comment
        if ($request->get('type')) {
            $commentData = Input::only(['type', 'desc']);
            $matchComment = $this->commentService->addComment($matchId, $commentData);
        }

        // update match result
        $matchData = Input::only(['first_team_score', 'second_team_score']);
        $this->matchService->updateMatchScore($matchId, $matchData);

        if (isset($matchComment)) {
            $liveData = [
                'type' => $matchComment->type,
                'desc' => $matchComment->desc
            ];
            // push to live users
            $liveData['first_team_score'] = $matchData['first_team_score'];
            $liveData['second_team_score'] = $matchData['second_team_score'];
            event(new CommentInserted($liveData));
        }


        return redirect()->back();
    }

    /**
     * Get a validator for an incoming update team request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     * @internal param $email
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_team_score' => 'required|min:0',
            'second_team_score' => 'required|min:0',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

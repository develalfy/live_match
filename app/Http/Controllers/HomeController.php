<?php

namespace App\Http\Controllers;

use Core\Services\CommentService;
use Core\Services\MatchService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $matchService;
    private $commentService;

    /**
     * HomeController constructor.
     * @param MatchService $matchService
     * @param CommentService $commentService
     */
    public function __construct(MatchService $matchService, CommentService $commentService)
    {
        $this->matchService = $matchService;
        $this->commentService = $commentService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = $this->matchService->listMatches();

        return view('matches', compact('matches'));
    }

    /**
     * Show single match.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = $this->matchService->viewMatch($id);
        $commentTypes = $this->matchService->getCommentTypes();
        $comments = $this->commentService->getCommentsForMatch($id);

        return view('view_match', compact('match', 'commentTypes', 'comments'));
    }
}

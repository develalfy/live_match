<?php

namespace Core\Repositories;

use App\Comment;
use Core\Interfaces\IComment;

/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:21 PM
 */
class CommentRepository implements IComment
{
    public function addComment($matchId, $commentData)
    {
        $comment = Comment::create([
            'type' => $commentData['type'],
            'desc' => $commentData['desc'],
            'match_id' => $matchId,
        ]);

        return $comment;
    }

    public function getCommentsForMatch($id)
    {
        $comments = Comment::where('match_id', $id)->get();

        return $comments;
    }
}
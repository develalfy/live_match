<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:17 PM
 */

namespace Core\Services;

use Core\Interfaces\IComment;

class CommentService
{
    private $comment;

    /**
     * TeamService constructor.
     * @param $comment
     */
    public function __construct(IComment $comment)
    {
        $this->comment = $comment;
    }

    public function addComment($matchId, $commentData)
    {
        $comment = $this->comment->addComment($matchId, $commentData);

        return $comment;
    }

    public function getCommentsForMatch($id)
    {
        $comments = $this->comment->getCommentsForMatch($id);

        return $comments;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:22 PM
 */

namespace Core\Interfaces;

interface IComment
{
    public function addComment($matchId, $commentData);

    public function getCommentsForMatch($id);
}
<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/14/17
 * Time: 12:31 PM
 */

namespace Core\Services;


use Core\Interfaces\IMatch;

class MatchService
{
    private $match;

    /**
     * MatchService constructor.
     * @param $match
     */
    public function __construct(IMatch $match)
    {
        $this->match = $match;
    }

    /**
     * Return all matches
     * @return mixed
     */
    public function listMatches()
    {
        $matches = $this->match->listMatches();

        return $matches;
    }

    public function createMatch($data)
    {
        $match = $this->match->createMatch($data);

        return $match;
    }

    public function findMatch($id)
    {
        $match = $this->match->findMatch($id);

        return $match;
    }

    public function viewMatch($id)
    {
        $match = $this->match->viewMatch($id);

        return $match;
    }

    public function updateMatch($id, $data)
    {
        $match = $this->match->updateMatch($id, $data);

        return $match;
    }

    public function deleteMatches($id)
    {
        $match = $this->match->deleteMatch($id);

        return $match;
    }

    public function getCommentTypes()
    {
        $types = $this->match->getCommentTypes();

        return $types;
    }

    public function updateMatchScore($matchId, $matchData)
    {
        $matchScore = $this->match->updateMatchScore($matchId, $matchData);

        return $matchScore;
    }
}
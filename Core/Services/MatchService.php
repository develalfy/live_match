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
        $team = $this->match->findMatch($id);

        return $team;
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
}
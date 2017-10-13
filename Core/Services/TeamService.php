<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:17 PM
 */

namespace Core\Services;

use Core\Interfaces\ITeam;

class TeamService
{
    private $moderator;

    /**
     * TeamService constructor.
     * @param $moderator
     */
    public function __construct(ITeam $moderator)
    {
        $this->moderator = $moderator;
    }

    /**
     * Return all moderators
     * @return mixed
     */
    public function listTeams()
    {
        $moderators = $this->moderator->listTeams();

        return $moderators;
    }

    public function createTeam($data)
    {
        $moderator = $this->moderator->createTeam($data);

        return $moderator;
    }

    public function findTeams($id)
    {
        $team = $this->moderator->findTeam($id);

        return $team;
    }

    public function updateTeam($id, $data)
    {
        $moderator = $this->moderator->updateTeam($id, $data);

        return $moderator;
    }

    public function deleteTeams($id)
    {
        $moderator = $this->moderator->deleteTeam($id);

        return $moderator;
    }
}
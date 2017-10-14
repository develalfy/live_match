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
    private $team;

    /**
     * TeamService constructor.
     * @param $team
     */
    public function __construct(ITeam $team)
    {
        $this->team = $team;
    }

    /**
     * Return all teams paginated
     * @return mixed
     */
    public function listTeams()
    {
        $teams = $this->team->listTeams();

        return $teams;
    }
    /**
     * Return all teams without pagination
     * @return mixed
     */
    public function listAllTeams()
    {
        $teams = $this->team->listAllTeams();

        return $teams;
    }

    public function createTeam($data)
    {
        $team = $this->team->createTeam($data);

        return $team;
    }

    public function findTeams($id)
    {
        $team = $this->team->findTeam($id);

        return $team;
    }

    public function updateTeam($id, $data)
    {
        $team = $this->team->updateTeam($id, $data);

        return $team;
    }

    public function deleteTeams($id)
    {
        $team = $this->team->deleteTeam($id);

        return $team;
    }
}
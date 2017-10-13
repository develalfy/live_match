<?php

namespace Core\Repositories;

use App\Team;
use Core\Interfaces\ITeam;

/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:21 PM
 */

class TeamRepository implements ITeam
{

    public function listTeams()
    {
        $teams = Team::paginate(10);

        return $teams;
    }

    /**
     * Create new team
     * @param $data
     * @return static
     */
    public function createTeam($data)
    {
        $team = Team::create([
            'name' => $data['name'],
        ]);

        return $team;
    }

    public function findTeam($id)
    {
        $team = Team::find($id);

        return $team;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateTeam($id, $data)
    {
        $team = Team::find($id);

        foreach ($data as $key => $element) {
            $team->$key = $element;
        }

        $team->save();

        return $team;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTeam($id)
    {
        $team = Team::find($id);
        $team->delete();

        return $team;
    }
}
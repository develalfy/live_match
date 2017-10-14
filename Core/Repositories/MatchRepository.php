<?php

namespace Core\Repositories;

use App\Match;
use Core\Interfaces\IMatch;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:21 PM
 */
class MatchRepository implements IMatch
{

    /**
     * Get matches with teams' name
     *
     * @return mixed
     */
    public function listMatches()
    {
        $teams = DB::table('matches')
            ->leftJoin('teams as first', 'matches.first_team_id', '=', 'first.id')
            ->leftJoin('teams as second', 'matches.second_team_id', '=', 'second.id')
            ->select([
                'matches.id',
                'first.name as first_team',
                'second.name as second_team'
            ])
            ->paginate(10);

        return $teams;
    }

    /**
     * Create new team
     * @param $data
     * @return static
     */
    public function createMatch($data)
    {
        $team = Match::create([
            'first_team_id' => $data['first_team'],
            'second_team_id' => $data['second_team'],
        ]);

        return $team;
    }

    public function findMatch($id)
    {
        $team = Match::find($id);

        return $team;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateMatch($id, $data)
    {
        $team = Match::find($id);

        $team->first_team_id = $data['first_team'];
        $team->second_team_id = $data['second_team'];

        $team->save();

        return $team;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteMatch($id)
    {
        $team = Match::find($id);
        $team->delete();

        return $team;
    }
}
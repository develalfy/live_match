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

    /**
     * Get match basic details without names
     * @param $id
     * @return mixed
     */
    public function findMatch($id)
    {
        $team = Match::find($id);

        return $team;
    }

    /**
     * Get match details with names
     * @param $id
     */
    public function viewMatch($id)
    {
        $match = DB::table('matches')
            ->leftJoin('teams as first', 'matches.first_team_id', '=', 'first.id')
            ->leftJoin('teams as second', 'matches.second_team_id', '=', 'second.id')
            ->where('matches.id', '=', $id)
            ->first([
                'matches.id',
                'first.name as first_team',
                'second.name as second_team',
                'matches.first_team_score as first_team_score',
                'matches.second_team_score as second_team_score',
            ]);

        return $match;
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

    public function getCommentTypes()
    {
        // todo: CRUD for comment types
        $types = [
            'goal',
            '​​foul',
            '​​penalty',
            '​offside',
            '​​yellow​ ​card',
            '​red​ ​card',
            '​match​ ​beginning',
            '​match​ ​ended'
        ];

        return $types;
    }

    public function updateMatchScore($matchId, $matchData)
    {
        $match = Match::find($matchId);

        $match->first_team_score = $matchData['first_team_score'];
        $match->second_team_score = $matchData['second_team_score'];

        $match->save();
    }
}
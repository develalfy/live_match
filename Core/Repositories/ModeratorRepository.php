<?php

namespace Core\Repositories;

use App\User;
use Core\Interfaces\IModerator;

/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:21 PM
 */

class ModeratorRepository implements IModerator
{

    public function listModerators()
    {
        $moderators = User::where('admin', '=', 0)->paginate(10);

        return $moderators;
    }

    /**
     * Create new moderator
     * @param $data
     * @return static
     */
    public function createModerator($data)
    {
        $moderator = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $moderator;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateModerator($id, $data)
    {
        $moderator = User::find($id);

        foreach ($data as $key => $element) {
            $moderator->$key = $element;
        }

        $moderator->save();

        return $moderator;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteModerators($id)
    {
        $moderator = User::find($id);
        $moderator->delete();

        return $moderator;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:17 PM
 */

namespace Core\Services;

use Core\Interfaces\IModerator;

class ModeratorService
{
    private $moderator;

    /**
     * ModeratorService constructor.
     * @param $moderator
     */
    public function __construct(IModerator $moderator)
    {
        $this->moderator = $moderator;
    }

    /**
     * Return all moderators
     * @return mixed
     */
    public function listModerators()
    {
        $moderators = $this->moderator->listModerators();

        return $moderators;
    }

    public function createModerator($data)
    {
        $moderator = $this->moderator->createModerator($data);

        return $moderator;
    }


    public function findModerator($id)
    {
        $moderator = $this->moderator->findModerator($id);

        return $moderator;
    }

    public function updateModerator($id, $data)
    {
        $moderator = $this->moderator->updateModerator($id, $data);

        return $moderator;
    }
    public function deleteModerator($id)
    {
        $moderator = $this->moderator->deleteModerator($id);

        return $moderator;
    }
}
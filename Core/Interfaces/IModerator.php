<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:22 PM
 */

namespace Core\Interfaces;

interface IModerator
{
    public function listModerators();

    public function createModerator($data);

    public function updateModerator($id, $data);

    public function deleteModerator($id);

    public function findModerator($id);
}
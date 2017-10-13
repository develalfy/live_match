<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:22 PM
 */

namespace Core\Interfaces;

interface ITeam
{
    public function listTeams();

    public function createTeam($data);

    public function updateTeam($id, $data);

    public function deleteTeam($id);

    public function findTeam($id);
}
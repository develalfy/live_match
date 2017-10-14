<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 10/13/17
 * Time: 3:22 PM
 */

namespace Core\Interfaces;

interface IMatch
{
    public function listMatches();

    public function createMatch($data);

    public function updateMatch($id, $data);

    public function deleteMatch($id);

    public function findMatch($id);
}
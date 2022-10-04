<?php
namespace App\Repositories\Team;

use App\Repositories\RepositoryInterface;

interface TeamRepositoryInterface extends RepositoryInterface
{
    public function deleteTeam($id);
}

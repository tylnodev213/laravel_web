<?php

namespace App\Service\Team;


use App\Repositories\Employee\TeamRepositoryInterface;
use App\Service\BaseService;

class TeamService  extends BaseService implements  TeamServiceInterface
{
    public $repository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->repository = $teamRepository;
    }
}

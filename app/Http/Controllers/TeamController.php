<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Repositories\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Repositories\Team\TeamRepositoryInterface;

class TeamController extends Controller
{
    protected $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index(Request $request)
    {
        $teams = $this->teamRepository->show($request);

        return view('Team.index', ['teams' => $teams]);
    }

    public function create()
    {
        return view('Team.create');
    }

    public function create_confirm(Request $request)
    {
        $team = new Team($request->all());

        return view('Team.create_confirm', ['team'=>$team]);
    }

    public function store(Request $request)
    {
        $teams = $this->teamRepository->create($request);

        return redirect()->route('Team.search');
    }

    public function edit(Team $team)
    {
        return view('Team.edit', ['team' => $team]);
    }

    public function update(Request $request, $id)
    {
        $teams = $this->teamRepository->update($id, $request);

        return redirect()->route('Team.search');
    }

    public function edit_confirm(Request $request, Team $team)
    {
        $team_upd = new Team($request->all());

        return view('Team.edit_confirm', [
            'team_upd'=>$team_upd,
            'team' => $team
        ]);
    }

    public function destroy($id)
    {
        $this->teamRepository->softDelete($id);

        return redirect()->route('Team.search');
    }
}

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

    public function index()
    {
        $teams = $this->teamRepository->getAll();

        return view('Team.index', ['teams' => $teams]);
    }

    public function create()
    {
        return view('Team.create');
    }

    public function create_confirm(Request $request)
    {
        $name = $request->get('name');
        return view('Team.create_confirm', ['name'=>$name]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $teams = $this->teamRepository->create($data);

        return redirect()->route('Team.search');
    }

    public function edit(Team $team)
    {
        return view('Team.edit', ['team' => $team]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'save'
        ]);

        //... Validation here

        $teams = $this->teamRepository->update($id, $data);

        return redirect()->route('Team.search');
    }

    public function edit_confirm(Request $request, Team $team)
    {
        $name = $request->get('name');
        return view('Team.edit_confirm', ['name'=>$name, 'team'=>$team]);
    }

    public function destroy($id)
    {
        $this->teamRepository->delete($id);

        return redirect()->route('Team.search');
    }
}

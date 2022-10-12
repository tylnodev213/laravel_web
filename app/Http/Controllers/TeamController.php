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
        try{
            $teams = $this->teamRepository->create($request);
        }catch (Exception $e) {
            Log::info('Create team fail.', ['id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Team.search')->withError(config('constants.message_create_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful', config('constants.message_create_successful'));
    }

    public function edit(Team $team)
    {
        return view('Team.edit', ['team' => $team]);
    }

    public function edit_confirm(Request $request, Team $team)
    {
        $team_upd = new Team($request->all());

        return view('Team.edit_confirm', [
            'team_upd'=>$team_upd,
            'team' => $team
        ]);
    }

    public function update(Request $request, $id)
    {
        try{
            $teams = $this->teamRepository->update($id, $request);
        }catch (Exception $e) {
            Log::info('Update team fail.', ['id'=>$id,'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Team.search')->withError(config('constants.message_update_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful', config('constants.message_update_successful'));
    }

    public function destroy($id)
    {
        try{
            $teams = $this->teamRepository->softDelete($id);
        }catch (Exception $e) {
            Log::info('Delete team fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Team.search')->withError(config('constants.message_delete_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful',config('constants.message_delete_successful'));
    }
}

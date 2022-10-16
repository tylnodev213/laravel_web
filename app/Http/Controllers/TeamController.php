<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\DeleteRequest;
use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Models\Team;
use App\Repositories\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Repositories\Team\TeamRepositoryInterface;
use Illuminate\Support\Facades\Log;

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

    public function createConfirm(StoreRequest $request)
    {
        $data = $request->all();

        $team = new Team($data);

        return view('Team.create_confirm', ['team'=>$team]);
    }

    public function store(Request $request)
    {
        if($request->get('submit')== 'Back') {
            return redirect()->route('Team.create')->withInput($request->input());
        }

        try{
            $data = $request->all();

            $teams = $this->teamRepository->create($data);
        }catch (\Exception $e) {
            Log::error('Create team fail.', ['id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);

            return redirect()->route('Team.search')->withError(config('constants.message_create_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful', config('constants.message_create_successful'));
    }

    public function edit(Team $team)
    {
        return view('Team.edit', ['team' => $team]);
    }

    public function editConfirm(UpdateRequest $request, Team $team)
    {
        $data = $request->all();

        $team_upd = new Team($data);
        $team_upd->id = $team->id;

        return view('Team.edit_confirm', [
            'team_upd'=>$team_upd,
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if($request->get('submit')== 'Back') {
            return redirect()->route('Team.edit',$id)->withInput($request->input());
        }
        try{
            $data = $request->all();

            $teams = $this->teamRepository->update($id, $data);
        }catch (\Exception $e) {
            Log::error('Update team fail.', ['id'=>$id,'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);

            return redirect()->route('Team.search')->withError(config('constants.message_update_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful', config('constants.message_update_successful'));
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        try{
            $teams = $this->teamRepository->softDelete($id);
        }catch (\Exception $e) {
            Log::error('Delete team fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);

            return redirect()->route('Team.search')->withError(config('constants.message_delete_fail'));
        }

        return redirect()->route('Team.search')->with('message_successful',config('constants.message_delete_successful'));
    }
}

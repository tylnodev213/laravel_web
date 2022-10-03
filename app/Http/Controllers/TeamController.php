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
        dd("oke");
        $object = new Team();
        $object->fill($request->except('token'));
        $object->save();

        return redirect()->route('Team.search');
    }
}

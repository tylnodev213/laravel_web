<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Team\TeamRepositoryInterface;

class TeamController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\Repository
     */
    protected $teamRepo;

    public function __construct(TeamRepositoryInterface $teamRepo)
    {
        $this->teamRepo = $teamRepo;
    }

    public function index()
    {
        $products = $this->teamRepo->getAll();

        return view('home.products', ['products' => $products]);
    }

    public function show($id)
    {
        $product = $this->teamRepo->find($id);

        return view('home.product', ['product' => $product]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $product = $this->teamRepo->create($data);

        return view('home.products');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        //... Validation here

        $product = $this->teamRepo->update($id, $data);

        return view('home.products');
    }

    public function destroy($id)
    {
        $this->teamRepo->delete($id);

        return view('home.products');
    }
}

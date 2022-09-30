<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\Repository
     */
    protected $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function index()
    {
        $products = $this->employeeRepo->getAll();

        return view('home.products', ['products' => $products]);
    }

    public function show($id)
    {
        $product = $this->employeeRepo->find($id);

        return view('home.product', ['product' => $product]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $product = $this->employeeRepo->create($data);

        return view('home.products');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        //... Validation here

        $product = $this->employeeRepo->update($id, $data);

        return view('home.products');
    }

    public function destroy($id)
    {
        $this->employeeRepo->delete($id);

        return view('home.products');
    }
}

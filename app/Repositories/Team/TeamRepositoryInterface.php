<?php
namespace App\Repositories\Team;

use App\Repositories\RepositoryInterface;

interface TeamRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getProduct();
}

<?php

namespace App\Service;

class BaseService implements ServiceInterface
{
    public $repository;

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create($attributes = [])
    {
        return $this->repository->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        return $this->repository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}

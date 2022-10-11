<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->where('id',$id);
    }

    public function create($attributes = [])
    {
        $attributes = $attributes->except([
            '_token',
            'submit',
        ]);

        $attributes = array_merge($attributes, [
            'ins_id'=> session()->get('id_admin'),
            'ins_datetime' => date('Y-m-d H:i:s'),
        ]);

        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $attributes = $attributes->except([
            '_token',
            '_method',
            'submit',
        ]);

        $attributes = array_merge($attributes, [
            'upd_id'=> session()->get('id_admin'),
            'upd_datetime' => date('Y-m-d H:i:s'),
        ]);

        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}

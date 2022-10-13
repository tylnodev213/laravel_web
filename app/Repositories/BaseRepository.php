<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    public $model;

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

    public function get($columns = [])
    {
        return $this->model->all($columns);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByField($column,$value)
    {
        return $this->model->where($column,$value);
    }

    public function create($attributes = [])
    {
        if(in_array(['_token', 'submit',], $attributes)) {
            $attributes = $attributes->except([
                '_token',
                'submit',
            ]);
        }
        $attributes = array_merge($attributes, [
            'ins_id'=> session()->get('id_admin'),
            'ins_datetime' => date('Y-m-d H:i:s'),
        ]);

        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        if(in_array(['_token', 'submit', '_method',], $attributes)) {
            $attributes = $attributes->except([
                '_token',
                'submit',
                '_method',
            ]);
        }

        $attributes = array_merge($attributes, [
            'upd_id'=> session()->get('id_admin'),
            'upd_datetime' => date('Y-m-d H:i:s'),
        ]);

        $result = $this->find($id);
        if ($result->count()) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

}

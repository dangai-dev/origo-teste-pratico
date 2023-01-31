<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class RepositoryAbstract
{   
    protected $model;

    /**
     * Initiate RepositoryAbstract
     */
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * Retrieve all data
     * @return mixed
     */
    public function all()
    {   
        return $this->model->all();
    }

    /**
     * Retrieve a data
     * @param Request $data
     * @return void
     */
    public function store(Request $data)
    {   
    }

    /**
     * Updates a data
     * @param mixed $id
     * @return mixed
     */
    public function find($id) 
    {
        return $this->model->find($id);
    }

    /**
     * Updates a data
     * @param Request $data
     * @param mixed $id
     * @return void
     */
    public function update(Request $data, $id) 
    {
    }

    /**
     * Deletes a data
     * @param mixed $id
     * @return void
     */
    public function destroy($id) 
    {
    }

    /**
     * Register a contract on Laravel
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function resolveModel()
    {
        return app($this->model);
    }
}
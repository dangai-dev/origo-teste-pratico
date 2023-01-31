<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

Interface RepositoryInterface 
{
    /**
     * Return all data from model
     * @return void
     */
    public function all();
    /**
     * Store data in model
     * @param Request $data
     * @return void
     */
    public function store(Request $data);
    /**
     * Retrieve a data in model
     * @param mixed $id
     * @return void
     */
    public function find($id);
    /**
     * Updates a data in model
     * @param Request $data
     * @param mixed $id
     * @return void
     */
    public function update(Request $data, $id); 
    /**
     * Deletes a data in model
     * @param mixed $id
     * @return void
     */
    public function destroy($id);
}
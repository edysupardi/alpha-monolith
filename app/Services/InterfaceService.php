<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface InterfaceService
{
    /**
     * Fin an item by id
     * @param mixed $id
     * @return Model|null
     */
    public function find($id);

    /**
     * find or fail
     * @param mixed $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Return all items
     * @return Collection|null
     */
    public function all();

    /**
     * Create an item
     * @param array $data
     * @return Model|null
     */
    // public function create(FormRequest $data);
    public function create(array $data);

    /**
     * Update a model
     * @param int|mixed $id
     * @param array $data
     * @return bool|mixed
     */
    // public function update($id, FormRequest $data);
    public function update($id, array $data);

    /**
     * Delete a model
     * @param int|Model $id
     */
    public function delete($id);

    /**
     * multiple delete
     * @param array $id
     * @return mixed
     */
    public function destroy(array $id);
}

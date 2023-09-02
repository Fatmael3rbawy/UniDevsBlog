<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        $data = $this->model->create($attributes);
        return $data;
    }

    public function update(array $attributes, $id)
    {
        $model = $this->model->find($id);

        $data = $model->update($attributes);
        return $model;
    }

    public function find($id, $request): ?Model
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function with($relations): Collection
    {
        return $this->model->with($relations)->get();
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }
}

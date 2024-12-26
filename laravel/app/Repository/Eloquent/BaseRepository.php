<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface as RepositoryEloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryEloquentRepositoryInterface 
{
    // membuat protected pada model
    protected $model;

    // membuat repo untuk model menggunakan __construct
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // membuat array ke dalam model dan dibentuk menjadi attribute
    public function create(array $attributes): Model 
    {
        return $this->model->create($attributes);
    }

    // mencari apakah model ada atau tidak menggunakan ternary operator
    public function find($id): ? Model {
        return $this->model->find($id); 
    }
}
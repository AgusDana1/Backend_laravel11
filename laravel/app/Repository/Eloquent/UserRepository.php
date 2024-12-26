<?php 

namespace App\Repository\Eloquent;

// import model user
use App\Models\User;
use App\Repository\EloquentRepositoryInterface as RepositoryEloquentRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements RepositoryEloquentRepositoryInterface 
{
    // membuat construct untuk model user
    public function __construct(User $model)
    {
        parent::__construct($model); // parent dari construct adalah model
    }

    // dapatkan semua model collection
    public function all(): Collection 
    {
        return $this->model->all();
    }
}
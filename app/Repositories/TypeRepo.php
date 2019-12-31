<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Interfaces\TypeRepoInterface;
use App\Repositories\BaseEloquentRepo;
use App\Models\Type;

class TypeRepo extends BaseEloquentRepo implements TypeRepoInterface
{
    public function __construct(Type $entity) {
        $this->model = $entity;
    }

    /**
     * Returns all the items on this repo
     *
     * @return collection
     */
    public function all() {
        return $this->model->orderBy('created_at', 'asc')->get();
    }

}

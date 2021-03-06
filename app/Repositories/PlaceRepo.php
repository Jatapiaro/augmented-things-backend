<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Interfaces\PlaceRepoInterface;
use App\Repositories\BaseEloquentRepo;
use App\Models\Place;

class PlaceRepo extends BaseEloquentRepo implements PlaceRepoInterface
{
    public function __construct(Place $entity) {
        $this->model = $entity;
    }

    /**
     * Returns all the items on this repo
     *
     * @return collection
     */
    public function adminAll() {
        return $this->model->all();
    }

}

<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Interfaces\DeviceRepoInterface;
use App\Repositories\BaseEloquentRepo;
use App\Models\Device;

use Auth;

class DeviceRepo extends BaseEloquentRepo implements DeviceRepoInterface
{
    public function __construct(Device $entity) {
        $this->model = $entity;
    }

    /**
     * Returns all the items on this repo
     *
     * @return collection
     */
    public function all() {
        return Auth::user()->devices;
    }

}

<?php

namespace App\Services;

use Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Device;
use App\Repositories\Interfaces\DeviceRepoInterface;
use Auth;

class DeviceService {

    /**
     * Repository
     *
     * @var  DeviceRepoInteface
     */
    private $repo;

    public function __construct(DeviceRepoInterface $repo) {
        $this->repo = $repo;
    }

    /**
     * Stores the given item
     *
     * @return  App\Models\Device
     */
    public function store($data) {
        $data['device']['user_id'] = Auth::user()->id;
        $this->validate($data);
        $item = $this->repo->create($data['device']);

        $type = $item->type;
        $type->used = true;
        $type->save();

        return $item;
    }

    /**
     * Validate the given data using the validation book of the model
     *
     * @param  array $data
     * @param  array $except
     * @param  array $append
     * @return  boolean
     */
    public function validate($data, $except = [], $append = []) {
        $vb = Device::ValidationBook($except, $append);
        $validator = Validator::make($data, $vb['rules'], $vb['messages']);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return true;
    }

}

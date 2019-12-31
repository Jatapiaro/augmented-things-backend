<?php

namespace App\Services;

use Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Place;
use App\Repositories\Interfaces\PlaceRepoInterface;
use Auth;

class PlaceService {

    /**
     * Repository
     *
     * @var  PlaceRepoInteface
     */
    private $repo;

    public function __construct(PlaceRepoInterface $repo) {
        $this->repo = $repo;
    }

    /**
     * Stores the given item
     *
     * @return  App\Models\Place
     */
    public function store($data) {
        $this->validate($data);
        $item = $this->repo->create($data['place']);
        return $item;
    }

    /**
     * Updates the $place with the $data
     *
     * @param  array $data
     * @param  Place $place
     * @return  App\Models\Place
     */
    public function update($data, Place $item) {
        $this->repo->update($data['place'], $item->id);
        $item->refresh();
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
        $vb = Place::ValidationBook($except, $append);
        $validator = Validator::make($data, $vb['rules'], $vb['messages']);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return true;
    }

}

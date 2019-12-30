<?php

namespace App\Services;

use Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Type;
use App\Repositories\Interfaces\TypeRepoInterface;
use Auth;

class TypeService {

    /**
     * Repository
     *
     * @var  TypeRepoInteface
     */
    private $repo;

    public function __construct(TypeRepoInterface $repo) {
        $this->repo = $repo;
    }

    /**
     * Stores the given item
     *
     * @return  App\Models\Type
     */
    public function store($data) {
        $this->validate($data);
        $item = $this->repo->create($data['type']);
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
        $vb = Type::ValidationBook($except, $append);
        $validator = Validator::make($data, $vb['rules'], $vb['messages']);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return true;
    }

}

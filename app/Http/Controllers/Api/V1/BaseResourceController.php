<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Controllers\Api\V1\Interfaces\ResourcesControllerInterface;

class BaseResourceController extends BaseController implements ResourcesControllerInterface {
    /**
     * Repository of this resource
     *
     * @var App\Repositories\Interfaces\RepoInterface
     */
    protected $repo;

    /**
     * Service of this resource
     */
    protected $service;

    /**
     * Name of the resource
     *
     * @var string
     */
    protected $resource;

    /**
     * Name of the resource in plural set on the constructor calling
     * the pluralize method
     *
     * @var string
     */
    protected $resourcePlural;

    /**
     * Name of the resource in local language
     *
     * @var string
     */
    protected $resourceLocal;

    /**
     * Model of this resource
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Array of except during validation
     *
     * @var array
     */
    protected $exceptArray;

    /**
     * Array of append during validation
     *
     * @var array
     */
    protected $appendArray;

    /**
     * Class (as a string) to be used as a JsonResource
     *
     * @var string
     */
    protected $jsonResource;

    /**
     * Extra data to be appended to the resource
     *
     * @var array
     */
    protected $extraData;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {
        return $this->toJsonResource($this->repo->all(), true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
        $data = $this->validateRequest($req);
        if (!empty($this->extraData)) {
            $data = array_merge_recursive($data, $this->extraData);
        }
        $item = $this->service->store($data);
        return $this->toJsonResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, $id) {
        $item = $this->repo->find($id);
        return $this->toJsonResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {
        $input = $this->validateRequest($req);
        if (!empty($this->extraData)) {
            $input = array_merge_recursive($input, $this->extraData);
        }
        $data[$this->resource] = $this->repo->find($id);
        $item = $this->service->update($input, $data[$this->resource]);
        return $this->toJsonResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id) {
        $item = $this->repo->find($id);
        $this->repo->delete($id);
        return $this->toJsonResource($item);
    }

    /**
     * Pluralizes the resouce name
     *
     * @return void
     */
    protected function pluralizeResouce() {
        $this->resourcePlural = Str::plural($this->resource);
    }

    /**
     * Validate the input
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function validateRequest(Request $req) {
        $vb = $this->model->ValidationBook($this->exceptArray, $this->appendArray);
        $input = $req->validate($vb['rules'], $vb['messages']);
        return $input;
    }

    /**
     * Converts the data to a json resource
     *
     * @param mixed $data
     * @return Illuminate\Http\Resources\Json\Resource
     */
    protected function toJsonResource($data, $collection = false) {
        if ( $collection ) {
            return call_user_func(
                $this->jsonResource .'::Collection',
                $data
            );
        }
        return new $this->jsonResource($data);
    }

}

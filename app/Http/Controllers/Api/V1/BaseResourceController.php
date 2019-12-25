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
     * @var string
     */
    protected $exceptArray;

    /**
     * Array of append during validation
     *
     * @var string
     */
    protected $appendArray;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {
        return $this->repo->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
        $data = $this->validateRequest($req);
        $item = $this->service->store($data);
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, $id) {
        $data = [];
        $data[$this->resource] = $this->repo->find($id);
        return view($this->resourcePlural.'.show', ['data' => $data]);
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
        $data = [];
        $data[$this->resource] = $this->repo->find($id);
        $this->service->update($input, $data[$this->resource]);
        return redirect()
            ->route($this->resourcePlural.'.edit', ['id' => $id])
            ->with('status', 'El '.$this->resourceLocal.' se ha editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id) {
        $this->repo->delete($id);
        return redirect()
            ->route('app.' . $this->resourcePlural. '.index')
            ->with('status', 'El '.$this->resourceLocal.' se ha eliminado con éxito.');
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
}

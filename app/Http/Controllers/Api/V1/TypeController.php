<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseResourceController;

use App\Repositories\Interfaces\TypeRepoInterface;
use App\Services\TypeService;
use App\Models\Type;

/**
 * @OA\Tag(
 *     name="Types",
 *     description="Operations related with the valid devices of the system",
 * )
 */
class TypeController extends BaseResourceController {

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

    public function __construct(TypeRepoInterface $repo,
        TypeService $service,
        Type $model)
    {
        $this->repo = $repo;
        $this->service = $service;
        $this->resource = 'type';
        $this->pluralizeResouce();
        $this->resourceLocal = 'Tipo';
        $this->model = $model;

        $this->exceptArray = $this->appendArray = $this->extraData = [];
        $this->jsonResource = 'App\Http\Resources\Type';
    }

    /**
    * @OA\Get(
    *     path="/api/v1/types",
    *     summary="Shows the system types",
    *     tags={"Types"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows the system types",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized.",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     )
    * )
    */
    /**
     * Display the user places.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return parent::index($req);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/types",
     *     summary="Register a new device type",
     *     tags={"Types"},
     *     security={{"passport": {"*"}}},
     *     @OA\RequestBody(
     *         description="Type that needs to be stored",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="type",
     *                  type="object",
     *                  ref="#/components/schemas/Type"
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Device that was registered.",
     *         @OA\JsonContent(
     *             type="object"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity.",
     *         @OA\JsonContent(
     *             type="object"
     *         ),
     *     )
     * )
    */
    /**
     * Stores a newly created resource on storage
    *
    * @param  \Illuminate\Http\Request $req
    * @return \Illuminate\Http\Response
    */
    public function store(Request $req) {
        return parent::store($req);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/types/{type}",
    *     summary="Shows the specified type",
    *     tags={"Types"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         name="type",
    *         in="path",
    *         description="ID of the type",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *             example="abcdefghijklmnopq"
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Shows the specified type",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized.",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     )
    * )
    */
    /**
     * Get the specified element
     * @param \Illuminate\Http\Request $req
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, $id) {
        return parent::show($req, $id);
    }

    /**
    * @OA\Put(
    *     path="/api/v1/types/{type}",
    *     summary="Updates a type",
    *     tags={"Types"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         description="Type to update",
    *         in="path",
    *         name="type",
    *         required=true,
    *         @OA\Schema(
    *             type="string"
    *         )
    *     ),
    *     @OA\RequestBody(
    *         description="Type to be updated",
    *         @OA\JsonContent(
    *              @OA\Property(
    *                  property="type",
    *                  type="object",
    *                  ref="#/components/schemas/Type"
    *              ),
    *         ),
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Type that was updated",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Unprocessable Entity.",
    *         @OA\JsonContent(
    *             type="object"
    *         ),
    *     )
    * )
    */
    /**
     * Updates the specified resource
    *
     * @param  \Illuminate\Http\Request $req
     * @param  string  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $req, $id) {
        $this->exceptArray = ['type.id'];
        $this->appendArray = [
            'rules' => [
                'type.id' => 'required|string|unique:types,id,' . $id
            ]
        ];
        return parent::update($req, $id);
    }

}

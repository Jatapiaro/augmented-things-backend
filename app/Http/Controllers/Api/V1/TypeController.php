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

        $this->exceptArray = $this->appendArray = [];
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

}

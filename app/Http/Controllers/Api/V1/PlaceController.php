<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseResourceController;

use App\Repositories\Interfaces\PlaceRepoInterface;
use App\Services\PlaceService;
use App\Models\Place;

use Auth;

/**
 * @OA\Tag(
 *     name="Places",
 *     description="Operations related with the user places",
 * )
 */
class PlaceController extends BaseResourceController {

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

    public function __construct(PlaceRepoInterface $repo,
        PlaceService $service,
        Place $model)
    {
        $this->repo = $repo;
        $this->service = $service;
        $this->resource = 'place';
        $this->pluralizeResouce();
        $this->resourceLocal = 'Lugar';
        $this->model = $model;

        $this->exceptArray = $this->appendArray = [];
        $this->jsonResource = 'App\Http\Resources\Place';
    }

    /**
    * @OA\Get(
    *     path="/api/v1/places",
    *     summary="Shows the user places",
    *     tags={"Places"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows the current user places",
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
     * Display the (current) user places.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return parent::index($req);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/admin-places",
    *     summary="Shows all the places",
    *     tags={"Places"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows all the users places",
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
     * Display all the users places.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex(Request $req)
    {
        return parent::toJsonResource(
            $this->repo->adminAll(),
            true
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/places",
     *     summary="Register a new place",
     *     tags={"Places"},
     *     security={{"passport": {"*"}}},
     *     @OA\RequestBody(
     *         description="Place that needs to be stored",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="place",
     *                  type="object",
     *                  ref="#/components/schemas/Place"
     *              )
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
        if (empty($req->input('place.user_id'))) {
            $this->exceptArray = ['place.user_id'];
            $this->extraData = [
                'place' => [
                    'user_id' => Auth::user()->id
                ]
            ];
        }
        return parent::store($req);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/places/{place}",
    *     summary="Shows the specified place",
    *     tags={"Places"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         name="place",
    *         in="path",
    *         description="ID of the place",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64",
    *             example=1
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Shows the specified place",
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
    *     path="/api/v1/places/{place}",
    *     summary="Updates a place",
    *     tags={"Places"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         description="Place to be updated",
    *         in="path",
    *         name="place",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *     @OA\RequestBody(
    *         description="Data of the place to be updated",
    *         @OA\JsonContent(
    *              @OA\Property(
    *                  property="place",
    *                  type="object",
    *                  ref="#/components/schemas/Place"
    *              ),
    *         ),
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Place that was updated",
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
        return parent::update($req, $id);
    }

}

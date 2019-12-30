<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseResourceController;

use App\Repositories\Interfaces\UserRepoInterface;
use App\Services\UserService;
use App\Models\User;

use Auth;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="Operations related with the users of the system",
 * )
 */
class UserController extends BaseResourceController {

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

    public function __construct(UserRepoInterface $repo,
        UserService $service,
        User $model)
    {
        $this->repo = $repo;
        $this->service = $service;
        $this->resource = 'user';
        $this->pluralizeResouce();
        $this->resourceLocal = 'Usuario';
        $this->model = $model;

        $this->exceptArray = $this->appendArray = $this->extraData = [];
        $this->jsonResource = 'App\Http\Resources\User';
    }

    /**
    * @OA\Get(
    *     path="/api/v1/users",
    *     summary="Shows the users of the system",
    *     tags={"Users"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows the current users of the system",
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
     * Display the user devices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return parent::index($req);
    }

}

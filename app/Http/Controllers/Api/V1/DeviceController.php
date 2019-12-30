<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseResourceController;

use App\Repositories\Interfaces\DeviceRepoInterface;
use App\Services\DeviceService;
use App\Models\Device;

use Auth;

/**
 * @OA\Tag(
 *     name="Devices",
 *     description="Operations related with the user devices",
 * )
 */
class DeviceController extends BaseResourceController {

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

    public function __construct(DeviceRepoInterface $repo,
        DeviceService $service,
        Device $model)
    {
        $this->repo = $repo;
        $this->service = $service;
        $this->resource = 'device';
        $this->pluralizeResouce();
        $this->resourceLocal = 'Dispositivo';
        $this->model = $model;

        $this->exceptArray = $this->appendArray = $this->extraData = [];
        $this->jsonResource = 'App\Http\Resources\Device';
    }

    /**
    * @OA\Get(
    *     path="/api/v1/devices",
    *     summary="Shows the user devices",
    *     tags={"Devices"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows the current user devices",
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

    /**
     * @OA\Post(
     *     path="/api/v1/devices",
     *     summary="Register a new device",
     *     tags={"Devices"},
     *     security={{"passport": {"*"}}},
     *     @OA\RequestBody(
     *         description="Device that needs to be stored",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="device",
     *                  type="object",
     *                  ref="#/components/schemas/Device"
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
        $this->exceptArray = ['device.user_id'];
        if (empty($req->input('user_id'))) {
            $this->extraData = [
                'device' => [
                    'user_id' => Auth::user()->id
                ]
            ];
        }
        return parent::store($req);
    }

}

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
    * @OA\Get(
    *     path="/api/v1/admin-devices",
    *     summary="Shows all the user devices",
    *     tags={"Devices"},
    *     security={{"passport": {"*"}}},
    *     @OA\Response(
    *         response=200,
    *         description="Shows all the users devices",
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
     * Display all the users devices.
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
        if (empty($req->input('device.user_id'))) {
            $this->exceptArray = ['device.user_id'];
            $this->extraData = [
                'device' => [
                    'user_id' => Auth::user()->id
                ]
            ];
        }
        return parent::store($req);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/devices/{device}",
    *     summary="Shows the specified device",
    *     tags={"Devices"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         name="device",
    *         in="path",
    *         description="ID of the device",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64",
    *             example=1
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Shows the specified device",
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
    *     path="/api/v1/devices/{device}",
    *     summary="Updates a device",
    *     tags={"Devices"},
    *     security={{"passport": {"*"}}},
    *     @OA\Parameter(
    *         description="Device to be updated",
    *         in="path",
    *         name="device",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             format="int64"
    *         )
    *     ),
    *     @OA\RequestBody(
    *         description="Data of the device to be updated",
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
    *         description="Device that was updated",
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
        $type = "";
        if (!empty($req->input('device.type_id'))) {
            $type = $req->input('device.type_id');
        }

        $this->exceptArray = ['device.type_id'];
        $this->appendArray = [
            'rules' => [
                'device.type_id' => 'required|string|unique:types,id,' . $type
            ]
        ];

        if (empty($req->input('device.user_id'))) {
            $this->exceptArray = ['device.type_id', 'device.user_id'];
            $this->extraData = [
                'device' => [
                    'user_id' => Auth::user()->id
                ]
            ];
        }
        return parent::update($req, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/devices/{device}",
     *     summary="Deletes a device",
     *     tags={"Devices"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         description="Device to be deleted",
     *         in="path",
     *         name="device",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Device that was deleted",
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
     * Destroys the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $item = $this->repo->find($id);

        $type = $item->type;
        $type->used = false;
        $type->save();

        return parent::destroy($request, $id);
    }

}

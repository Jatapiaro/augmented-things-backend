<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(type="object", title="Device", description="Devices registered by the user in the system", required={"name", "latitude", "longitude", "altitude", "type_id"})
 * @OA\Property(
 *     type="string",
 *     description="Name of the device",
 *     property="name"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Latitude of the device (coordinates)",
 *     property="latitude",
 *     example="19.4284700"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Longitude of the device (coordinates)",
 *     property="longitude",
 *     example="-99.1276600"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Altitude of the device (coordinates)",
 *     property="altitude"
 * ),
 * @OA\Property(
 *     type="string",
 *     description="Reference to the valid device",
 *     property="type_id",
 *     example="350043001147343438323536"
 * )
 */
class Device extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude', 'longitude',
        'altitude', 'type_id', 'user_id'
    ];

    /**
     * Declares the relationship between this device and his type
     */
    public function type() {
        return $this->belongsTo('App\Models\Type');
    }

    /**
     * Returns an array that contains two indexes:
     * 'rules' for the validation
     * 'messages' messages given by the validation
     *
     * @return array
     **/
    public static function ValidationBook($except = [], $append = [])
    {
        $book = ['rules' => [], 'messages' => []];
        $book['rules'] = [
            'device.name' => 'required|string',
            'device.latitude' => array(
                'required',
                'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'
            ),
            'device.longitude' => array(
                'nullable',
                'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'
            ),
            'device.altitude' => 'required|numeric',
            'device.type_id' => 'required|exists:types,id,used,0',
            'device.user_id' => 'required|exists:users,id'
        ];
        $book['messages'] = [
            'device.name.required' => 'Se requiere el nombre del dispositivo',
            'device.name.string' => 'El nombre del dispositivo debe ser un texto',

            'device.latitude.required' => 'Se requiere la latitud del dispositivo',
            'device.latitude.regex' => 'El formato de la latitud no es correcto',

            'device.longitude.required' => 'Se requiere la longitud del dispositivo',
            'device.longitude.regex' => 'El formato de la longitud no es correcto',

            'device.altitude.required' => 'Se requiere la altitud del dispositivo',
            'device.altitude.numeric' => 'La altitud debe ser un número',

            'device.type_id.required' => 'Se requiere el dispositivo del dispositivo',
            'device.type_id.exists' => 'El dispositivo debe ser de un tipo válido',

            'device.user_id.required' => 'Se requiere el usuario del dispositivo',
            'device.user_id.exists' => 'El usuario del dispositivo debe ser un usuario válido'
        ];
        if (!empty($except)) {
            $except = array_flip($except);
            $book['rules'] = array_diff_key($book['rules'], $except);
        }
        if (!empty($append)) {
            $book = array_merge_recursive($book, $append);
        }
        return $book;
    }

}

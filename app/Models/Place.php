<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(type="object", title="Place", description="Places registered by the user", required={"name", "latitude", "longitude", "altitude"})
 * @OA\Property(
 *     type="string",
 *     description="Name of the place",
 *     property="name"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Latitude of the place (coordinates)",
 *     property="latitude",
 *     example="19.4284700"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Longitude of the place (coordinates)",
 *     property="longitude",
 *     example="-99.1276600"
 * ),
 * @OA\Property(
 *     type="number",
 *     description="Altitude of the place (coordinates)",
 *     property="altitude"
 * )
 */
class Place extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude', 'longitude',
        'altitude', 'user_id'
    ];

    /**
     * Declares the relationship between this device and his type
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
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
            'place.name' => 'required|string',
            'place.latitude' => array(
                'required',
                'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'
            ),
            'place.longitude' => array(
                'required',
                'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'
            ),
            'place.altitude' => 'required|numeric',
            'place.user_id' => 'required|exists:users,id'
        ];
        $book['messages'] = [
            'place.name.required' => 'Se requiere el nombre del lugar',
            'place.name.string' => 'El nombre del lugar debe ser un texto',

            'place.latitude.required' => 'Se requiere la latitud del lugar',
            'place.latitude.regex' => 'El formato de la latitud no es correcto',

            'place.longitude.required' => 'Se requiere la longitud del lugar',
            'place.longitude.regex' => 'El formato de la longitud no es correcto',

            'place.altitude.required' => 'Se requiere la altitud del lugar',
            'place.altitude.numeric' => 'La altitud debe ser un número',

            'place.user_id.required' => 'Se requiere el usuario del lugar',
            'place.user_id.exists' => 'El usuario del lugar debe ser un usuario válido'
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

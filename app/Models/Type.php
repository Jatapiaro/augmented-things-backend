<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(type="object", title="Type", description="Types of valid devices and his types on the system", required={"id", "type"})
 * @OA\Property(
 *     type="string",
 *     description="ID of the particle device",
 *     property="id"
 * ),
 * @OA\Property(
 *     type="string",
 *     description="Type of device",
 *     property="type"
 * )
 */
class Type extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type'
    ];

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
            'type.id' => 'required|string|unique:types,id',
            'type.type' => 'required|string',
        ];
        $book['messages'] = [
            'type.id.required' => 'Se requiere el id del dispositivo',
            'type.id.string' => 'El id del dispositivo debe ser un texto númerico',
            'type.id.unique' => 'El id introducido ya ha sido registrado',

            'type.type.required' => 'Se requiere el tipo del dispositivo',
            'type.type.string' => 'El tipo de dispositivo debe ser un texto'
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

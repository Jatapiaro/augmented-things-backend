<?php

use Illuminate\Database\Seeder;

/**
 * Models
 */
use App\Models\Type;


class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = [
            [
                'id' => '350043001147343438323536',
                'type' => 'light'
            ]
        ];
        $data = [];
        foreach($types as $type) {

            $prev = Type::find($type['id']);
            if (is_null($prev)) {
                $data[] = $type;
            }

        }
        Type::insert($data);

    }
}

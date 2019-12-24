<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Type;

class AddValidDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'augmented:add:device';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a valid device and type for the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->ask('What\'s the id of the device?');
        $device = Type::where('id', $id)->first();
        if ( !is_null($device) ) {
            $this->error('The device is already on the system.');
            return;
        }
        $type = $this->ask('What\'s the type of the device?');
        if ($this->confirm("Are you sure you want to add {$id} ({$type}) as a new device?")) {
            Type::create([
                'id' => $id,
                'type' => $type
            ]);
            $this->info('The device has been created!');
        }
    }
}

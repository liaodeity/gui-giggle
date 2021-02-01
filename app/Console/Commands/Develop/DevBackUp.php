<?php

namespace App\Console\Commands\Develop;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DevBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '备份系统的基础表信息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct ();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle ()
    {
        $tables = [
            'configs',
            'menus',
            'parameters',
            'parameter_items',
        ];
        $dir    = 'dev-backup/' . today ()->format ('Ymd');
        $data   = [];
        foreach ($tables as $table) {
            $file = $table . '.json';

            $result = DB::table ($table)->get ();
            if ($result->isEmpty ()) {
                continue;
            }
            $content        = $result->toArray ();
            $data[ $table ] = Storage::put ($dir . '/' . $file, json_encode ($content));
        }
    }
}

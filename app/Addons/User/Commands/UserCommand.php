<?php
/**
 * Created by liaodeity@gmail.com
 * User: gui
 * Date: 2020/7/9
 */

namespace App\Addons\User\Commands;


use Illuminate\Console\Command;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        $action = $this->argument ('name');
        $this->info ($action);
    }
}

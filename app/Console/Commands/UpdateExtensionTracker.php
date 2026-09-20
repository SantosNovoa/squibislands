<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class UpdateExtensionTracker extends Command {
=======
use DB;
use Config;

class UpdateExtensionTracker extends Command
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-extension-tracker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command in order to add extensions to your list of extensions. This helps you to keep track of what extensions are used on your site and who created them.';

    /**
     * Create a new command instance.
<<<<<<< HEAD
     */
    public function __construct() {
=======
     *
     * @return void
     */
    public function __construct()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function handle() {
=======
    public function handle()
    {
        $extensions = Config::get('lorekeeper.extension_tracker');

>>>>>>> Cylunny/extension/polls-and-forms
        $this->info("\n".'****************************');
        $this->info('* UPDATE EXTENSION TRACKER *');
        $this->info('****************************');

<<<<<<< HEAD
        $extendos = [];
        foreach (glob('config/lorekeeper/ext-tracker/*.php') as $extension) {
            $extendos[basename($extension, '.php')] = include $extension;
        }

        $this->line('Adding site extensions...existing entries will be updated.'."\n");

        foreach ($extendos as $key => $data) {
            $extension = DB::table('site_extensions')->where('key', $key);
            if (!$extension->exists()) {
                DB::table('site_extensions')->insert([
                    'key'      => $key,
                    'wiki_key' => $data['wiki_key'],
                    'creators' => $data['creators'],
                    'version'  => $data['version'],
                ]);
                $this->info('Added:   '.$key.' / Version: '.$data['version']);
            } elseif ($extension->first()->version != $data['version']) {
                $this->info(ucfirst($key).' version mismatch. Old version: '.$extension->first()->version.' / New version: '.$data['version']);
                $confirm = $this->confirm('Do you want to update the listed version of '.$key.' to '.$data['version'].'? This will not affect any other files.');
                if ($confirm || !app()->runningInConsole()) {
                    DB::table('site_extensions')->where('key', $key)->update([
                        'key'      => $key,
                        'wiki_key' => $data['wiki_key'],
                        'creators' => $data['creators'],
                        'version'  => $data['version'],
                    ]);
                    $this->info('Updated:   '.$key.' / Version: '.$data['version']);
                } else {
                    $this->line('Skipped: '.$key.' / Version: '.$extension->first()->version);
                }
            } else {
                $this->line('Skipped: '.$key.' / Version: '.$data['version']);
            }
        }

        if (app()->runningInConsole()) {
            $extensions = DB::table('site_extensions')->pluck('key')->toArray();
            $processed = array_keys($extendos);

            $missing = array_merge(array_diff($processed, $extensions), array_diff($extensions, $processed));

            if (count($missing)) {
                $miss = implode(', ', $missing);
                $this->line("\033[31m");
                $this->error('The following extension'.(count($missing) == 1 ? ' is' : 's are').' not present as a file but '.(count($missing) == 1 ? 'is' : 'are').' still in your database:');
                $this->line($miss);

                $confirm = $this->confirm('Do you want to remove '.(count($missing) == 1 ? 'this extension' : 'these extensions').' from your database and extensions list? This will not affect any other files.');
                if ($confirm) {
                    foreach ($missing as $ext) {
                        $extension = DB::table('site_extensions')->where('key', $ext)->delete();
                        $this->info('Deleted:   '.$ext);
                    }
                } else {
                    $this->line('Leaving extension'.(count($missing) == 1 ? '' : 's').' alone.');
                }
            }
        }

        $this->info("\n".'All extensions are in tracker.'."\n");
=======
        $this->line('Adding site extensions...existing entries will be updated.'."\n");

        foreach($extensions as $data)
        {
            $extension = DB::table('site_extensions')->where('key', $data['key']);
            if(!$extension->exists())
            {
                DB::table('site_extensions')->insert([
                    'key' => $data['key'],
                    'wiki_key' => $data['wiki_key'],
                    'creators' => $data['creators'],
                    'version' => $data['version'],
                ]);
                $this->info('Added:   '.$data['key'].' / Version: '.$data['version']);
            }
            elseif($extension->first()->version != $data['version'])
            {
                $this->info(ucfirst($data['key']).' version mismatch. Old version: '.$extension->first()->version.' / New version: '.$data['version']);
                $confirm = $this->confirm('Do you want to update the listed version of '.$data['key'].' to '.$data['version'].'? This will not affect any other files.');
                if($confirm){
                    DB::table('site_extensions')->where('key', $data['key'])->update([
                        'key' => $data['key'],
                        'wiki_key' => $data['wiki_key'],
                        'creators' => $data['creators'],
                        'version' => $data['version'],
                    ]);
                    $this->info('Updated:   '.$data['key'].' / Version: '.$data['version']);
                }
                else $this->line('Skipped: '.$data['key'].' / Version: '.$extension->first()->version);
            }
            else $this->line('Skipped: '.$data['key'].' / Version: '.$data['version']);
        }
        
        $this->info("\n".'All extensions are in tracker.'."\n");

>>>>>>> Cylunny/extension/polls-and-forms
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViewFileGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:view {path} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate views file like index, create, show, edit';

    /**
     * Blade template that would be used in blade file
     */
    protected $blade = <<<'blade'
    <div>
        {{-- It's your time to modify something😁✌ --}}
    </div>
    blade;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force') ? true : false;
        if($force)
        {
            $confirm = $this->confirm('Are you sure to create directory and files which would be delete already exists file?');
            if(! $confirm) return $this->info('No created directory and file');
        }

        $view_path = resource_path('/views');
        $path = $this->argument('path');

        if(Str::of($path)->isMatch('/\//'))
        {
            $dir = collect(Str::of($path)->explode('/'));
            $previous = '';
            $dir->each(function ($item, $key) use (&$previous, $view_path, $force) {
                $previous .= '/' . $item;
                if((! File::exists($view_path . $previous)) || $force == true)
                File::makeDirectory($view_path . $previous, force: true);
            });
        }
        
        else File::makeDirectory($view_path . '/' . $path, force: true);

        $path = $view_path . '/' . $path;

        $files = collect([
            'index.blade.php',
            'create.blade.php',
            'show.blade.php',
            'edit.blade.php',
        ]);

        $files->each(function ($item, $key) use ($path, $force) {
            if((! File::exists($path . '/' . $item)) || $force == true)
            File::put($path . '/' . $item, $this->blade);
        });

        return $this->info('Generate views successfully!😊😎');
    }
}

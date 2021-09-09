<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Generator;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
//        $faker = app()->make(Generator::class);
//        $classes = collect($faker->words(500));
//        $classes->each(function ($class, $key) use ($faker) {
//            $qtd = $faker->numberBetween(1, 10);
//            $methods = collect($faker->words($qtd));
//            $methods->each(function ($method, $key) use ($class) {
////                echo "$class::$method\n";
//                try {
//                    Permission::create(['name' => "$class::$method"]);
//
//                } catch (\Exception) {}
//            });
//        });
//
//        $perms = Permission::all(['id'])->pluck('id');
//        $users = User::all();
//        foreach ($users as $user) {
//            $qtd = $faker->numberBetween(1, $perms->count());
//            $user->syncPermissions($faker->randomElements($perms, $qtd));
////        }

        return 0;
    }
}

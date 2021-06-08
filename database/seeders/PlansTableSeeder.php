<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Plan::create([
            'name' => 'Businers', 
            'url' => 'businers', 
            'price' => '499.99', 
            'description' => 'Plano Empresarial',
        ]);
        */
        DB::table('plans')->insert([
            'name' => Str::random(10),
            'url' => Str::random(10).'@gmail.com',
            'price' => '499.99', 
            'description' => 'Plano Empresarial',
        ]);
    }
}

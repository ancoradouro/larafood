<?php

namespace Database\Seeders;

use App\Models\{
    Plan,
    Tenant
};
use Illuminate\Database\Seeder;


class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '99.999.999/0001-99',
            'name' => 'Marcelo Bittencourt',
            'url' => 'mbitts.com',
            'email' => 'bitts@passport.com',
        ]);
    }
}

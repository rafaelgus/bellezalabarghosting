<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('123456'),
            'sobre_nombre' => 'superadmin',
            'gusto_llamado' => 'superadmin',
            'profesional_belleza' => 'no',
            'numero_whatsapp' => '4122072282',
            'eval_product'=> 'no',
            'rol'=> 1,

        ]);
    }
}

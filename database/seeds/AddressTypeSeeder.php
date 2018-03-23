<?php

use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address_types = array(
            ['name'=>'business'],
            ['name'=>'residential'],
            ['name'=>'billing'],
        );
        DB::table('address_types')->insert($address_types);
    }
}

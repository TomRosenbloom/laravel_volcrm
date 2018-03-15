<?php

use Illuminate\Database\Seeder;

class OrganisationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            ['name'=>'Registered Charity – Unincorporated Association','acronym'=>''],
            ['name'=>'Registered Charity – Charitable Incorporated Organisation','acronym'=>'CIO'],
            ['name'=>'Community Interest Company','acronym'=>'CIC'],
            ['name'=>'Company Limited by Guarantee','acronym'=>'CLG'],
            ['name'=>'Industrial & Provident','acronym'=>'I&P'],
            ['name'=>'Unincorporated Association - not registered with Charity Commission','acronym'=>''],
            ['name'=>'Social Enterprise','acronym'=>'SE'],
        );
        DB::table('organisation_types')->insert($types);
    }
}

<?php

use Illuminate\Database\Seeder;

class IncomeBandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $income_bands = array(
            ['textual'=>'None','lower'=>'0','upper'=>'0'],
            ['textual'=>'Less than £1000','lower'=>'0','upper'=>'1000'],
            ['textual'=>'£1000 to £10k','lower'=>'1001','upper'=>'10000'],
            ['textual'=>'£10k to £100k','lower'=>'10001','upper'=>'100000'],
            ['textual'=>'£100k to £1 million','lower'=>'100001','upper'=>'1000000'],
            ['textual'=>'Over £1 million', 'lower'=>'1000001','upper'=> NULL],
            ['textual'=>'Unknown','lower'=>NULL,'upper'=>NULL]
        );
        DB::table('income_bands')->insert($income_bands);
    }
}

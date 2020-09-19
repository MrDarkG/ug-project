<?php

use Illuminate\Database\Seeder;

class deadlineseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ideas_deadline::create([
            'end_date' => '2020-09-20 23:04:37.00',
        ]);
    }
}

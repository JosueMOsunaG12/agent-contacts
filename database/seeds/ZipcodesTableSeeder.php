<?php

use Illuminate\Database\Seeder;
use App\Models\Zipcode;

class ZipcodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The zipcodes described in the csv file are inserted in the database.
        Zipcode::fromCsv(database_path('seeds/csv/zipcodes.csv'), ',');
    }
}

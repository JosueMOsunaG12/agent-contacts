<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents')->truncate(); // Truncates table to insert agents

        /**
        * The agents described in the configuration file 
        * are inserted in the database.
        */
        $agentsCollection = collect(config('agents'));

        $agents = $agentsCollection->map(function ($agent, $key) {
            $agent['created_at'] = Carbon::now();
            $agent['updated_at'] = Carbon::now();

            return $agent;
        });

        DB::table('agents')->insert($agents->all());
    }
}

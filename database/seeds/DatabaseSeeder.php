<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgentsTableSeeder::class);
        $this->call(ZipcodesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}

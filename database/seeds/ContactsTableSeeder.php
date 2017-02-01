<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->truncate(); // Truncates table to insert contacts

        // The contacts described in the csv file are inserted in the database.
        Contact::fromCsv(database_path('seeds/csv/contacts.csv'), ',');
    }
}

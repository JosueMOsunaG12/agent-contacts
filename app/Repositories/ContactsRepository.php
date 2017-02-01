<?php

namespace App\Repositories;

use App\Models\Contact;
use Cache;

class ContactsRepository
{
    /**
     * Method that allows to find all the contacts.
     *
     * @return Illuminate\Support\Collection of Contacts
     */
    public function findAll()
    {
    	// Remember the contacts query for a week
        return Cache::remember("contacts", 10080, function () {
            return Contact::all();
        });
    }
}

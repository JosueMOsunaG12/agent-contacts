<?php

namespace App\Repositories;

use App\Models\Zipcode;
use Cache;
use DB;

class ZipcodesRepository
{
    /**
     * Method that allows to find a zipcode.
     *
     * @return Illuminate\Support\Collection of Contacts
     */
    public function find($zipcodeId)
    {
        // Remember the zipcode query for three days
        return Cache::remember("zipcodes:{$zipcodeId}", 4320, function () use ($zipcodeId) {
            $zipcode = Zipcode::find($zipcodeId);

            if (! $zipcode) {
                $zipcode = $this->findNearestZipcode($zipcodeId);
            }

            return $zipcode;
        });
    }

    /**
     * Method that allows to find the nearest zipcode a zipcode.
     *
     * @return Illuminate\Support\Collection of Contacts
     */
    protected function findNearestZipcode($zipcodeId)
    {
        return Zipcode::orderBy(DB::raw("ABS(id - {$zipcodeId})"))->first();
    }
}

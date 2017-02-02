<?php

namespace App\Business;

class HarversineCalculator
{
    /**
     * Method that allows get distance between two coordinates
     * using harversine formula.
     *
     * @param float $latitude1 Latitude of first coordinate
     * @param float $longitude1 Longitude of first coordinate
     * @param float $latitude2 Latitude of second coordinate
     * @param float $longitude2 Longitude of second coordinate
     * @return float Distance between coordinates
     */
    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371;
     
        $diffLat = deg2rad($latitude2 - $latitude1);
        $diffLon = deg2rad($longitude2 - $longitude1);
     
        $aux = sin($diffLat/2) * sin($diffLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($diffLon/2) * sin($diffLon/2);
        $distance = $earthRadius * 2 * asin(sqrt($aux));
     
        return $distance;
    }
}

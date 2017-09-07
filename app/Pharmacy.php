<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $table = 'pharmacies';

    public function getDistanceFrom($latitude, $longitude)
    {
        $targetLocation = new \Geodistance\Location((float)$latitude, (float)$longitude);
        $pharmacyLocation = new \Geodistance\Location($this->latitude, $this->longitude);
        return \Geodistance\miles($targetLocation, $pharmacyLocation, 8);
    }
}

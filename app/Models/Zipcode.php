<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CsvImportable;

class Zipcode extends Model
{
    use CsvImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'lat', 'lng'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the contacts for the zipcode.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

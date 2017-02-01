<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CsvImportable;

class Contact extends Model
{
    use CsvImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'zipcode_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the zipcode that owns the contact.
     */
    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class);
    }
}

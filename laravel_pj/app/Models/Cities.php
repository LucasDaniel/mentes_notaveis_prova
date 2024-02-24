<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    use HasFactory;

    /**
     * Verify if City exists
     * @param int
     * @return bool
     */
    public static function verifyCityExists(int $city_id): bool {
        return !is_null(Cities::find($city_id));
    }

}

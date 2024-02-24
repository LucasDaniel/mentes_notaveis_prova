<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Adress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'name',
        'number',
        'neighborhood',
    ];

    use HasFactory;

    /**
     * Get the Adress by city_id, neighborhood, name, complement and number
     * @param int, string, string, string, string
     * @return object
     */
    public static function getAdressByValues(int $city_id, string $neighborhood, string $adress_name, string $number, $complement = '') {
        return Adress::where('city_id','=',$city_id)
                     ->where('neighborhood','LIKE',$neighborhood)
                     ->where('name','LIKE',$adress_name)
                     ->where('complement','LIKE',$complement)
                     ->where('number','LIKE',$number)
                     ->first();
    }

    /**
     * Create the new adress with values city_id, neighborhood, name, complement and number
     * @param int, string, string, string, string
     * @return int
     */
    public static function createNewAdress(int $city_id, string $neighborhood, string $adress_name, string $number, $complement): int {
        $adress = new Adress();
        $adress->city_id = $city_id;
        $adress->name = $adress_name;
        $adress->number = $number;
        $adress->neighborhood = $neighborhood;
        $adress->complement = $complement ?? '';
        $adress->save();
        return $adress->id;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    protected $fillable = ['serial', 'longitude', 'latitude'];
    public $regex = "regex:/^\d*(\.\d{2})?$/";
    public static $fieldValidations = [
        'serial' => 'required|unique:panels|size:15',
        'latitude' => 'required|numeric|between:-90.000000,90.000000|regex:/^\d*(\.\d{6})?$/',
        'longitude' => 'required|numeric|between:-180.000000,180.000000|regex:/^\d*(\.\d{6})?$/',
    ];

    public function oneHourElectricities()
    {
        return $this->hasMany('App\Models\OneHourElectricity');
    }
}

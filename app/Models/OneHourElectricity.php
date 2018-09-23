<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OneHourElectricity extends Model
{
    protected $fillable = ['panel_id', 'kilowatts', 'hour'];

    public static $fieldValidations = [
        'panel_id' => 'required',
        'kilowatts' => 'required',
        'hour' => 'required|date_format:Y-m-d H:i:s|unique:one_hour_electricities,hour,NULL,panel_id'
    ];

    public function panel()
    {
        return $this->belongs_to('App\Models\Panel');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'name'
    ];

    public function dates()
    {
        return $this->belongsToMany(Date::class, 'dates_tables', 'table_id', 'date_id')->withPivot('reservations');
    }

    public function selectedDate($id)
    {
        return $this->dates()->where('id', '=',$id)->first();
    }
}

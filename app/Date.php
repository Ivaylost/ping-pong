<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = [
        'reservation_date'
    ];

    public function tables()
    {
        return $this->belongsToMany(Table::class, 'dates_tables', 'table_id', 'date_id')->withPivot('reservations');
    }

    public function update_time_span($ids)
    {
        $time_span = self::default_time_span();

        foreach ($ids as $id)
        {
            $time_span[$id] = true;
        }

        return $time_span;
    }

    public static function default_time_span() {
        return [
            '9-10' => false,
            '10-11' => false,
            '11-12' => false,
            '12-13' => false,
            '13-14' => false,
            '14-15' => false,
            '15-16' => false,
        ];
    }
}

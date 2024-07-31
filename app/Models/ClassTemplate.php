<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTemplate extends Model
{
    use HasFactory;
    protected $table = 'class_template';
    protected $primaryKey = 'class_template_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_template_uid',
        'name',
        'payload'
    ];

    /**
     * Convert value  to seconds
     *
     * @var string
     * @var int
     * @return int
     */
    public static function convertUnit(
        string $unit,
        int $value
    ): int
    {
        switch ($unit) {
            case 'minute':
                return $value * (1*60);

            case 'hour':
                return $value * (1*3600);

            case 'day':
                return $value * ((1*24) * 3600);

            case 'week':
                return $value * ((7 * 24) * 3600);

            case 'month':
                return $value * ((30 * 24) * 3600);

            case 'year':
                return $value * ((365 * 24) * 3600);
            
            default:
                return $value * ((1*24) * 3600);
        }
    }
}

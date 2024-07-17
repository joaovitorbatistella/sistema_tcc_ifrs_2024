<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendType extends Model
{
    use HasFactory;

    protected $table = 'append_type';
    protected $primaryKey = 'append_type_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public static function findIdBySlug(string $slug)
    {
        $append_type = self::select('append_type_id')->where('slug', $slug)->first();

        if(!isset($append_type)) {
            return null;
        }

        return $append_type->append_type_id;
    }
}

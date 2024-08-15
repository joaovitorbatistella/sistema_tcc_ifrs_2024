<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCC extends Model
{
    use HasFactory;

    protected $table = 'tcc';
    protected $primaryKey = 'tcc_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    public function tccClass()
    {
        return $this->hasMany(TccClass::class, 'tcc_id');
    }

    public static function getTccByClassId($tcc_class_id)
    {
        return TCC::select('tcc.*')
                    ->join('tcc_class', 'tcc.tcc_id', '=', 'tcc_class.tcc_id')
                    ->where('tcc_class.tcc_class_id', $tcc_class_id)
                    ->get();
    }

}

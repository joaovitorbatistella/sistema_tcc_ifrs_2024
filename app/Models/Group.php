<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';
    protected $primaryKey = 'group_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "able_to_create_tcc",
        "able_to_read_tcc",
        "able_to_update_tcc",
        "able_to_delete_tcc",
        "able_to_create_users",
        "created_at",
        "updated_at"
    ];

    public function users()
    {
        return $this->belongsToMany(Group::class, 'user_group', 'group_id', 'user_id');
    }
}



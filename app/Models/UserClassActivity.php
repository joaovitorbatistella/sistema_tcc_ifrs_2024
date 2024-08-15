<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClassActivity extends Model
{
    use HasFactory;

    protected $table = 'user_class_activity';
    protected $primaryKey = 'user_class_activity_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_class_id',
        'name',
        'description',
        'due_at',
        'delivered_at',
        'created_at',
        'updated_at',
    ];

    public function steps(){
        return $this->hasMany(UserClassActivityStep::class, 'user_class_activity_id', 'user_class_activity_id');
      } 

    public function attachments(){
        return $this->hasMany(UserClassActivityAppend::class, 'user_class_activity_id', 'user_class_activity_id');
    } 

    public function tcc(){
        return self::join('user_class', 'user_class_activity.user_class_id', '=', 'user_class.user_class_id')
                    ->join('tcc_class', 'user_class.tcc_class_id', '=', 'user_class.tcc_class_id')
                    ->join('tcc', 'tcc_class.tcc_id', '=', 'tcc.tcc_id')
                    ->first();
    } 


    public static function getTodoActivities($user_id, $class_id)
    {
        $query = UserClassActivity::select('user_class_activity.*')
                   ->join('user_class', 'user_class_activity.user_class_id', '=', 'user_class.user_class_id')
                   ->where('user_class.user_id', $user_id)
                   ->where('user_class_activity.delivered_at', null);

        if(isset($class_id)) {
            $query->where('user_class.tcc_class_id', $class_id);
        }
        
        return $query;
    }

    public static function getHistoricalActivities($user_id, $class_id)
    {
        $query = UserClassActivity::select('user_class_activity.*')
                   ->join('user_class', 'user_class_activity.user_class_id', '=', 'user_class.user_class_id')
                   ->where('user_class.user_id', $user_id)
                   ->whereNotNull('user_class_activity.delivered_at');

        if(isset($class_id)) {
            $query->where('user_class.tcc_class_id', $class_id);
        }
        
        return $query;
    }
    
}

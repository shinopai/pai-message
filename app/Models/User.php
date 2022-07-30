<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Room;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * relation
     */
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    /**
     * some functions
     */
    public static function isRoomExists($user_id, $partner_id){
        $arr = array($user_id, $partner_id);
        $res = Room::whereIn('user_id', $arr)->whereIn('partner_id', $arr)->first();

        if(isset($res)){
            return true;
        }else{
            return false;
        }
    }

    public static function getRoomId($user_id, $partner_id){
        $res = User::find(1)->rooms()->where('partner_id', 83)->value('id');

        return $res;
    }
}

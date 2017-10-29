<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function existUser($params) {
        $query = $this;
        foreach ($params as $index => $item){
            $query = $query->where($index, $item);
        }
        return $query->get();
    }

    public function validateDevice($params) {
        $now = new \DateTime();
        $now = $now->format('Y-m-d H:i:s');
        return $this->where('phone_number', $params['phone_number'])->first()->tokens()
            ->where('token', $params['token'])
            ->where('deleted_at','>=', $now)
            ->get();
    }

    public function tokens(){
        return $this->hasMany('App\TemporalToken','user_id', 'id');
    }

    public function updateCurrentToken($params) {
        $now = new \DateTime();
        $now = $now->getTimestamp();
        $user = $this->where('phone_number', $params['phone_number'])->first();
        $user->token = encrypt($params['phone_number'].$now);
        $user->update();
        return $user;
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuids;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, Uuids, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'gender',
        'password',
        'avatar',
        'address',
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
    
    public function userHasClass(){
        return $this->belongsToMany(ClassModel::class, 'user_has_class', 'user_id', 'class_id')->withPivot('status')->withTimestamps();
    }

    public function mentor(){
        return $this->hasMany(ClassModel::class, 'responsible_id', 'id');
    }

    public function voucher(){
        return $this->belongsToMany(Voucher::class, 'user_user_voucher', 'user_id', 'voucher_id')->withTimestamps();
    }

    public function referal(){
        return $this->hasOne(Referal::class, 'user_id', 'id');
    }

    public function claim(){
        return $this->belongsToMany(Referal::class, 'referal_has_users', 'user_id', 'referal_id')->withTimestamps();
    }

    public function saldo(){
        return $this->hasMany(Saldo::class, 'user_id', 'id')->whereHas('transaction', function($trans){
            $trans->where('status', 'success');
        })->orderBy('created_at', 'desc');
    }
}

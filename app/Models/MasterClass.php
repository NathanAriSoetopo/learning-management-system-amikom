<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterClass extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'master_class';
    protected $guarded = ['id'];
    protected $fillable = ['event_id', 'name', 'slug', 'image', 'active_dashboard', 'status', 'price', 'duration', 'description'];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function class(){
        return $this->hasMany(ClassModel::class, 'master_class_id', 'id');
    }

    public function mentee(){
        return $this->belongsToMany(User::class ,'user_has_class', 'master_class_id', 'user_id')->withPivot('status')->withTimestamps();
    }

    public function materials(){
        return $this->hasMany(MasterClassMaterial::class, 'master_class_id', 'id')->orderBy('created_at');
    }

    public function scopeGetEvent($query, $event){
        if($event){
            return $query->where('event_id', $event);
        }

        return $query;
    }

    public function scopeGetDashboard($query, $dashboard){
        if($dashboard != null){
            return $query->where('active_dashboard', $dashboard);
        }

        return $query;
    }
}

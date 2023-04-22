<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, Uuids;
    protected $table = 'transaction_log';
    protected $guarded = ['id'];

    public function master_class(){
        return $this->belongsTo(MasterClass::class, 'master_class_id', 'id');
    }
}

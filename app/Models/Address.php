<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','name', 'phone', 'address', 'city', 'note', "created_at", "updated_at", "deleted_at"];

    public function users() {
        return $this->belongsTo(User::class);
    }

    static public function getOrderAddress($id) {
        return Address::withTrashed()->where('id', $id)->first();
    }
}

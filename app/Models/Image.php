<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name','extension','path','imageable_id','imageable_type','created_at','updated_at'];
    public function imageable()
    {
        return $this->morphTo();
    }
}

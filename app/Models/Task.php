<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name'];//讓tasks的name能被批量賦值

    public function user()
    {
        return $this->belongsTo(User::class);//與User model的關聯
    }
}

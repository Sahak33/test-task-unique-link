<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'generated_links'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

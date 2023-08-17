<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    public function transitions(): HasMany
    {
        return $this->hasMany(Transition::class, 'links_id','id');
    }
}

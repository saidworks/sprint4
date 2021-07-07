<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var bool
     */
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'slug',
        'title',
        'body'
    ];
}

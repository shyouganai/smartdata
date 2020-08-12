<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Author extends Model
{
    protected $guarded = [];
    protected $withCount = ["books"];
    protected $dates = ["birth_date", "died_date"];
    public $timestamps = null;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (Author $author) {
            unlink(public_path("images/" . $author->image));
        });
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format("Y-m-d") : "...";
    }

    public function getDiedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format("Y-m-d") : "...";
    }

    public function getBirthDateYearAttribute($value)
    {
        return $this->birth_date ? Carbon::parse($this->birth_date)->format("Y") : "...";
    }

    public function getDiedDateYearAttribute($value)
    {
        return $this->died_date ? Carbon::parse($this->died_date)->format("Y") : "...";
    }

    public function imageUrl()
    {
        return asset("images/" . $this->image);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Book extends Model
{
    protected $guarded = [];
    protected $with = ["author:id,name"];
    protected $casts = ["publication_date" => "date:Y"];
    public $timestamps = null;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($book) {
            unlink(public_path("images/" . $book->image));
        });
    }

    public function getPublicationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format("Y-m-d") : null;
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function imageUrl()
    {
        return asset("images/" . $this->image);
    }
}

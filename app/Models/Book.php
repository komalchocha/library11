<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'auther',
        'category_id',
        'image',
        'description',
        'books',
    ];
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/image' . '/' . $value) : NULL;
    }
    public function getcategory()
    {
        return $this->hasOne(BookCategory::class, 'id', 'category_id');
    }
    public function bookissue()
    {
        return $this->hasMany(BookIssue::class, 'book_id', 'id');
    }
  
    public function bookissued()
    {
        return $this->hasMany(BookIssue::class, 'book_id');
    }
  
}

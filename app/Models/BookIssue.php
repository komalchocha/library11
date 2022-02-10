<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'fine_ammount',
        'status',
        'book_status',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }
    public function getcreatedAtAttribute($value)
    {
        return date('d-m-yy', strtotime($value));
    }
    public function getupdatedAtAttribute($value)
    {
        return date('d-m-yy', strtotime($value));
    }
    
    
    
    
}

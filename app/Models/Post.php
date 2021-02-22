<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Models\User;
use App\Http\Controllers\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    // This is so you can only like posts once
    public function likedBy(User $user)
    {   
       return $this->likes->contains('user_id', $user->id); 
       // contains() is a laravel connection method so right now 
       // we added the user id and we check if 
       // the user with that id already liked the post 
    } 

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function likes() 
    {   
        return $this->hasMany(Like::class);
    }
}

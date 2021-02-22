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

    // function to check which posts are yours and you can delete
    public function ownedBy(User $user)
    {
        return $user->id === $this->user_id;
        // this will check if the user id is equal to the post user_id 
        // so if user.id = 1 and user_id=1 it is yours and you can delete it
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    // Model relations -------------------------------------------
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Business logic for model -----------------------------------
    public function isAllowedToEdit(User $user): bool
    {
        if($user->superadmin) {
            return true;
        }

        return $user->id == $this->user_id;
    }


}

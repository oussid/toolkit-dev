<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'address', 'niche', 'website', 'user_id', 'status', 'contacted_at', 'email', 'rating', 'contacted_by', 'recontact_at', 'notes'] ;

    public function projects () {
        return $this->hasMany(Project::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function contacter () {
        return $this->belongsTo(User::class, 'contacted_by');
    }
}

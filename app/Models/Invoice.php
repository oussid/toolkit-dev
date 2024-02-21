<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "project_id",
        "services",
        "is_paid",
        "total",
        "generated_id"
    ];

    public function project(){

        return $this->belongsTo(Project::class,"project_id");
    }
}

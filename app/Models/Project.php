<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Business;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'total_paid', 'business_id', 'status', 'objectives', 'start_date', 'finish_date', 'notes'];

    public function business () {
        return $this->belongsTo(Business::class);
    }

    public function invoice () {
        return $this->hasOne(Invoice::class);
    }
}

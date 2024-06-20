<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    public $table = "jobs";

    public function job_type() {
        return $this->belongsTo(JobNature::class);
    }

    public function category() {
        return $this->belongsTo(JobTypes::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applyJob extends Model
{
    public $table = "job_applications";

    public function job() {
        return $this->belongsTo(Jobs::class);
    }


}

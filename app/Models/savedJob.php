<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedJob extends Model
{
    protected $table = "saved_jobs";

public function job()
{

    return $this->belongsTo(Jobs::class);

}





}

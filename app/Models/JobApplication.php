<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;

    protected $fillable = ['expected_salary','user_id','my_job_id','cv_path'];

    // public function job():BelongsTo{
    //     return $this->belongsTo(MyJob::class);
    // }

    public function job()
    {
        return $this->belongsTo(MyJob::class, 'my_job_id'); // Specify 'my_job_id' as the foreign key
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

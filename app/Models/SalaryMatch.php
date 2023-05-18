<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryMatch extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'employer_email',
        'is_matched',
        'job',
        'job_seeker',
        'contract_id',
        'currency_id',
        'job_seeker_id',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class);
    }
}

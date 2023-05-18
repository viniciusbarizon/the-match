<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [];

    public function salaryMatches(): HasMany
    {
        return $this->hasMany(SalaryMatch::class);
    }

    public function salaryRequirements(): HasMany
    {
        return $this->hasMany(SalaryRequirement::class);
    }
}

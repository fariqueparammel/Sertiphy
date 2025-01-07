<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Projects extends Model
{
    use HasFactory;
    protected $table = 'projectName';
    protected $fillable = [
        'Project',
        'user_id',
    ];
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function FieldData(): HasMany
    {
        return $this->hasMany(FieldData::class);
    }
}

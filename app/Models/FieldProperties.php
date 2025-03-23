<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Projects;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class FieldProperties extends Model
{
    use HasFactory;
    protected $table = 'fieldProperties';
    // protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'project_id', 'field_properties', 'fieldDescription'];

    public function Projects(): BelongsTo
    {
        return $this->belongsTo(Projects::class);
    }
}

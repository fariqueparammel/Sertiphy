<?php

namespace App\Models;

use app\Models\Projects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FieldData extends Model
{
    use HasFactory;
    protected $table = 'excelUploadData';
    protected $primaryKey = 'id';
    protected $fillable = [
        'project_id',
        'fieldData'
    ];



    public function Projects(): BelongsTo
    {
        return $this->belongsTo(Projects::class);
    }
}

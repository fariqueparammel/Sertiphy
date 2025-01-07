<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use App\Models\FieldData;
use Illuminate\Support\Facades\Session;


class ExcelDataImport implements ToModel, WithHeadingRow, WithSkipDuplicates
{
    protected $recordId;

    public function __construct($recordId)
    {
        $this->recordId = $recordId; // Assign the passed value to the class property
    }

    public function model(array $row)
    {
        if (isset($this->recordId)) {
        }
        return new FieldData([
            'project_id' => $this->recordId, // Correctly use the class property
            'fieldData' => json_encode($row), // Save the row data as JSON
        ]);
        // Session::forget('projectId');
    }
}

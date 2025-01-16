<?php

namespace App\Http\Controllers;


use App\Imports\ExcelDataImport;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;



class uploadFile extends Controller
{
    public function store(Request $request)
    {

        $file = $request->file('file');





        $validatedData = $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv,xml|max:10000',


        ]);

        if ($request->file('file')->isValid()) {


            $validatedData['file']->store('public/files');

            $this->import();

            Notification::make()
                ->title('Upload Successful')
                ->success()
                ->body('Your file has been uploaded successfully!')
                ->send();

            return redirect('/certificate-designer');
            // return back()->with('success', 'File uploaded successfully!');
        }
        Notification::make()
            ->title('Upload Failed')
            ->danger()
            ->body('There was an issue with the file upload. Please try again.')
            ->send();

        return redirect()->back();
        // return back()->with('error', 'File upload failed');
    }
    public function import()
    {
        $recordId =  Session::get('projectId');
        // Session::forget('projectId');
        Excel::import(new ExcelDataImport($recordId), request()->file('file'));
    }
}

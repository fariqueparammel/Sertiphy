  <?php

    use App\Http\Controllers\presetTemplateImage;
    use App\Http\Controllers\routeToDownloadPage;
    use App\Http\Controllers\uploadFile;
    use Illuminate\Support\Facades\Route;




    // Route::get('/certificate-designer', function () {
    //     $files = (new PresetTemplateImage())->getImage(); // Fetch image URLs
    //     return view('filament.app.pages.certificate-designer', ['files' => $files]); // Pass to view
    // });

    // Route::get('/certificate-designer', [presetTemplateImage::class, 'getImage']);
    Route::post('/upload', [UploadFile::class, 'store'])->name('upload');
    Route::get('/phpinfo', function () {
        phpinfo();
    });
    Route::get('/generation', [routeToDownloadPage::class, 'handleRouting']);
    //    Route::get('/download')->View('filament.app.resources.projects-resource.pages.download-certificates');

    // Route::get('/project/download/{id}', [ProjectController::class, 'download'])
    // ->name('project.download');
    // Route::get('/upload', [uploadFile::class, 'store']);
    ?>

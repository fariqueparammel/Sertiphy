  <?php

    use App\Http\Controllers\presetTemplateImage;
    use App\Http\Controllers\uploadFile;
    use Illuminate\Support\Facades\Route;




    // Route::get('/certificate-designer', function () {
    //     $files = (new PresetTemplateImage())->getImage(); // Fetch image URLs
    //     return view('filament.app.pages.certificate-designer', ['files' => $files]); // Pass to view
    // });

    // Route::get('/certificate-designer', [presetTemplateImage::class, 'getImage']);
    Route::post('/upload', [UploadFile::class, 'store'])->name('upload');
    // Route::get('/upload', [uploadFile::class, 'store']);
    ?>

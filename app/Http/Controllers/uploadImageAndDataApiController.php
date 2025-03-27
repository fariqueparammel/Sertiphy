<?php

namespace App\Http\Controllers;

use App\Models\FieldProperties;
use Illuminate\Http\Request;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class uploadImageAndDataApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function uploadImages(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $projectId = Session::get('projectId');

    //     if (!$user_id) {
    //         return response()->json(['error' => 'User not authenticated'], 401);
    //     }

    //     if (!$projectId) {
    //         return response()->json(['error' => 'Project ID not found in session'], 400);
    //     }

    //     return response()->json([
    //         'user_id' => $user_id,
    //         'project_id' => $projectId
    //     ]);
    // }

    public function uploadImages(Request $request)
    {
        // Validate the request
        try {
            // Perform validation
            $validatedData = $request->validate([
                'images' => 'nullable|array|required_without:selectedImageUrl',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:10000',
                'jsonObject' => 'required|string',
                'project_id' => 'required|string',
                'user_id' => 'required|string',
                'selectedImageUrl' => 'nullable|string|required_without:images',
            ]);

            // If validation passes, continue with your logic

        } catch (ValidationException $e) {
            // Return JSON response with validation errors
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        //$projectId = 54;
        $user_id = $request->input('user_id');
        $projectId = $request->input('project_id');
        $selectedImageUrl = $request->input('selectedImageUrl');
        // dump($user_id);
        // dump($selectedImageUrl);
        // dump($projectId);






        if (!$user_id || !$projectId) {
            // dump("project/userid nill");
            return response()->json([
                'message' => 'Authentication or project ID is missing.',
            ], 400);
        }
        $jsonObject = json_decode($request->input('jsonObject'), true);
        // dump($jsonObject);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'message' => 'Invalid JSON object.',
            ], 400);
        }
        $uploadedImages = [];
        if ($request->file('images') != null) {        // Loop through the uploaded files
            foreach ($request->file('images') as $image) {

                $storagePath = "user-uploads/user_id_{$user_id}/project_id_{$projectId}";

                // Store the image in DigitalOcean Spaces
                try {
                    // $image = $request->file('images');
                    $path = Storage::disk('digitalOceanSpaces')->put($storagePath, $image, 'public');
                    $url = Storage::url($path);

                    // Add the URL to the array
                    $uploadedImages[] = $url;
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'Failed to upload one or more images.',
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }
        }

        // 'user_id', 'project_id', 'field_properties', 'fieldDescription'
        if ($selectedImageUrl != null && !str_starts_with($selectedImageUrl, 'blob:')) {
            // dump($selectedImageUrl);
            $imageUrl = ["url" => $selectedImageUrl];
            $url = json_encode($imageUrl);
            $image = "image0";
            FieldProperties::insert([
                'user_id' => $user_id,
                'project_id' => $projectId,
                'fieldDescription' => $image,
                'field_properties' => $url,


            ]);
        }


        if ($uploadedImages != null) {
            $i = 1;
            foreach ($uploadedImages as $item) {
                $imageUrl = ["url" => $item];
                $url = json_encode($imageUrl);
                $image = "image" . $i;
                // dump($image);
                FieldProperties::insert([
                    'user_id' => $user_id,
                    'project_id' => $projectId,
                    'fieldDescription' => $image,
                    'field_properties' => $url,


                ]);
                $i++;
            }
            // foreach ($jsonObject as $item) {
            //     $propertyName = $item["key"];
            //     unset($item['key']);
            //     $properties = json_encode($item);
            //     FieldProperties::insert([
            //         'user_id' => $user_id,
            //         'project_id' => $projectId,
            //         'fieldDescription' => $propertyName,
            //         'field_properties' => $properties,


            //     ]);
            // }
        }
        foreach ($jsonObject as $item) {
            $propertyName = $item["key"];
            unset($item['key']);
            $properties = json_encode($item);
            FieldProperties::insert([
                'user_id' => $user_id,
                'project_id' => $projectId,
                'fieldDescription' => $propertyName,
                'field_properties' => $properties,


            ]);
        }
        // Notification::make()
        //     ->title('Upload Successful')
        //     ->body('All images have been uploaded successfully.')
        //     ->success()
        //     ->send();


        // return response("success", 200)
        //     ->header('Content-Type', 'text/plain');
        return response()->json([
            'message' => 'Images uploaded successfully',
            'images' => $uploadedImages,
            'properties' => $jsonObject,

        ]);
    }
}

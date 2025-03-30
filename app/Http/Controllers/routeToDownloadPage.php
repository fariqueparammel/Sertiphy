<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class routeToDownloadPage extends Controller
{
    public function  handleRouting(Request $request)
    {
        $data = null;
        $status = $request->input('status');
        // Check if the status is 200
        if ($request->input('status') == 200) {
            // Retrieve the project ID from the session
            // Session::get('projectId');
            $project_id = $request->input('project_id');
            // $project_id = 24;
            if (!$project_id) {
                return redirect()->back()->withErrors(['message' => 'Project ID not found in session.']);
            }

            try {
                // Make the API call with proper string interpolation
                $response = Http::get("http://127.0.0.1:8080/generate-certificates/{$project_id}");

                // Handle the API response
                if ($response->successful()) {
                    $data = $response->json();


                    // Optionally, redirect or return a response
                    // return redirect('/download')->with('success', 'Certificates generated successfully.');
                } else {

                    return redirect()->back()->withErrors(['message' => 'API call failed.']);
                }
            } catch (\Exception $e) {

                return redirect()->back()->withErrors(['message' => 'An error occurred while calling the API.']);
            }
        } else {
            // Handle invalid status
            return redirect()->back()->withErrors(['message' => 'Invalid status received.']);
        }
        // $response->json([
        //     'data' => $data,
        // ]);
        return $data;
    }
}

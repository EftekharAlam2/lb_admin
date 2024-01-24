<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Http;

class ProjectsController extends Controller
{

    public function index()
    {
        $projects = Project::all();

        $apiUrl = 'http://universities.hipolabs.com/search?country=United+States';
        $response = Http::get($apiUrl);
        $apiData = $response->json();

        $apiUrl2 = 'https://api.restful-api.dev/objects';
        $response2 = Http::get($apiUrl2);
        $apiData2 = $response2->json();

        return view('frontend.products', compact('projects','apiData', 'apiData2'));
    }

    public function postObjectToApi(Request $request)
    {
        $request->validate([
            'object_name' => 'required', 'string',
            'object_color' => 'string',
            'object_capacity' => 'string',
        ]);

        $postData = [
            'name' => $request->input('object_name'),
            'data' => [
                'color' => $request->input('object_color'),
                'capacity' => $request->input('object_capacity'),
            ],
        ];

        $apiUrl = 'https://api.restful-api.dev/objects';
        $response = Http::post($apiUrl, $postData);

        if ($response->successful()) {
            // return redirect()->back()->with('success', 'Object added successfully.');
            return response()->json(['message' => 'Object posted successfully to the API']);
        } else {
            return response()->json(['error' => 'Failed to post object to the API'], $response->status());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_category' => 'required', 'string',
            'project_name' => 'required', 'string',
            'project_image' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048',
        ]);

        $base64Image = base64_encode(file_get_contents($request->file('project_image')));

        Project::create([
            'project_category' => $request->input('project_category'),
            'project_name' => $request->input('project_name'),
            'project_image' => $base64Image,
        ]);

        return redirect()->back()->with('success', 'Project added successfully.');
    }

    // public function getProjectDetails($id)
    // {
    //     $project = Project::findOrFail($id);
       
    //     return response()->json($project);
    // }

    // public function updateProject(Request $request)
    // {
    //     try {
    //         $projectId = $request->input('editProjectId');
    
    //         // Log the project ID to check if it's received correctly
    //         \Log::info('Received project ID for update: ' . $projectId);
    
    //         $project = Project::findOrFail($projectId);
    
    //         // Log the retrieved project to check if it exists
    //         \Log::info('Retrieved project for update: ' . $project);
    
    //         $projectId = $request->input('editProjectId');

    //     $project = Project::findOrFail($projectId);
    //     $base64Image = base64_encode(file_get_contents($request->file('editProjectImage')));

    //     $project->update([
    //         'project_category' => $request->input('editProjectCategory'),
    //         'project_name' => $request->input('editProjectName'),
    //         'project_image' => $base64Image,
    //     ]);
    //     } catch (\Exception $e) {
    //         // Log any exception that occurs
    //         \Log::error('Exception in updateProject: ' . $e->getMessage());
    
    //         // Return an error response
    //         return response()->json(['error' => 'Error updating project']);
    //     }


    //     // $projectId = $request->input('editProjectId');

    //     // $project = Project::findOrFail($projectId);
    //     // $base64Image = base64_encode(file_get_contents($request->file('editProjectImage')));

    //     // $project->update([
    //     //     'project_category' => $request->input('editProjectCategory'),
    //     //     'project_name' => $request->input('editProjectName'),
    //     //     'project_image' => $base64Image,
    //     // ]);

    //     // $base64Image = $request->input('editProjectImage');
    //     // if ($base64Image) {
    //     //     // Decode the base64 string and save the image
    //     //     $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
    //     //     $imagePath = 'project_images/' . $projectId . '.png'; // You can change the file name or extension
    //     //     Storage::put($imagePath, $imageData);
    //     //     $project->update(['project_image' => $imagePath]);
    //     // }

    //     return response()->json(['success' => 'Project updated successfully']);
    // }

    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found.'], 404);
        }

        $project->delete();
        return response()->json(['success' => 'Project deleted successfully.']);
    }
}

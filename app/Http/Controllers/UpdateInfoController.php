<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpdateInfo;

class UpdateInfoController extends Controller
{
    public function edit()
    {
        // $updateInfo = UpdateInfo::latest()->first(); 
        $updateInfo = UpdateInfo::first();

        return view('frontend.update_info.edit', compact('updateInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'availability' => 'required', 'string',
        'my_info' => 'required', 'string',
        ]);

        UpdateInfo::latest()->update([
            'availability' => $request->input('availability'),
            'my_info' => $request->input('myInfo'),
        ]);

        return redirect()->back()->with('success', 'Information updated successfully.');
    }

    public function getUpdateInfo()
    {
        try {
            $updateInfo = UpdateInfo::firstOrFail();
            return response()->json($updateInfo);
        } catch (\Exception $e) {
            Log::error('Error in getUpdateInfo: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

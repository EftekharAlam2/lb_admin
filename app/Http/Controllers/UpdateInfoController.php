<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UpdateInfo;

class UpdateInfoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'availability' => 'required' ,'string',
            'myInfo' => 'required', 'string',
        ]);

        try {
            $updateInfo = UpdateInfo::firstOrFail();
            $updateInfo->update([
                'availability' => $request->input('availability'),
                'my_info' => $request->input('myInfo'),
            ]);

            return response()->json(['success' => 'Information updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in updateInfo: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
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

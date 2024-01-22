<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\AdditionalInfo;

class AdditionalInfoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|email',
            'experience' => 'required|integer',
            'projects' => 'required|integer',
            'awards' => 'required|integer',
            'customers' => 'required|integer',
        ]);

        try {
            $updateInfo = AdditionalInfo::firstOrFail();
            $updateInfo->update([
                'name' => $request->input('name'),
                'birthday' => $request->input('birthday'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'experience' => $request->input('experience'),
                'projects_finished' => $request->input('projects'),
                'awards' => $request->input('awards'),
                'customers' => $request->input('customers'),
            ]);

            return response()->json(['success' => 'Information updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in updateInfo: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getAdditionalInfo()
    {
        try {
            $additionalInfo = AdditionalInfo::firstOrFail();
            return response()->json($additionalInfo);
        } catch (\Exception $e) {
            Log::error('Error in getAdditionalInfo: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

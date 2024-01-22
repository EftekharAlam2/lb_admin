<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInfo;

class AdditionalInfoController extends Controller
{
    public function edit()
    {
        $additionalInfo = AdditionalInfo::first();

        return view('frontend.additional_info.edit', compact('additionalInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|email',
            'experience' => 'required|integer',
            'projects_finished' => 'required|integer',
            'awards' => 'required|integer',
            'customers' => 'required|integer',
        ]);

        AdditionalInfo::latest()->update([
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'experience' => $request->input('experience'),
            'projects_finished' => $request->input('projects_finished'),
            'awards' => $request->input('awards'),
            'customers' => $request->input('customers'),
        ]);

        return redirect()->back()->with('success', 'Information updated successfully.');
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

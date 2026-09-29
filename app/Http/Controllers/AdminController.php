<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function midwifeRequests()
    {
        $requests = User::where('role', 'midwife')->with('midwife.area')->get();
        return view('admin.midwife-requests', compact('requests'));
    }

    public function approveMidwife($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'midwife') {
            abort(403);
        }

        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'Midwife approved successfully.');
    }

    public function rejectMidwife($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'midwife') {
            abort(403);
        }

        $user->status = 'rejected';
        $user->save();

        return redirect()->back()->with('success', 'Midwife rejected.');
    }
}

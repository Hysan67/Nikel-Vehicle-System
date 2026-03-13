<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function approve(Request $request, $id)
    {
        $approval = \App\Models\Approval::findOrFail($id);
        
        if ($approval->user_id !== auth()->id()) abort(403);

        $approval->update([
            'status' => 'approved',
            'comment' => $request->comment,
        ]);

        $booking = $approval->booking;

        // Check if all approvals for this booking are now approved
        $pendingApprovals = \App\Models\Approval::where('booking_id', $booking->id)
            ->where('status', '!=', 'approved')
            ->count();
            
        if ($pendingApprovals === 0) {
            $booking->update(['status' => 'approved']);
        }

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'APPROVE_BOOKING',
            'description' => "Approved booking #{$booking->id} at level {$approval->level}",
            'ip_address' => $request->ip(),
        ]);

        return back();
    }

    public function reject(Request $request, $id)
    {
        $approval = \App\Models\Approval::findOrFail($id);
        $approval->update(['status' => 'rejected', 'comment' => $request->comment]);
        $approval->booking->update(['status' => 'rejected']);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'REJECT_BOOKING',
            'description' => "Rejected booking #{$approval->booking_id}",
            'ip_address' => $request->ip(),
        ]);

        return back();
    }
}

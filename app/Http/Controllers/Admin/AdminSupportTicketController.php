<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class AdminSupportTicketController extends Controller
{
    public function supportTickets()
    {
        $tickets = SupportTicket::with('user')->latest()->paginate(15);
        return view('admin.support-tickets', compact('tickets'));
    }

    public function updateTicketStatus(\App\Http\Requests\UpdateTicketStatusRequest $request, SupportTicket $ticket) 
    {
        try {
            $validated = $request->validated();

            if (!$ticket) {
                // Highlight: Null-safety explicit route model binding check
                throw new \UnexpectedValueException('Support ticket record no longer exists.');
            }

            $currentStatus = $ticket->status;
            $newStatus = $validated['status'];

            // Highlight: Enforced uni-directional ticket progression mapping
            $hierarchy = ['open' => 1, 'in_progress' => 2, 'resolved' => 3];

            if ($hierarchy[$newStatus] < $hierarchy[$currentStatus]) {
                throw new \DomainException("Invalid transition: Cannot downgrade ticket from '{$currentStatus}' to '{$newStatus}'.");
            }

            $ticket->status = $newStatus;
            $ticket->save();

            return back()->with('success', 'Ticket status updated.');
            
        } catch (\DomainException | \UnexpectedValueException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while updating the ticket status.');
        }
    }
}

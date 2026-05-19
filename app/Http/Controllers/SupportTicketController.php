<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    /**
     * Store a newly created support ticket in storage.
     *
     * @param Request $request The incoming HTTP request containing the ticket details.
     * @return RedirectResponse Redirect back giving a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'reference_id' => 'nullable|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'reference_id' => $request->reference_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Diagnostic ticket transmitted successfully.');
    }
}

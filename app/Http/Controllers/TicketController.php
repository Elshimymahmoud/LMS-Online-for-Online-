<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreated;
use App\Models\Ticket;
use App\Notifications\Backend\NewMessage;
use App\Notifications\Frontend\TaskCompleted;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class TicketController extends Controller
{
    // Display the ticket creation form
    public function index()
    {
        // If the user is authenticated, get their tickets
        $tickets = [];
        if (Auth::check()) {
            $tickets = Ticket::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        }
        return view('frontend.tickets.index', ['tickets' => $tickets]);
    }

    // Handle the ticket creation form submission
    public function store(Request $request)
    {

        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,xls',
        ]);

        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('frontend.auth.login')->withFlashDanger(__('alerts.backend.general.must_login'));
        }

        // Generate a unique code
        $code = Str::random(10);

        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'status' => 'opened',
            'subject' => $request->title,
            'last_updated_by' => Auth::id(),
            'code' => $code,
        ]);

        // Create the ticket message
        $message = $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->description,
        ]);

        // Check if the request contains a file
        if ($request->hasFile('attachment')) {
            // Store the file and get its path
            $path = $request->file('attachment')->store('attachments');

            // Update the message with the path of the file
            $message->update([
                'attachment' => $path,
            ]);
        }

        // Send an email notification
        Mail::to($ticket->user->email)->send(new TicketCreated($ticket));

        // Redirect the user to their tickets
        return redirect()->route('tickets.show', ['ticket' => $ticket->code]);
    }

    // Display the user's tickets
    public function show()
    {
        $ticket = Ticket::where('code', request('ticket'))->firstOrFail();
        // Ensure the user is authorized to view the ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
        // Load the ticket messages
        $ticket->load('messages');
        // Return the tickets to the user
        return view('frontend.tickets.show', ['ticket' => $ticket]);
    }

    // Handle the ticket message form submission
    public function send(Request $request)
    {
        // Validate the form data
        $request->validate([
            'message' => 'required|string',
//            'attachment' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,xls',
            'ticket_id' => 'required|exists:tickets,code',
        ]);

        // Find the ticket
        $ticket = Ticket::where('code', $request->ticket_id)->firstOrFail();

        // Ensure the user is authorized to view the ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        // Create the ticket message
        $message = $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Check if the request contains a file
        if ($request->hasFile('attachment')) {
            // Store the file and get its path
            $path = $request->file('attachment')->store('attachments');

            // Update the message with the path of the file
            $message->update([
                'attachment' => $path,
            ]);
        }

        // Notify the user that the message was sent
        auth()->user()->notify(new NewMessage($ticket));

        $response = [
            'status' => 'success',
            'message' => $request->message,
            'ticket' => $ticket->code,
            'user' => [
                'full_name' => Auth::user()->full_name,
                'avatar' => Auth::user()->avatar(),
            ],
        ];

        // Return success response
        return response()->json($response);

    }
}

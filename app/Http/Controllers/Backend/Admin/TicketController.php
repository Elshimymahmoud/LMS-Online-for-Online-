<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TicketResponded;
use App\Models\Auth\User;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Notifications\Backend\NewMessage;
use App\Notifications\Backend\TicketStatus;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Mail;

class TicketController extends Controller
{
    // Display all tickets
    public function index(Request $request)
    {
        return view('backend.tickets.index');
    }

    // Display chat for specific ticket
    public function show(Request $request)
    {
        $tickets = Ticket::where('admin_id', Auth::id())->get();
        $ticket = Ticket::where('code', request('ticket'))->firstOrFail();

        $agent = new Agent();

        if($agent->isMobile()){
            $view = 'backend.tickets.index-desktop';
        }else{
            $view = 'backend.tickets.index-desktop';
        }
        return view($view, ['tickets' => $tickets, 'ticket' => $ticket]);
    }

    public function getData(Request $request): \Illuminate\Http\JsonResponse
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;

        $query = Ticket::query()->orderBy('created_at', 'desc');

        $tickets = $query->with(['messages'])->paginate($length, ['*'], 'page', $page);
        $data = [];
        $counter = 1;

        foreach ($tickets as $ticket) {
            $data[] = [
                'DT_RowIndex' => $counter,
                'id' => $ticket->id,
                'code' => $ticket->code,
                'subject' => $ticket->subject,
                'status' => $ticket->status,
                'created_at' => $ticket->created_at->format('Y-m-d - A h:i'),
                'updated_at' => $ticket->updated_at->format('Y-m-d H:i:s'),
                'updated_by' => $ticket->lastUpdatedBy ? ((app()->getLocale() == 'ar') ?
                        $ticket->lastUpdatedBy->full_name_ar : $ticket->lastUpdatedBy->full_name) : 'N/A',
                'name' => ((app()->getLocale() == 'ar') ? $ticket->user->full_name_ar : $ticket->user->full_name),
                'email' => $ticket->user->email,
                'messages' => $ticket->messages->count(),
                'assigned_support' => $ticket->admin ? ((app()->getLocale() == 'ar') ?
                        $ticket->admin->full_name_ar : $ticket->admin->full_name) : 'N/A',
                'actions' => '<a href="' . route('admin.tickets.show', ['ticket' => $ticket->code]) . '" class="btn btn-primary btn-sm">'.__('labels.backend.tickets.fields.view').'</a>',
            ];
            $counter++;

        }

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $tickets->total(),
            'recordsFiltered' => $tickets->total(),
            'data' => $data,
        ];

        return response()->json($response);
    }

    public function update()
    {

    }
    public function storeMessage(Request $request)
    {
        // Validate the request...
        $request->validate([
            'message' => 'required|string',
        ]);

        // Find the ticket
        $ticket = Ticket::where('code', $request->ticket_id)->firstOrFail();

        // Make admin the last updated by and assign the ticket to the admin
        $ticket->last_updated_by = Auth::id();
        $ticket->admin_id = Auth::id();
        $ticket->status = 'in_progress';
        $ticket->save();

        // Create the message
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

        // Send an email notification
//        Mail::to($ticket->user->email)->send(new TicketResponded($ticket));

        // Notify the user
        $ticket->user->notify(new NewMessage($ticket));

        // Redirect the admin back to the ticket's messages
        return back();
    }

    public function updateStatus(Request $request)
    {
        // Find the ticket
        $ticket = Ticket::where('code', $request->ticket_id)->firstOrFail();

        // Check if admin is assigned to the ticket
        if ($ticket->admin_id != Auth::id()) {
            // Redirect the support back to the ticket's messages
            return response()->json([
                'status' => 'error',
                'message' => __('alerts.backend.tickets.not_assigned'),
            ]);
        }

        // Check if status will be reopned
        if ($request->status == 'opened') {
            // Make the ticket status opened
            $ticket->status = $request->status;
            $ticket->save();

            // Create a message that the ticket is reopened
            $ticket->messages()->create([
                'user_id' => Auth::id(),
                'message' => __('labels.backend.tickets.msg.reopened'),
            ]);

            // Notify the user
            $ticket->user->notify(new TicketStatus($ticket));

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => __('labels.backend.tickets.status.reopened'),
            ]);
        }

        // Update the ticket status
        $ticket->status = $request->status;
        $ticket->save();

        // Create a message that the ticket status is updated
        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => __('labels.backend.tickets.msg.'.$ticket->status),
        ]);

        // Notify the user
        $ticket->user->notify(new TicketStatus($ticket));

        // Redirect the support back to the ticket's messages
        return response()->json([
            'status' => 'success',
            'message' => __('alerts.backend.tickets.status_updated'),
        ]);    }
}

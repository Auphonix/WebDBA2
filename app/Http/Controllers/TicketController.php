<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\QueryRequest;


class TicketController extends Controller
{

//    Prevents user from accessing tickets if not logged in
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all the tickets by ID in descending order and limit to 5 per page
        // Paginate automatically adds index at bottom of page to switch through pages
        $tickets = Ticket::orderBy('id', 'DESC')->paginate(5);
        return view('ticket.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('ticket.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueryRequest $request)
    {
        $allRequests = $request->all();

        // Save to DB
        $this->saveTicket($allRequests);

        // Finish store
//        FIXME DIRECT STRAIGHT TO TICKET e.g. ticket/show/{ticketid}
        return redirect()->route('ticket.index')->with('success', 'Query added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('User')->find($id);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $allrequests = $request->all();
        $userDetails = array('firstName' => $allrequests['firstName'], 'lastName' => $allrequests['lastName'],
            'email' => $allrequests['email']);
        $ticketDetails = array('status' => $allrequests['status'], 'userEmail' => $allrequests['email'], 'operatingSystem' => $allrequests['operatingSystem'],
            'issue' => $allrequests['issue'], 'description' => $allrequests['description']);

        Ticket::find($id)->update($ticketDetails);
        User::find(Ticket::find($id)->userEmail)->update($userDetails);
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Removes all associated comments
        $comments = Comment::where('ticketID', $id)->get();
        foreach ($comments as $comment) {
            $comment->delete();
        }

        // Removes the ticket
        Ticket::find($id)->delete();

        // Returns to the index page with success
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully');
    }

    /*---------HELPER METHODS-------------*/

    // Save new User to DB
    private function saveUser($allRequests)
    {
        $user = new User;
        $user->email = $allRequests['email'];
        $user->firstName = $allRequests['firstName'];
        $user->lastName = $allRequests['lastName'];
        $user->isAdmin = $allRequests['isAdmin'];
        $user->save();
    }

    // Save new Ticket to DB
    private function saveTicket($allRequests)
    {
        $ticket = new Ticket();
        $ticket->useremail = $allRequests['email'];
        $ticket->operatingSystem = $allRequests['operatingSystem'];
        $ticket->status = "Pending";
        $ticket->issue = $allRequests['issue'];
        $ticket->description = $allRequests['description'];
        $ticket->save();
    }
}

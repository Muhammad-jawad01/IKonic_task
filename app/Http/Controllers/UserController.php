<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Connection;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function suggestions()
    {
        $currentUserId = auth()->user()->id;

        // Find users who are not yet connected to the current user and haven't received invitations
        $suggestions = User::whereDoesntHave('connections', function ($query) use ($currentUserId) {
            $query->where('connected_user_id', $currentUserId);
        })
            ->whereDoesntHave('receivedInvitations', function ($query) use ($currentUserId) {
                $query->where('invited_user_id', $currentUserId);
            })
            ->where('id', '!=', $currentUserId)
            ->get();

        $html = view('components.suggestion', ['suggestions' => $suggestions])->render();

        return response()->json(['html' => $html]);
    }

    public function sendConnectionRequest($id)
    {
        $currentUserId = auth()->user()->id;
        $user = User::findOrFail($id);

        // Check if a connection request already exists between these two users
        if (!Connection::where('user_id', $currentUserId)->where('connected_user_id', $user->id)->exists()) {

            if (!Invitation::where('user_id', $currentUserId)->where('invited_user_id', $user->id)->exists()) {
                // Send the connection request
                Invitation::create([
                    'user_id' => $currentUserId,
                    'invited_user_id' => $user->id,
                ]);
            } else {
                return 'False';
            }
        }
        return 'Done';
    }
    public function receivedRequests()
    {
        $currentUserId = auth()->user()->id;

        // Get the connection requests sent to the current user
        $receivedRequests = Invitation::where('invited_user_id', $currentUserId)
            ->with('user')->get(); // Load the sender user relationship

        // dd($receivedRequests);
        $html = view('components.request', ['receivedRequests' => $receivedRequests, 'mood' => 'received'])->render();

        return response()->json(['html' => $html]);
    }


    public function acceptRequest($id)
    {
        $currentUserId = auth()->user()->id;

        $invitation = Invitation::findOrFail($id);

        // Check if the invitation is valid and sent to the current user
        if ($invitation->invited_user_id !== $currentUserId) {
            abort(403, 'Unauthorized');
        }

        // Create a new connection between the current user and the sender
        Connection::create([
            'user_id' => $currentUserId,
            'connected_user_id' => $invitation->user_id,
        ]);

        // Delete the invitation (optional: you can keep it for reference)
        $invitation->delete();
        return 'Done';
    }

    public function connections()
    {
        $currentUser = auth()->user();

        // Get the current user's connections
        $connections = Connection::where('user_id', $currentUser->id)
            ->with('connectedUser') // Load the connectedUser relationship
            ->get();

        // Calculate the count of common connections for each connected user
        foreach ($connections as $connection) {
            $connectedUser = $connection->connectedUser;
            $commonConnectionsCount = count(
                array_intersect(
                    $currentUser->connections->pluck('connected_user_id')->toArray(),
                    $connectedUser->connections->pluck('connected_user_id')->toArray()
                )
            );
            $connectedUser->commonConnectionsCount = $commonConnectionsCount;
        }
        $html = view('components.connection', ['connections' => $connections])->render();
        return response()->json(['html' => $html]);
    }



    public function deleteInvitation($id)
    {
        $invitation = Invitation::findOrFail($id);
        $currentUserId = auth()->user()->id;
        // Check if the invitation belongs to the current user
        if ($invitation->invited_user_id !== $currentUserId) {
            abort(403, 'Unauthorized');
        }
        // Delete the invitation
        $invitation->delete();

        return 'Done';
    }

    public function deleteConnection($id)
    {
        $currentUser = auth()->user();

        $connection = Connection::findOrFail($id);
        // Check if the connection belongs to the current user
        if ($connection->user_id !== $currentUser->id) {
            abort(403, 'Unauthorized');
        }
        // Delete the connection
        $connection->delete();
        return 'Done';
    }


    public function commonConnections($userId)
    {
        $currentUserId = auth()->user()->id;
        if (!$userId || !is_numeric($userId)) {
            return response()->json(['error' => 'Invalid user ID provided.']);
        }
        $intValue = intval($userId);

        // Get the connections of the specific user
        $specificUserConnections = Connection::where('user_id', $intValue)->pluck('connected_user_id');
        // Get the connections of the current user
        $currentUserConnections = Connection::where('user_id', $currentUserId)->pluck('connected_user_id');
        // Get the connections in common between the current user and the specific user
        $commonConnections = $currentUserConnections->intersect($specificUserConnections);

        // Get the users who have the common connections with the specific user
        $commonConnectionUsers = User::whereIn('id', $commonConnections)->get();
        $html = view('components.connection_in_common', ['commonConnectionUsers' => $commonConnectionUsers])->render();

        return response()->json(['html' => $html]);
    }



    public function invitedUsers()
    {
        // $invitedUsers = auth()->user()->sentInvitations()->with('invitedUser')->get();
        $invitedUsers = Invitation::where('user_id', auth()->user()->id)
            ->with('invitedUser')
            ->get();

        $html = view('components.request', ['invitedUsers' => $invitedUsers, 'mood' => 'sent'])->render();
        return response()->json(['html' => $html]);
    }
}

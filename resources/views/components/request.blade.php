<div class="my-2 shadow text-white bg-dark p-1 " id="">
    <div class="d-flex justify-content-between">
        <div class="container">



            <div class="row">
                @if ($mood && $mood == 'sent')

                    <h1>Invited Users</h1>

                    @if ($invitedUsers->isEmpty())
                        <p>No users have been invited yet.</p>
                    @else
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invitedUsers as $data)
                                    <tr>
                                        <td>{{ $data->invitedUser->name }}</td>
                                        <td>

                                            <form action="{{ route('deleteInvitation', $data->id) }}"
                                                id="d{{ $data->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="task('d{{ $data->id }}', '{{ $data->id }}', 't2');return false;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif


                @endif
            </div>
            <div class="row">
                @if ($mood && $mood == 'received')
                    <h1>Received Connection Requests</h1>

                    @if ($receivedRequests->isEmpty())
                        <p>No connection requests received.</p>
                    @else
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receivedRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>

                                        <td colspan="4">
                                            <form action="{{ route('acceptRequest', $request->id) }}"
                                                id="f{{ $request->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="task('f{{ $request->id }}', '{{ $request->id }}', 't3');return false;">Accept</button>
                                            </form>
                                            <form action="{{ route('deleteInvitation', $request->id) }}"
                                                id="d{{ $request->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"class="btn btn-outline-primary"
                                                    onclick="task('d{{ $request->id }}', '{{ $request->id }}', 't3');return false;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

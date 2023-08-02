<div class="my-2 shadow text-white bg-dark p-1" id="">
    <div class="d-flex justify-content-between">

        <div class="container">
            <h1>My Connections</h1>

            @if ($connections->isEmpty())
                <p>No connections yet.</p>
            @else
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Common Connections</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($connections as $connection)
                            <tr>
                                <td> {{ $connection->connectedUser->name }}
                                </td>
                                <td> <button type="button" class="btn btn-outline-primary" d-e="t5"
                                        d-i="{{ $connection->connectedUser->id }}"
                                        onclick="task2(this);return false;">Common Connections:</button> (
                                    {{ $connection->connectedUser->commonConnectionsCount ?? 0 }})
                                </td>
                                <td>
                                    <form action="{{ route('deleteConnection', $connection->id) }}"
                                        id="f{{ $connection->id }}"method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="task('f{{ $connection->id }}','{{ $connection->id }}','t4');return false;">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
        </div>

        {{-- @dd($items); --}}
    </div>
    <div class="collapse" id="collapse_">

        <div id="content_" class="p-2">
            {{-- Display data here --}}
            <x-connection_in_common />
        </div>
        <div id="connections_in_common_skeletons_">
            {{-- Paste the loading skeletons here via Jquery before the ajax to get the connections in common --}}
        </div>

    </div>
</div>

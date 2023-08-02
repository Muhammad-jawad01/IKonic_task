<div class="my-2 shadow  text-white bg-dark p-1" id="">
    <div class="d-flex justify-content-between">

        <div class="container">
            <h1>Suggestions</h1>

            @if ($suggestions->isEmpty())
                <p>No suggestions available.</p>
            @else
                {{-- <ul>
                    @foreach ($suggestions as $user)
                        <li>
                            {{ $user->name }}
                            <form action="{{ route('sendConnectionRequest', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit">Connect</button>
                            </form>
                        </li>
                    @endforeach
                </ul> --}}
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suggestions as $user)
                            <tr>
                                <td> {{ $user->name }}
                                </td>
                                <td>

                                    <form action="{{ route('sendConnectionRequest', $user->id) }}"
                                        id="f{{ $user->id }}"method="POST">

                                        @csrf
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="task('f{{ $user->id }}','{{ $user->id }}','t1');return false;">Connect</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>

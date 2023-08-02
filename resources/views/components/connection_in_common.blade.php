<div class="p-2 shadow rounded mt-2  text-white bg-dark">

    <!-- combine_connections.blade.php -->

    <h1>Combined Connections</h1>

    @if (!empty($commonConnectionUsers))
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>User Name</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($commonConnectionUsers as $user)
                    <tr>
                        <td> {{ $user->name }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <p>No combined connections found.</p>
    @endif

</div>

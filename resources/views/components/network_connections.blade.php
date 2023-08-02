<div class="row justify-content-center mt-5">
    <div class="col-12">
        <div class="card shadow  text-white bg-dark">
            <div class="card-header">Coding Challenge - Network connections</div>
            <div class="card-body">
                <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn allbtn btn-outline-primary" d-e="t1" for="btnradio1"
                        id="get_suggestions_btn">Suggestions
                        ()</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn allbtn btn-outline-primary" d-e="t2" for="btnradio2"
                        id="get_sent_requests_btn">Sent
                        Requests
                        ()</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn allbtn btn-outline-primary" d-e="t3" for="btnradio3"
                        id="get_received_requests_btn">Received
                        Requests()</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                    <label class="btn allbtn btn-outline-primary" d-e="t4" for="btnradio4"
                        id="get_connections_btn">Connections
                        ()</label>
                </div>
                <hr>



                <div id="my-container">

                </div>



            </div>
        </div>
    </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}

<div id="connections_in_common_skeleton" class="{{-- d-none --}}">
    <br>
    {{-- <span class="fw-bold text-white">Loading Skeletons</span> --}}
    <div class="px-2">
        @for ($i = 0; $i < 10; $i++)
            {{-- <x-skeleton /> --}}
        @endfor
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {

        $('.allbtn').click(function() {
            task2(this);
        });

    });

    function task2(e) {
        var tab = $(e).attr('d-e');
        var userId = $(e).attr('d-i');
        var url = "";
        var target = "my-container";
        if (tab === 't1') {
            url = "{{ route('suggestions') }}";

        } else if (tab === 't2') {
            url = "{{ route('invitedUsers') }}";

        } else if (tab === 't3') {
            url = "{{ route('receivedRequests') }}";

        } else if (tab === 't4') {
            url = "{{ route('connections') }}";

        } else if (tab === 't5') {
            url = "/common-connections/" + userId;

        }

        $.ajax({
            url: url, // The URL of your AJAX endpoint
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Insert the HTML response into the container
                $('#' + target).html(response.html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    }

    function task(e, id, t) {
        var url = $('#' + e).attr('action');
        var token = $("#" + e + " input[name=_token]").val();
        var f = new FormData();
        f.append('id', id);
        f.append('_token', token)
        $.ajax({
            url: url, // The URL of your AJAX endpoint
            data: f,
            processData: false,
            contentType: false,
            type: 'POST',

            processData: false,
            headers: {
                'X-CSRF-TOKEN': token
            }, // Add the CSRF token as a header

            success: function(r) {
                if (r === 'Done') {
                    $('#' + t).trigger('click');
                }

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>

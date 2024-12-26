@extends('index')

@section('title', 'Customer Portal')

@section('content')
    @csrf
    <div class="font-figtree text-center">
        <h1 class="text-4xl">Welcome to Laravel Broadcast Test</h1>
        <p class="text-lg">This is a test.</p>
        <div class="flex justify-center mt-8">
            <input type="text" class="p-2 border border-gray-300 rounded-lg" id="broadcast-msg" placeholder="This will be the broadcast message" />
            <button class="ml-2 p-2 bg-blue-500 text-white rounded-lg" id="broadcast-btn">Broadcast</button>
        </div>
    </div>
    <div id="test-echo"></div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var testEcho = document.getElementById('test-echo');
            window.Echo.channel('pingme').listen('PingEvent', (e) => {
                console.log(e);
                // Update the DOM with the event data
                const eventContainer = testEcho;
                if (eventContainer) {
                    eventContainer.innerText = e.message;
                    console.log('Event data updated');
                }
            });
            document.getElementById('broadcast-btn').addEventListener('click', function() {
                const message = document.getElementById('broadcast-msg').value;
                console.log('Broadcasting message:', message);
                window.axios.post('/broadcast', {
                    message: message
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    }
                }).then(function(response) {
                    console.log(response);
                }).catch(function(error) {
                    console.error(error);
                });
            });
        });
    </script>
@endsection

@extends('index')

@section('title', 'Customer Portal')

@section('content')
    @csrf
    <div class="font-figtree text-center">
        <h1 class="text-4xl">Welcome to Laravel Broadcast Test</h1>
        <p class="text-lg">This is a test.</p>
        <div class="flex justify-center mt-8">
            <div class="w-1/2 p-2">
                <input type="text" class="p-2 border border-gray-300 rounded-lg w-full" id="broadcast-msg-1" placeholder="This will be the broadcast message 1" />
                <button class="mt-2 p-2 bg-blue-500 text-white rounded-lg w-full" id="broadcast-btn-1">Broadcast 1</button>
            </div>
            <div class="w-1/2 p-2">
                <input type="text" class="p-2 border border-gray-300 rounded-lg w-full" id="broadcast-msg-2" placeholder="This will be the broadcast message 2" />
                <button class="mt-2 p-2 bg-blue-500 text-white rounded-lg w-full" id="broadcast-btn-2">Broadcast 2</button>
            </div>
        </div>
        <div class="flex justify-center mt-8">
            <div class="w-1/2 p-2">
                <h2 class="text-2xl">Broadcast 1</h2>
                <p id="test-echo-1"></p>
            </div>
            <div class="w-1/2 p-2">
                <h2 class="text-2xl">Broadcast 2</h2>
                <p id="test-echo-2"></p>
            </div>
        </div>
        <div class="flex justify-center mt-10">
            <div class="w-1/2 p-2">
                <input type="text" class="p-2 border border-gray-300 rounded-lg w-full" id="queue-msg" placeholder="This will be a queued message" />
                <button class="mt-2 p-2 bg-blue-500 text-white rounded-lg w-full" id="queue-btn">Queued message</button>
            </div>
            <div class="w-1/2 p-2">
                <p id="test-queue"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('[name="_token"]').value;

            var pingmeChannel = window.pusher.subscribe('pingme');
            var queuedChannel = window.pusher.subscribe('queued_testing');

            /**
             * Sends message to the server to trigger the broadcast
             * **/
            function sendMessage(route, message = 'Broadcast initiated', device = null) {
                let data = {
                    message: message,
                };
                if (device !== null) {
                    data.device = device;
                }
                window.axios.post(route, data,
                {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then(function(response) {
                    console.log(response);
                }).catch(function(error) {
                    console.error(error);
                });
            }

            /**
             * Subscribe to the channel and listen for the event
             * **/
            var testEcho1 = document.getElementById('test-echo-1');
            pingmeChannel.bind('App\\\Events\\\PingEvent', function(e) {
                console.log(e);
                // Update the DOM with the event data
                const eventContainer = testEcho1;
                if (eventContainer) {
                    eventContainer.innerText = e.message;
                    console.log('Event data updated');
                }
            });

            var testEcho2 = document.getElementById('test-echo-2');
            pingmeChannel.bind('App\\\Events\\\MessageEvent', function(e) {
                console.log(e);
                // Update the DOM with the event data
                const eventContainer = testEcho2;
                if (eventContainer) {
                    eventContainer.innerHTML = '<b>' + e.device + '</b><br>' + e.message;
                    console.log('Event data updated');
                }
            });

            var testQueue = document.getElementById('test-queue');
            queuedChannel.bind('App\\\Events\\\QueueEvent', function(e) {
                console.log(e);
                // Update the DOM with the event data
                const eventContainer = testQueue;
                if (eventContainer) {
                    eventContainer.innerHTML = e.message;
                    console.log('Event data updated');
                }
            });

            /**
             * Sends a broadcast message to the channel
             * **/
            document.getElementById('broadcast-btn-1').addEventListener('click', function() {
                const message = document.getElementById('broadcast-msg-1').value;
                sendMessage('broadcast', message);
            });

            document.getElementById('broadcast-btn-2').addEventListener('click', function() {
                const message = document.getElementById('broadcast-msg-2').value;
                sendMessage('send_message', message, 'web');
            });

            document.getElementById('queue-btn').addEventListener('click', function() {
                const message = document.getElementById('queue-msg').value;
                sendMessage('queued_message', message, 'web');
            });
        });
    </script>
@endsection

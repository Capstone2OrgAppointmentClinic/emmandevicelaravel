<!-- Chatbot Button -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@csrf
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<style>
    #chatbot-messages {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 10px;
}

.message {
    padding: 10px 15px;
    margin: 5px;
    border-radius: 15px;
    max-width: 70%;
    font-size: 15px;
    word-wrap: break-word;
}

.user-message {
    font-size: 15px;
    background-color: #00D95F;
    color: white;
    align-self: flex-end;
    text-align: left;
}

.bot-message {
    background-color: #E5E5E5;
    color: black;
    align-self: flex-start;
    text-align: left;
}

</style>
<div id="chatbot-container" >
    <button id="chatbot-toggle" style="background-color: #28a745;">💬 Chat with CliniQuickAid</button>
    <div id="chatbot-box">
        <div id="chatbot-header" style="background-color: #28a745;">
            CliniQuickAid <i class="fa-solid fa-stethoscope" style="margin-left:-8.7rem; margin-top: 3px;"></i><span id="close-chatbot">&times;</span>
        </div>
        <div id="chatbot-messages" style="max-height: 300px; overflow-y: auto;"></div>
        <input type="text" id="chatbot-input" placeholder="Type your message here..." style="margin-left: 2px;"/>
        <button id="chatbot-send" style="width: 53px; height: 48px; background-color:  #00D95F;" class="rounded-lg">➤</button>
    </div>
</div>

@include('user.botcss')

<!-- Chatbot Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
        $('#chatbot-toggle').click(function () {
            $('#chatbot-box').toggle();

            if($('#chatbot-messages .bot-message').length === 0) {
                $('#chatbot-messages').append('<div class="message bot-message" style="color:gray;">Hello! This is CliniQuickAid Chatbot 🩺 How can I help you today?</div>');
            }
        });

        $('#close-chatbot').click(function () {
            $('#chatbot-box').hide();
        });

        $('#chatbot-send').click(function () {
            sendMessage();
        });

        $('#chatbot-input').keypress(function (e) {
            if (e.which == 13) { 
                sendMessage();
            }
        });

        function sendMessage() {
            var message = $('#chatbot-input').val().trim();
            if (message === '') return;

            // Append user message (right side)
            $('#chatbot-messages').append('<div class="message user-message">' + message + '</div>');
            $('#chatbot-input').val('');

            // Scroll to bottom
            $('#chatbot-messages').scrollTop($('#chatbot-messages')[0].scrollHeight);

            $.ajax({
                url: '{{ route("chat") }}', 
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { message: message },
                success: function (response) {
                    // Append bot message (left side)
                    $('#chatbot-messages').append('<div class="message bot-message">' + response.reply + '</div>');

                    // Scroll to bottom
                    $('#chatbot-messages').scrollTop($('#chatbot-messages')[0].scrollHeight);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $('#chatbot-messages').append('<div class="message bot-message">An error occurred. Please try again.</div>');

                    // Scroll to bottom
                    $('#chatbot-messages').scrollTop($('#chatbot-messages')[0].scrollHeight);
                }
            });
        }
    });
</script>
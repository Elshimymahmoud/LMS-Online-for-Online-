@push('after-styles')
    <link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css"/>
    <style>
        p {
            font-weight: 600;

        }

        h5 {
            font-weight: bold;
            color: #800000;
        }

        h3 {
            color: white;
        }

        li span {
            font-size: 10px;
        }

        .fnt-wght-900 {
            font-weight: 900;

        }

        .welcome {
            padding: 15px;
            border-radius: 10px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            flex-direction: row;
        }
        .attachment{
            background-color: rgba(0, 0, 0, 0.5); /* Dark background */
            color: white; /* White text */
            padding: 5px; /* Some padding */
            margin-top: 10px; /* Some margin at the top */
            border-radius: 5px; /* Rounded corners */
        }
        .attachment a {
            color: aliceblue;
        }
    </style>
    <style>
        .--dark-theme {
            --chat-background: rgb(213 213 213 / 95%);
            --chat-panel-background: #959595;
            --chat-bubble-background: #6e6e6e;
            --chat-bubble-active-background: #ffffff;
            --chat-add-button-background: #ffffff;
            --chat-send-button-background: #ff5050;
            --chat-text-color: #ffffff;
            --chat-options-svg: #a3a3a3;
        }


        #chat {
            background: var(--chat-background);
            width: 100%;
            /*margin: 25px auto;*/
            box-sizing: border-box;

            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        #chat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(https://images.unsplash.com/photo-1495808985667-ba4ce2ef31b3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80) fixed;
            z-index: -1;
        }

        #chat .btn-icon {
            position: relative;
            cursor: pointer;
        }

        #chat .btn-icon svg {
            stroke: #FFF;
            fill: #FFF;
            width: 50%;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #chat .chat__conversation-board {
            padding: 1em 0 2em;
            height: 75%;
            overflow: auto;
        }

        #chat .chat__conversation-board__message-container.reversed {
            flex-direction: row-reverse;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__bubble {
            margin-left: 5px;
            position: relative;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__bubble span:not(:last-child) {
            margin: 0 0 2em 0;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__person {
            margin: 0 0 0 1.2em;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__options {
            align-self: center;
            position: absolute;
            left: 0;
            display: none;
        }

        #chat .chat__conversation-board__message-container {
            position: relative;
            display: flex;
            flex-direction: row;
        }

        #chat .chat__conversation-board__message-container:hover .chat__conversation-board__message__options {
            display: flex;
            align-items: center;
        }

        #chat .chat__conversation-board__message-container:hover .option-item:not(:last-child) {
            margin: 0 .5em 0 0;
        }

        #chat .chat__conversation-board__message-container:not(:last-child) {
            margin: 0 0 2em 0;
        }

        #chat .chat__conversation-board__message__person {
            text-align: center;
            margin: 0 1.2em 0 0;
        }

        #chat .chat__conversation-board__message__person__avatar {
            height: 35px;
            width: 35px;
            overflow: hidden;
            border-radius: 50%;
            user-select: none;
            ms-user-select: none;
            position: relative;
        }

        #chat .chat__conversation-board__message__person__avatar::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
        }

        #chat .chat__conversation-board__message__person__avatar img {
            height: 100%;
            width: auto;
        }

        #chat .chat__conversation-board__message__person__nickname {
            font-size: 9px;
            color: #484848;
            user-select: none;
            display: none;
        }

        #chat .chat__conversation-board__message__context {
            margin-right: 5px;
            max-width: 55%;
            align-self: flex-end;
        }

        #chat .chat__conversation-board__message__options {
            align-self: center;
            position: absolute;
            right: 0;
            display: none;
        }

        #chat .chat__conversation-board__message__options .option-item {
            border: 0;
            background: 0;
            padding: 0;
            margin: 0;
            height: 16px;
            width: 16px;
            outline: none;
        }

        #chat .chat__conversation-board__message__options .emoji-button svg {
            stroke: var(--chat-options-svg);
            fill: transparent;
            width: 100%;
        }

        #chat .chat__conversation-board__message__options .more-button svg {
            stroke: var(--chat-options-svg);
            fill: transparent;
            width: 100%;
        }

        #chat .chat__conversation-board__message__bubble span {
            width: fit-content;
            display: inline-table;
            word-wrap: break-word;
            background: var(--chat-bubble-background);
            font-size: 13px;
            color: var(--chat-text-color);
            padding: .5em .8em;
            line-height: 1.5;
            border-radius: 6px;
            font-family: 'Lato', sans-serif;
        }

        #chat .chat__conversation-board__message__bubble:not(:last-child) {
            margin: 0 0 .3em;
        }

        #chat .chat__conversation-board__message__bubble:active {
            background: var(--chat-bubble-active-background);
        }

        #chat .chat__conversation-panel {
            background: var(--chat-panel-background);
            border-radius: 12px;
            padding: 0 1em;
            height: 55px;
            margin: .5em 0 0;
        }

        #chat .chat__conversation-panel__container {
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 100%;
        }

        #chat .chat__conversation-panel__container .panel-item:not(:last-child) {
            margin: 0 1em 0 0;
        }

        #chat .chat__conversation-panel__button {
            background: grey;
            height: 20px;
            width: 30px;
            border: 0;
            padding: 0;
            outline: none;
            cursor: pointer;
        }

        #chat .chat__conversation-panel .add-file-button {
            height: 23px;
            min-width: 23px;
            width: 23px;
            background: var(--chat-add-button-background);
            border-radius: 50%;
        }

        #chat .chat__conversation-panel .add-file-button svg {
            width: 70%;
            stroke: #54575c;
        }

        #chat .chat__conversation-panel .emoji-button {
            min-width: 23px;
            width: 23px;
            height: 23px;
            background: transparent;
            border-radius: 50%;
        }

        #chat .chat__conversation-panel .emoji-button svg {
            width: 100%;
            fill: transparent;
            stroke: #54575c;
        }

        #chat .chat__conversation-panel .send-message-button {
            background: #4f198d;
            height: 30px;
            min-width: 30px;
            border-radius: 50%;
            transition: .3s ease;
        }

        #chat .chat__conversation-panel .send-message-button:active {
            transform: scale(0.97);
        }

        #chat .chat__conversation-panel .send-message-button svg {
            margin: 1px -1px;
        }

        #chat .chat__conversation-panel__input {
            width: 100%;
            height: 100%;
            outline: none;
            position: relative;
            color: var(--chat-text-color);
            font-size: 13px;
            background: transparent;
            border: 0;
            font-family: 'Lato', sans-serif;
            resize: none;
        }

        @media only screen and (max-width: 600px) {
            #chat {
                margin: 0;
                border-radius: 0;
            }

            #chat .chat__conversation-board {
                height: 78%;
            }

            #chat .chat__conversation-board__message__options {
                display: none !important;
            }
        }

    </style>
@endpush

<section class="row the-slider" id="slider">
    <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
        <div class="chat-container">
            <div class="--dark-theme" id="chat">
                <div class="chat__conversation-board">
                    @foreach($chat->messages as $message)
                        @if($message->user_id == auth()->user()->id)
                            {{-- User msg --}}
                            <div class="chat__conversation-board__message-container">
                                {{-- User info --}}
                                <div class="chat__conversation-board__message__person">
                                    <div class="chat__conversation-board__message__person__avatar">
                                        <img src="{{ auth()->user()->avatar() }}" alt="{{ auth()->user()->full_name }}"/>
                                    </div>
                                    <span class="chat__conversation-board__message__person__nickname">{{ auth()->user()->full_name }}</span>
                                </div>
                                {{-- User msg details --}}
                                <div class="chat__conversation-board__message__context">
                                    <div class="chat__conversation-board__message__bubble">
                                        <span>{{ $message->message }}</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Other users msg --}}
                            <div class="chat__conversation-board__message-container reversed">
                                {{-- Other users info --}}
                                <div class="chat__conversation-board__message__person">
                                    <div class="chat__conversation-board__message__person__avatar">
                                        <img src="{{ $message->user->avatar() }}" alt="{{ $message->user->full_name }}"/>
                                    </div>
                                    <span class="chat__conversation-board__message__person__nickname">{{ $message->user->full_name }}</span>
                                </div>
                                {{-- Other users msg details --}}
                                <div class="chat__conversation-board__message__context">
                                    <div class="chat__conversation-board__message__bubble">
                                        <span>{{ $message->message }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                    <form>
                        <div class="chat__conversation-panel">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <div class="chat__conversation-panel__container">
{{--                                                                    <button class="chat__conversation-panel__button panel-item btn-icon add-file-button">--}}
{{--                                                                        <svg class="feather feather-plus sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">--}}
{{--                                                                            <line x1="12" y1="5" x2="12" y2="19"></line>--}}
{{--                                                                            <line x1="5" y1="12" x2="19" y2="12"></line>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
{{--                                                                    <button--}}
{{--                                                                            class="chat__conversation-panel__button panel-item btn-icon emoji-button">--}}
{{--                                                                        <svg class="feather feather-smile sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">--}}
{{--                                                                            <circle cx="12" cy="12" r="10"></circle>--}}
{{--                                                                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>--}}
{{--                                                                            <line x1="9" y1="9" x2="9.01" y2="9"></line>--}}
{{--                                                                            <line x1="15" y1="9" x2="15.01" y2="9"></line>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
                                <input
                                        class="chat__conversation-panel__input panel-item" name="message"
                                        placeholder="Type a message..."/>
                                <button class="chat__conversation-panel__button panel-item btn-icon
                                    send-message-button" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" aria-hidden="true" data-reactid="1036">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</section>


@push('after-scripts')
    <script>
        $(document).ready(function () {

            // Send message
            $('#chat form').on('submit', function (e) {
                e.preventDefault();
                var message = $(this).find('input[name="message"]').val();
                var group_id = $(this).find('input[name="group_id"]').val();
                // var attachment = $(this).find('input[name="attachment"]').val();
                var formData = new FormData();
                formData.append('message', message);
                formData.append('group_id', group_id);
                // formData.append('attachment', attachment);
                $.ajax({
                    url: '{{ route('group.chat.send', ['group' => '']) }}' + '/' + group_id,
                    type: 'POST',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        // Append the message to the chat

                        var new_message = '<div class="chat__conversation-board__message-container">\n' +
                            '                                    <div class="chat__conversation-board__message__person">\n' +
                            '                                        <div class="chat__conversation-board__message__person__avatar">\n' +
                            '                                            <img src="' + response.user.avatar + '" alt="' + response.user.full_name + '"/>\n' +
                            '                                        </div>\n' +
                            '                                        <span class="chat__conversation-board__message__person__nickname">' + response.user.full_name + '</span>\n' +
                            '                                    </div>\n' +
                            '                                    <div class="chat__conversation-board__message__context">\n' +
                            '                                        <div class="chat__conversation-board__message__bubble">\n' +
                            '                                            <span>' + response.message + '</span>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </div>';
                        $('#chat .chat__conversation-board').append(new_message);

                        // Clear the input field
                        $('#chat form input[name="message"]').val('');

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush

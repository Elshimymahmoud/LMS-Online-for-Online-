@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@push('after-styles')
    @if(session()->get('display_type') && session()->get('display_type') == "rtl")
        <style>
            .message-box .msg_send_btn{
                right: unset !important;
                left: 0 !important;
            }
            .incoming_msg {
                direction: {{(app()->getLocale() == 'ar') ? 'ltr' : 'rtl'}};
            }
            .outgoing_msg {
                direction: {{(app()->getLocale() == 'ar') ? 'rtl' : 'ltr'}};
            }
            .statusDropdownx .dropdown-menu{

                position: absolute;
                width: fit-content;
            }
        </style>
    @endif
    <style>
        textarea {
            resize: none;
        }
    </style>
@endpush
@section('content')
    <div class="card message-box">
        <div class="card-header">
            <h3 class="page-title mb-0">@lang('labels.backend.messages.title')

                <a href="{{route('admin.tickets.index')}}"
                   class="d-lg-none text-decoration-none threads d-md-none float-right">
                    <i class="icon-speech font-weight-bold"></i>
                </a>
            </h3>
        </div>
        <div>
            @include('includes.partials.messages')
        </div>
        <div class="card-body">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people d-md-block d-lg-block ">
                        <div class="headind_srch">
                            @if(request()->has('thread'))
                            <div class="recent_heading btn-sm btn btn-dark">
                                <a class="text-decoration-none" href="{{route('admin.tickets.index')}}">
                                    <h5 class="text-white mb-0"><i class="icon-plus"></i>&nbsp;&nbsp; @lang('labels.backend.messages.compose')</h5>
                                </a>
                            </div>
                            @endif
                            <div class="srch_bar @if(!request()->has('thread')) text-left @endif">
                                <div class="stylish-input-group">
                                    <input type="text" class="search-bar" id="myInput" placeholder="@lang('labels.backend.tickets.fields.search')">
                                    <span class="input-group-addon">
                                        <button type="button">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- Left Sidebar --}}
                        <div class="inbox_chat">
                            @if($tickets->count() > 0)
                                @foreach($tickets as $item)
                                    @if($item->lastMessage)
                                        <a class="unread" href="{{route('admin.tickets.show', ['ticket' => $item->code])
                                        }}">
                                            <div data-thread="{{$item->id}}"
                                                 class="chat_list active_chat " >
                                                <div class="chat_people">

                                                    <div class="chat_ib">
                                                        <h5 style="display: flex;justify-content: space-between;">
                                                            {{ $item->subject }}
                                                            <span class="chat_date">{{ $item->lastMessage->created_at->diffForHumans() }}</span>
                                                        </h5>
                                                        <p>{{ str_limit($item->lastMessage->message, 35) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- Main Chat --}}
                    @if($ticket && $ticket->messages->count() > 0)
                        <form method="post" action="{{route('admin.tickets.reply')}}">
                            @csrf

                            <input type="hidden" name="ticket_id" value="{{isset($ticket->code) ? $ticket->code : 0}}">
                            <div class="headind_srch ">
                                <div class="chat_people box-header">
                                    <div class="chat_img float-left">
                                        <img src="{{ $ticket->user->avatar() }}" alt="{{ $ticket->user->full_name }}"
                                             height="35px"></div>
                                    <div class="chat_ib float-left">

                                        <h5 class="mb-0 d-inline float-left">{{$ticket->subject}}</h5>
                                        <p class="float-right d-inline mb-0">
                                            <a class="" href="{{route('admin.tickets.show',['ticket'=>$ticket->code])
                                            }}">
                                                <i class="icon-refresh font-weight-bold"></i>
                                            </a>
                                        </p>
                                        <div class="statusDropdownx" style=" position: inherit;float: left;">
                                            <div class="dropdown d-inline float-right" style="margin: 0 10px;position: initial;">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ __('labels.backend.tickets.status.'.$ticket->status) }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="statusDropdown"
                                                     id="statusDropdownContainer">
                                                    <a class="dropdown-item statusDropdown" href="#" id="opened"> @lang('labels.backend.tickets.status.opened')</a>
                                                    <a class="dropdown-item statusDropdown" href="#" id="in_progress"> @lang('labels.backend.tickets.status.in_progress')</a>
                                                    <a class="dropdown-item statusDropdown" href="#" id="closed"> @lang('labels.backend.tickets.status.closed')</a>
                                                    <a class="dropdown-item statusDropdown" href="#" id="resolved"> @lang('labels.backend.tickets.status.resolved')</a>
                                                </div>
                                            </div>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    @if(count($ticket->messages) > 0 )
                                        @foreach($ticket->messages as $message)
                                            @if($message->user_id == auth()->user()->id)
                                                <div class="outgoing_msg">
                                                    <div class="sent_msg">
                                                        <p>{{$message->message}}</p>
                                                        <span class="time_date text-right"> {{\Carbon\Carbon::parse($message->created_at)->format('h:i A | M d Y')}}
                                                        </span>
                                                    </div>
                                                    @if($message->attachment)
                                                        <div class="sent_msg">
                                                            <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">
                                                                @php
                                                                    //attachement tupe
                                                                       $type = explode('.', $message->attachment);
                                                                       $type = end($type);
                                                                @endphp
                                                                @if($type == 'pdf')
                                                                    <i class="fa fa-file-pdf-o"></i>
                                                                    @lang('labels.frontend.tickets.attachment.pdf')
                                                                @elseif($type == 'docx' || $type == 'doc')
                                                                    <i class="fa fa-file-word-o"></i>
                                                                    @lang('labels.frontend.tickets.attachment.doc')
                                                                @elseif($type == 'xlsx' || $type == 'xls')
                                                                    <i class="fa fa-file-excel-o"></i>
                                                                    @lang('labels.frontend.tickets.attachment.excel')
                                                                @elseif($type == 'pptx' || $type == 'ppt')
                                                                    <i class="fa fa-file-powerpoint-o"></i>
                                                                    @lang('labels.frontend.tickets.attachment.powerpoint')
                                                                @elseif($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'gif')
                                                                    <i class="fa fa-file-image-o"></i>
                                                                    @lang('labels.frontend.tickets.attachment.image')
                                                                @else
                                                                    <i class="fa fa-file "></i>
                                                                    @lang('labels.frontend.tickets.attachment.other')
                                                                @endif
                                                            </a>

                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img"><img
                                                                src="{{ $ticket->user->avatar() }}"
                                                                alt=""></div>
                                                    <div class="received_msg">
                                                        <div class="received_withd_msg">
                                                            <p>{{$message->message}}</p>
                                                            <span class="time_date">{{\Carbon\Carbon::parse($message->created_at)->format('h:i A | M d Y')}}</span>
                                                        </div>
                                                        @if($message->attachment)
                                                            <div class="received_withd_msg">
                                                                <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">
                                                                    @php
                                                                        //attachement tupe
                                                                           $type = explode('.', $message->attachment);
                                                                           $type = end($type);
                                                                    @endphp
                                                                    @if($type == 'pdf')
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                        @lang('labels.frontend.tickets.attachment.pdf')
                                                                    @elseif($type == 'docx' || $type == 'doc')
                                                                        <i class="fa fa-file-word-o"></i>
                                                                        @lang('labels.frontend.tickets.attachment.doc')
                                                                    @elseif($type == 'xlsx' || $type == 'xls')
                                                                        <i class="fa fa-file-excel-o"></i>
                                                                        @lang('labels.frontend.tickets.attachment.excel')
                                                                    @elseif($type == 'pptx' || $type == 'ppt')
                                                                        <i class="fa fa-file-powerpoint-o"></i>
                                                                        @lang('labels.frontend.tickets.attachment.powerpoint')
                                                                    @elseif($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'gif')
                                                                        <i class="fa fa-file-image-o"></i>
                                                                        @lang('labels.frontend.tickets.attachment.image')
                                                                    @else
                                                                        <i class="fa fa-file "></i>
                                                                        @lang('labels.frontend.tickets.attachment.other')
                                                                    @endif
                                                                </a>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <textarea type="text" name="message" class="write_msg"
                                                  placeholder="Type a message"></textarea>
                                        <button class="msg_send_btn" type="submit">
                                            <i class="icon-paper-plane" style="line-height: 2" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div id="">
                            <div class="headind_srch bg-dark">
                                <div class="chat_people header row">
                                    <div class="col-12 col-lg-3">
                                        <p class="font-weight-bold text-white mb-0" style="line-height: 35px">
                                            {{trans('labels.backend.tickets.select')}}:
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    <p class="text-center">{{trans('labels.backend.messages.start_conversation')}}</p>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>

        $(document).ready(function () {
            //Get to the last message in conversation
            $('.msg_history').animate({
                scrollTop: $('.msg_history')[0].scrollHeight
            }, 1000);

            //Read message
            setTimeout(function () {
                var thread = '{{request('thread')}}';
               var message =  $(".inbox_chat").find("[data-thread='" + thread + "']");
                message.parent('a').removeClass('unread');
                message.find('span.badge').remove();
            }, 500 );

            //Filter in conversation
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".chat_list").parent('a').filter(function () {
                    $(this).toggle($(this).find('h5,p').text().toLowerCase().trim().indexOf(value) > -1)
                });
            });

            //Change status
            $('.statusDropdown').on('click', function (e) {
                e.preventDefault();
                var status = $(this).attr('id');
                var ticket_id = '{{ $ticket->code }}';
                $.ajax({
                    url: '{{ route('admin.tickets.updateStatus', ['ticket' => $ticket->code]) }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status,
                        ticket_id: ticket_id
                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            // Show success message
                            toastr.success(data.message);
                        }
                    }
                });
            });


        });

    </script>
@endpush
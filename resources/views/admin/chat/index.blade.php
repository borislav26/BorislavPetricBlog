@extends('admin._layout.layout')
@section('content')

<div class="dashboard-wrapper">
    <div class="main-container">
        <div class="navbar bg-white breadcrumb-bar border-bottom">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Overview</a>
                    </li>
                    <li class="breadcrumb-item"><a href="pages-app.html">App Pages</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
            </nav>
            <div class="dropdown">
                <button class="btn btn-outline-light btn-sm" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Manage Members</a>
                    <a class="dropdown-item" href="#">Subscribe</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#">Leave Chat</a>
                </div>
            </div>
        </div>


        <div class="content-container">
            <div class="chat-module">
                <div class="chat-module-top">
                    <h5>The place for heading</h5>
                    <div class="chat-module-body" id="messages_field" style="background-image: url('/themes/admin/assets/images/background.jpg'); background-repeat: no-repeat; background-size: cover;">

                    </div>
                </div>
                <div class="chat-module-bottom">
                    <form class="chat-form" id="send-message-field">
                        <textarea class="form-control" placeholder="Type message" rows="1" data-action="send" data-id=""></textarea>
                        <div class="chat-form-buttons">
                            <button type="button" class="btn btn-link">
                                <i class="far fa-smile"></i>
                            </button>
                            <div class="custom-file custom-file-naked">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">
                                    <i class="fas fa-paperclip"></i>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid dashboard-content" id="user-friends-field">
        <div class="row">
            @foreach($users as $user)
            <div class="list-group list-group-flush  list col-md-3" data-friend-id="{{ $user->id }}" data-action="show-messages">
                <a class="list-group-item list-group-item-action" href="#">
                    <div class="media media-member mb-0">
                        <img alt="Claire Connors" src="/themes/admin/assets/images/avatar-1.jpg" class="avatar">
                        <div class="media-body ">
                            <h6 class="mb-0 name">{{$user->name}}</h6>
                            <span class="name">{{ $user->role->name}}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
@push('footer_javascript')
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e9fc7f5004a605f2c390', {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        alert('sve je dobro proslo');
    });

    function loadMessages() {
        $('#user-friends-field').on('click', '[data-action="show-messages"]', function () {
            var friendId = $(this).attr('data-friend-id');
            $('#send-message-field [data-action="send"]').attr('data-id', friendId);
            $.ajax({
                "url": "{{ route('admin.chat.messages_content')}}",
                "type": "post",
                "data": {
                    'friend_id': friendId,
                    "_token": "{{ csrf_token()}}"
                },
                "error": function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            }).done(function (response) {
                $('#messages_field').html(response);

                setInterval(function () {
                    $.ajax({
                        "url": "{{ route('admin.chat.reload_table')}}",
                        "type": "post",
                        "data": {
                            'user_to_id': friendId,
                            '_token': "{{ csrf_token()}}"
                        }
                    }).done(function (response) {

                        $('#messages_field').html(response);
//                         $('#messages_field').scrollTop($('#messages_field').height()); 
                    }).fail(function () {
                        alert('nesto se lose desilo');
                    });

                }, 1000);

            }).fail(function (response) {
                alert('nesto se lose desilo');
            });
        });
    }
    loadMessages();
    $('#send-message-field').on('keyup', '[data-action="send"]', function (e) {
        let message = $(this).val();
        let id = $(this).attr('data-id');
        if (e.keyCode === 13 && message !== '' && id !== "") {
            $(this).val("");
            $.ajax({
                "url": "{{route('admin.chat.send_message')}}",
                "type": "POST",
                "data": {
                    'user_to_id': id,
                    'content': message,
                    '_token': "{{ csrf_token()}}"
                },
                "error": function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            }).done(function (response) {

            }).fail(function (response) {
                alert('negde je doslo do greske');
            });
        }
    });
</script>

@endpush
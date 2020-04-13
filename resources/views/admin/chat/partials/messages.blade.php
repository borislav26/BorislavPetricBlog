@foreach($messages as $message)
<div class="media chat-item @if(\Auth::user()->id!=$message->user_from_id) bg-light @endif @if(\Auth::user()->id!=$message->user_to_id) bg-secondary @endif d-flex" style="border-radius: 5px;">
    @if(\Auth::user()->id==$message->user_to_id)
    <img alt="William" src="/themes/admin/assets/images/avatar-1.jpg" class="rounded-circle user-avatar-lg">
    <span class="avatar-badge has-indicator online">
        2
        <i class="fa fa-check"></i>
    </span>
    @endif
    <div class="media-body">
        <div class="chat-item-title">
            @if(\Auth::user()->id!=$message->user_from_id)
            <span class="chat-item-author">{{ $message->userFrom->name}}</span>
            @endif
            <span>{{ $message->goodFormatedDate()}}</span>
        </div>
        <div class="chat-item-body">
            <p>{{$message->content}}</p>
        </div>
    </div>
    @if(\Auth::user()->id!=$message->user_to_id)
    <img alt="William" src="/themes/admin/assets/images/avatar-1.jpg" class="rounded-circle user-avatar-lg">
    <span class="avatar-badge has-indicator online">
    </span>
    @endif
</div>
@endforeach
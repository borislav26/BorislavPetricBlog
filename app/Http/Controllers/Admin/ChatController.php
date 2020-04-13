<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Message;
use Pusher\Pusher;

class ChatController extends Controller {

    public function index(Request $request) {
        $users = User::query()
                ->where('id', '!=', \Auth::user()->id)
                ->get();
        return view('admin.chat.index', [
            'users' => $users
        ]);
    }

    public function messages(Request $request) {
        $formData = $request->validate([
            'friend_id' => ['required', 'numeric', 'exists:users,id']
        ]);
        $my_id = \Auth::user()->id;
        $messages = Message::query()
                ->with(['userTo', 'userFrom'])
                ->where(function($query) use ($formData, $my_id) {
                    $query->where('user_from_id', $my_id)
                    ->where('user_to_id', $formData['friend_id']);
                })
                ->orWhere(function($query) use ($formData, $my_id) {
                    $query->where('user_to_id', $my_id)
                    ->where('user_from_id', $formData['friend_id']);
                })
                ->get();
        return view('admin.chat.partials.messages', [
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request) {
        $formData = $request->validate([
            'user_to_id' => ['required', 'numeric', 'exists:users,id'],
            'content' => ['required', 'string', 'min:1'],
        ]);
        $message = new Message();

        $message->is_read = 0;
        $message->user_from_id = \Auth::user()->id;
        $message->fill($formData);
        $message->save();

        $options = [
            'cluster' => 'eu',
            'useTLS' => true
        ];
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);
        $data = [
            'from' => \Auth::user()->id,
            'to' => $formData['user_to_id']
        ];
        $pusher->trigger('my-channel', 'my-event', $data);
        return response()->json([
                    'success_message' => 'You successfully sent message'
        ]);
    }

    function reloadTable(Request $request) {
        $formData = $request->validate([
            'user_to_id' => ['required', 'numeric', 'exists:users,id']
        ]);
        $my_id = \Auth::user()->id;
        $messages = Message::query()
                ->with(['userTo', 'userFrom'])
                ->where(function($query) use ($formData, $my_id) {
                    $query->where('user_from_id', $my_id)
                    ->where('user_to_id', $formData['user_to_id']);
                })
                ->orWhere(function($query) use ($formData, $my_id) {
                    $query->where('user_to_id', $my_id)
                    ->where('user_from_id', $formData['user_to_id']);
                })
                ->get();
        return view('admin.chat.partials.messages', [
            'messages' => $messages
        ]);
    }

}

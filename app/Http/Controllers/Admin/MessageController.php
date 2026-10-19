<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

/** Messages sent from the Contacts page form. */
class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::query()
            ->when($request->filter === 'unread', fn ($q) => $q->whereNull('read_at'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'counts' => ['all' => Message::count(), 'unread' => Message::unread()->count()],
        ]);
    }

    public function show(Message $message)
    {
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggle(Message $message)
    {
        $message->update(['read_at' => $message->read_at ? null : now()]);

        return back()->with('success', $message->read_at ? 'Marked as read.' : 'Marked as unread.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}

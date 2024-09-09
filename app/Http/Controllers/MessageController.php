<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function indexAdmin()
    {
        $siswa = Siswa::all();
        return view('messages.index_admin', compact('siswa'));
    }

    public function showConversation($receiver_id)
    {
        $receiver = Siswa::findOrFail($receiver_id);

        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', Auth::user()->formatted_id)
                ->where('sender_type', User::class)
                ->where('receiver_id', $receiver_id)
                ->where('receiver_type', Siswa::class);
        })
        ->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)
                ->where('sender_type', Siswa::class)
                ->where('receiver_id', Auth::user()->formatted_id)
                ->where('receiver_type', User::class);
        })
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($message) {
            return [
                'id' => $message->id,
                'sender_name' => $message->sender ? ($message->sender_type === User::class ? $message->sender->name : $message->sender->nama) : 'Unknown',
                'message' => $message->message,
                'attachment' => $message->attachment ? asset('storage/' . $message->attachment) : null,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return view('messages.conversation', [
            'messages' => $messages,
            'receiver' => [
                'id' => $receiver_id,
                'name' => $receiver->nama,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:5120', // 5MB max
        ]);

        $message = new Message();

        $sender = Auth::user();
        $receiverId = $request->receiver_id;

        // Determine sender type and ID
        if ($sender instanceof User) {
            $message->sender_id = $sender->formatted_id;
            $message->sender_type = User::class;
        } elseif ($sender instanceof Siswa) {
            $message->sender_id = $sender->id;
            $message->sender_type = Siswa::class;
        } else {
            return redirect()->back()->withErrors(['sender_id' => 'Invalid sender']);
        }

        // Determine receiver type
        $receiver = Siswa::find($receiverId);
        if ($receiver) {
            $message->receiver_id = $receiverId;
            $message->receiver_type = Siswa::class;
        } else {
            return redirect()->back()->withErrors(['receiver_id' => 'Receiver not found']);
        }

        $message->message = $request->message;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $message->attachment = $path;
        }

        $message->save();

        return redirect()->back();
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:5120', // 5MB max
        ]);

        $student = Auth::guard('siswa')->user();
        if (!$student) {
            return redirect()->back()->withErrors(['student' => 'User not authenticated']);
        }

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $message = new Message();
            $message->sender_id = $student->id;
            $message->sender_type = Siswa::class;
            $message->receiver_id = $admin->id;
            $message->receiver_type = User::class;
            $message->message = $request->message;

            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('attachments', 'public');
                $message->attachment = $path;
            }

            $message->save();
        }

        return redirect()->back();
    }

    public function indexStudent()
    {
        $student = Auth::guard('siswa')->user();
        $messages = Message::where(function ($query) use ($student) {
                $query->where('receiver_id', $student->id)
                      ->where('receiver_type', Siswa::class)
                      ->orWhere(function ($query) use ($student) {
                          $query->where('sender_id', $student->id)
                                ->where('sender_type', Siswa::class);
                      });
            })
            ->with('sender')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'sender_name' => $message->sender ? ($message->sender_type === User::class ? $message->sender->name : $message->sender->nama) : 'Unknown',
                    'message' => $message->message,
                    'attachment' => $message->attachment ? asset('storage/' . $message->attachment) : null,
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                ];
            });
        
        return view('siswa.messages.index_student', [
            'messages' => $messages,
        ]);
    }
}
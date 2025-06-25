<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\CourseGroup;
use App\Models\GroupChat;
use App\Models\GroupMessages;
use App\Models\Tag;
use App\Notifications\Frontend\GroupChatNotification;
use Illuminate\Http\Request;

class GroupChatController extends Controller
{
    public function store(Request $request)
    {
        //
    }

    public function index(GroupChat $groupChat)
    {
        // Check if the user is a member of the course group
        if ($groupChat->students->contains(auth()->user()->id)) {
            return response()->json($groupChat->messages()->with('user')->get());
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function send(Request $request, CourseGroup $group)
    {
        $request->validate([
            'message' => 'required',
        ]);

        // Check if the user is a member of the course group
//        if (!$group->students->contains(auth()->user()->id)) {
//            return response()->json(['error' => 'Unauthorized'], 403);
//        }

        $groupChat = GroupChat::firstOrCreate(['course_group_id' => $group->id]);
        $message = new GroupMessages();
        $message->course_group_chat_id = $groupChat->id;
        $message->user_id = auth()->user()->id;
        $message->message = $request->message;
        $message->save();

        //Notify all users in the group except the sender
        $group->students->each(function ($student) use ($group) {
            if ($student->id != auth()->user()->id) {
                $student->notify(new GroupChatNotification($group));
            }
        });

        $response = [
            'message' => $message->message,
            'user' => [
                'id' => auth()->user()->id,
                'avatar' => auth()->user()->avatar(),
                'full_name' => auth()->user()->full_name,
            ],

        ];
        return response()->json($response, 201);
    }

}

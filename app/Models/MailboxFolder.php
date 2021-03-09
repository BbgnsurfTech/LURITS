<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailboxFolder extends Model
{
    protected $table = "mailbox_folder";

    protected $fillable = ["title", "icon"];

public function getUnreadMessages()
	{
	    $folder = MailboxFolder::where('title', "Inbox")->first();

	    $messages = Mailbox::join('mailbox_receiver', 'mailbox_receiver.mailbox_id', '=', 'mailbox.id')
	        ->join('mailbox_user_folder', 'mailbox_user_folder.user_id', '=', 'mailbox_receiver.receiver_id')
	        ->join('mailbox_flags', 'mailbox_flags.user_id', '=', 'mailbox_user_folder.user_id')
	        ->where('mailbox_receiver.receiver_id', Auth::user()->id)
	//                          ->where('parent_id', 0)
	        ->where('mailbox_flags.is_unread', 1)
	        ->where('mailbox_user_folder.folder_id', $folder->id)
	        ->where('sender_id', '!=', Auth::user()->id)
	        ->whereRaw('mailbox.id=mailbox_receiver.mailbox_id')
	        ->whereRaw('mailbox.id=mailbox_flags.mailbox_id')
	        ->whereRaw('mailbox.id=mailbox_user_folder.mailbox_id')
	        ->select(["*", "mailbox.id as id"])
	        ->get();

	    return $messages;
	}
}

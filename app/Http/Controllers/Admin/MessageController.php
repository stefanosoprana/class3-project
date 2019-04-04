<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;

class MessageController extends Controller
{
  public function index()
  {
    $messages = Message::paginate(10);
    return view('admin.messages.index', compact('messages'));
  }
  public function show($id)
  {
    $message = Message::find($id);
    return view('admin.messages.show', compact('message'));
  }

}

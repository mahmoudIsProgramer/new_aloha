<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Edujugon\PushNotification\PushNotification;

class NotificationController extends Controller
{

  public function index(Request $request)
  {
    // dd('hi');
    return view('dashboard.notifications.index');
  } // end of index

  public function store(Request $request)
  {

    $data = [
      'title' => $request->title,
      'body' => $request->message,
    ];

    $push = new PushNotification('fcm');
    $response = $push->setMessage(['data' => $data, 'notification' => $data])
      ->setApiKey(setApiKey())
      ->setConfig(['dry_run' => false])
      ->sendByTopic('notificationToAll_aloha');

    session()->flash('success', "تم ارسال الاشعارات بنجاح");
    return redirect()->back();
  } // end of store

}

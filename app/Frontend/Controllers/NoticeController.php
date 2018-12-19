<?php

namespace App\Frontend\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mariadb\BackendFrontend\Notice;

class NoticeController extends Controller {

    public function index() {
        $title = '通知';
        $user = Auth::user();
        $notices = $user->notices;
        
        return view('frontend.notice.index', compact('notices', 'title'));
    }

}

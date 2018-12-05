<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Backend\Controllers;

use App\Mariadb\BackendFrontend\Notice;
use App\Jobs\SendMessage;

/**
 * Description of NoticeController
 *
 * @author User
 */
class NoticeController extends Controller {

    //put your code here
    public function index() {
        $notices = Notice::all();
        $title = '通知管理';
        return view('backend.notice.index', compact('notices', 'title'));
    }

    public function create() {
        return view('backend.notice.create', [
            'title' => '增加通知'
        ]);
    }
    
    public function store() {
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $notice = Notice::create(request(['title', 'content']));
        dispatch(new SendMessage($notice));
        return redirect('/backend/notices');
    }

}

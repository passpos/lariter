<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Backend\Controllers;

/**
 * Description of NoticeController
 *
 * @author User
 */
class NoticeController extends Controller {

    //put your code here
    public function index() {
        return view('backend.notification.index', [
            'title' => '通知管理'
        ]);
    }

    public function create() {
        return view('backend.notification.create', [
            'title' => '增加通知'
        ]);
    }

}

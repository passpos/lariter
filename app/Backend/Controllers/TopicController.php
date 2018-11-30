<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Backend\Controllers;

/**
 * Description of TopicController
 *
 * @author User
 */
class TopicController extends Controller{
    //put your code here
    public function index() {
        return view('backend.topic.index', [
            'title' => '专题管理'
        ]);
    }
    public function create() {
        return view('backend.topic.create', [
            'title' => '增加专题'
        ]);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Backend\Controllers;

use App\Models\Backend\BackendTopic;

/**
 * Description of TopicController
 *
 * @author User
 */
class TopicController extends Controller {

    //put your code here
    public function index() {
        $topics = BackendTopic::all();
        $title = '专题管理';
        return view('backend.topic.index', compact('topics', 'title'));
    }

    public function create() {
        $title = '增加专题';
        return view('backend.topic.create', compact('title'));
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|string'
        ]);

        BackendTopic::create(['name' => request('name')]);

        return redirect("/backend/topics");
    }

    public function destroy(BackendTopic $topic) {
        $topic->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

}

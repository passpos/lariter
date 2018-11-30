<?php

namespace App\Backend\Controllers;

class PanelController extends Controller {

    public function index() {
        return view('backend.index',['title' => '网站后台']);
    }

}

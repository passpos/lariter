<?php

namespace App\Backend\Controllers;

class PanelController extends Controller {

    public function index() {
        if (Auth::id() != null) {
            return view('backend.panel.index');
        } else {
            return redirect('/backend/login');
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    protected $title = 'Manajement Main Dashboard';
    public function index(){
        $title = $this->title;
        return view('Manajement.Dashboard.index', compact('title'));
    }
}

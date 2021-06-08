<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $num_pagination = 3;

    public function index()
    {
        $plans = Plan::with('details')->orderBy('price','ASC')->paginate($this->num_pagination);
        return view('site.home-index', compact('plans'));
    }
}

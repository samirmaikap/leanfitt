<?php

namespace App\Http\Controllers\Web;

use function auth;
use function config;
use function dd;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function url;
use function view;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['page']='dashboard';
        return view('app.dashboard',$data);
    }
}

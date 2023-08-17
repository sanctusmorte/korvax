<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class StatsController extends Controller
{
    public function get(): View
    {
        return view('stats');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\TransitionLinkJob;
use App\Services\Links\LinksDataService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RedirectController extends Controller
{
    public function redirect(string $code, LinksDataService $dataService): View|RedirectResponse
    {
        try {
            $link = $dataService->findActiveByCode($code);
        } catch (ModelNotFoundException) {
            return view('not-found');
        }

        dispatch(new TransitionLinkJob(request()->ip(), request()->header('user-agent'), $link->id));

        return redirect($link->link);
    }
}

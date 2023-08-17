<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Links\LinksCreateRequest;
use App\Models\Link;
use App\Services\Links\LinksService;
use Illuminate\Http\JsonResponse;

class LinksController extends Controller
{
    public function create(LinksCreateRequest $request, LinksService $linksService): JsonResponse
    {
        try {
            $newLink = $linksService->create(request()->getHttpHost(), $request->post('link'));
        } catch (\Exception $e) {
            return $this->responseError();
        }

        return $this->responseSuccess(['short_link' => $newLink->generated_link]);
    }

    public function getList(): JsonResponse
    {
        $links = Link::orderBy('created_at', 'desc')->limit(20)->withCount('transitions')->get();

        return $this->responseSuccess(['items' => $links]);
    }
}

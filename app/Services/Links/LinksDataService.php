<?php

declare(strict_types=1);

namespace App\Services\Links;

use App\Models\Link;
use Carbon\Carbon;

class LinksDataService
{
    public function findActiveByCode(string $code): Link|null
    {
        return Link::where('code', $code)->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->firstOrFail();
    }
}

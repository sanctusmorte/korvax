<?php

declare(strict_types=1);

namespace App\Services\Links;

use App\Models\Link;
use App\Services\Links\Exceptions\LinksCreateException;
use Illuminate\Support\Str;

class LinksService
{
    public function create(string $host, string $link): Link
    {
        do {
            $code = Str::random(9);
        } while (Link::where('code', $code)->exists());

        try {
            $newLink = new Link();
            $newLink->link = $link;
            $newLink->generated_link = 'http://' . $host . '/redirect/' . $code;
            $newLink->code = $code;
            $newLink->save();
        } catch (\Exception) {
            throw new LinksCreateException();
        }

        return $newLink;
    }
}

<?php

namespace App\Services\Transitions;

use App\Models\Link;
use App\Models\Transition;

class TransitionsService
{
    public function add(string $ip, string $userAgent, int $linkId)
    {
        $link = Link::find($linkId);

        if (!is_null($link)) {
            $transition = new Transition();
            $transition->links_id = $link->id;
            $transition->client_ip = $ip;
            $transition->client_user_agent = $userAgent;
            $transition->save();
        }
    }
}

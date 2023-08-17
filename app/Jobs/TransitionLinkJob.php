<?php

namespace App\Jobs;

use App\Services\Transitions\TransitionsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class TransitionLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $ip;
    private string $userAgent;
    private int $linkId;

    public function __construct(string $ip, string $userAgent, int $linkId)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->linkId = $linkId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TransitionsService $service)
    {
        $service->add($this->ip, $this->userAgent, $this->linkId);
    }

    public function failed(Throwable $exception)
    {

    }
}

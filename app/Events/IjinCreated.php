<?php

namespace App\Events;

use App\Models\Ijin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IjinCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Ijin instance.
     *
     * @var \App\Models\Ijin
     */
    public $ijin;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Ijin $ijin
     */
    public function __construct(Ijin $ijin)
    {
        $this->ijin = $ijin;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

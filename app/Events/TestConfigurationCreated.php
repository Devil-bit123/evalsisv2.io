<?php

namespace App\Events;

use App\Models\TestConfiguration;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestConfigurationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $configuration;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TestConfiguration $configuration)
    {
        //
        $this->configuration = $configuration;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

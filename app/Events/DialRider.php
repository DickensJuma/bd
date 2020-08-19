<?php

namespace App\Events;

use App\Shipment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DialRider implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $shipment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('dialRider.' . $this->shipment->dialed_rider_id);
    }

    public function broadcastWith(){
        return ['shipment' => $this->shipment];
    }

    public function broadcastAs()
    {
        return 'dialRider';
    }
}

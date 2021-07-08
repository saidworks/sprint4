<?php

namespace App\Events;

use Illuminate\ {
    Queue\SerializesModels,
    Database\Eloquent\Model,
    Foundation\Events\Dispatchable
};

class ModelCreated
{
    use Dispatchable, SerializesModels;
    public $model;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
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

<?php

namespace App\Services;

use App\Channel;
use App\Contracts\ChannelContract;
use Flobbos\Crudable;

class ChannelService implements ChannelContract {
    
    use Crudable\Crudable;
    
    public function __construct(Channel $channel) {
        $this->model = $channel;
    }
    
}
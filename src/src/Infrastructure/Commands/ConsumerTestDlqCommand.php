<?php

namespace Transfee\Commands;

use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\Consumer;
use Junges\Kafka\Contracts\KafkaConsumerMessage;

class ConsumerTestDlqCommand extends Consumer
{
    public function handle(KafkaConsumerMessage $message): void
    {
        Log::info("DLQ ". $message->getBody()['id']);
    }
}

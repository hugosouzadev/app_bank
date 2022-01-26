<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConsumerTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $consumer = \Junges\Kafka\Facades\Kafka::createConsumer()
            ->subscribe('consumer-topic')
            ->withHandler(function(\Junges\Kafka\Contracts\KafkaConsumerMessage $message) {
                $body = $message->getBody();

                if(rand(0,1)){
                    throw new \Exception('teste');
                }

                Log::info(json_encode($body));
            })
            ->withAutoCommit()
            ->withDlq('consumer-topic-dlq')
            ->build();

        $consumer->consume();
    }
}

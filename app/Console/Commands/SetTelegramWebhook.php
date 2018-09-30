<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SetTelegramWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:setWebhook {webhook?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set telegram webhook';

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
     * @return mixed
     */
    public function handle()
    {
        if(!$token = config('telegram.defaults.token_bot')) {
            $this->error('token not found in config file');
            return;
        }

        $webhook = $this->argument('webhook') ?? url()->full() . '/' . config('telegram.defaults.webhook');
        $client = new Client();
        $this->info($webhook);
        $result = $client->post("https://api.telegram.org/bot$token/setWebhook" , [
            'form_params' => [
                'url' => $webhook
            ]
        ]);

        $this->info($result->getBody());
        if ($result->getStatusCode() === 200) {
            $this->info(json_decode($result->getBody(), true)['description']);
            return;
        }

        $this->error($result->getReasonPhrase() . ' ' . $result->getStatusCode());

    }
}

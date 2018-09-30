<?php

namespace App\Listeners;

use Alish\Telegram\Facades\Telegram;
use App\Client;
use App\Snapshot;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendClientProgressToAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $client = $event->client;
        $this->send($this->getInformation($client), $client);
    }

    /**
     * @param Client $client
     * @return Snapshot
     */
    private function getSnapshot(Client $client)
    {
        return $client->snapshots()->latest()->first();
    }

    private function getTelegramInformation($client)
    {
        return __('snapshot.telegram.header') . "\n" .
            __('snapshot.telegram.first_name', ['first_name' => $client->first_name]) . "\n" .
            __('snapshot.telegram.last_name', ['last_name' => $client->last_name]) . "\n" .
            __('snapshot.telegram.username', ['username' => $client->username]);
    }

    private function isCharityFinance(Snapshot $snapshot)
    {
        return $snapshot->data->get('charity') === 'finance';
    }

    private function getFinanceCharityType(Snapshot $snapshot)
    {
        return __('snapshot.charity.finance.' . $snapshot->data->get('finance'));
    }

    private function getFinanceInfo(Snapshot $snapshot)
    {
        return __('snapshot.charity.finance.header') . "\n" .
            $this->getFinanceCharityType($snapshot);
    }

    private function isCharityItem(Snapshot $snapshot)
    {
        return $snapshot->data->get('help') === 'charity' && !$this->isCharityFinance($snapshot);
    }

    private function isActivity(Snapshot $snapshot)
    {
        return $snapshot->data->get('help') === 'activity';
    }

    private function getActivityType(Snapshot $snapshot)
    {
        return __('telegram.words.' . $snapshot->data->get('activity'));
    }

    private function getActivityInfo(Snapshot $snapshot)
    {
        $data = $snapshot->data;

        if ($data->get('other_sub_activity')) {
            $unit = $data->get('other_sub_activity');
        } else {
            $unit = __('telegram.words.' . $data->get('sub_activity'));
        }

        return __('snapshot.activity.header') . "\n" .
            __('snapshot.activity.section', ['section' => $this->getActivityType($snapshot)]) . "\n" .
            __('snapshot.activity.unit', ['unit' => $unit]);

    }

    private function getSignupInfo(Snapshot $snapshot)
    {
        $data = $snapshot->data;

        return __('snapshot.signup.header') . "\n" .
            __('snapshot.signup.first_name', ['first_name' => $data->get('first_name')]) . "\n" .
            __('snapshot.signup.last_name', ['last_name' => $data->get('last_name')]) . "\n" .
            __('snapshot.signup.national_number', ['national_number' => $data->get('national_number')]) . "\n" .
            __('snapshot.signup.passport_number', ['passport_number' => $data->get('passport_number')]) . "\n" .
            __('snapshot.signup.tel_number', ['tel_number' => $data->get('tel_number')]);
    }

    private function getCharityItemInfo(Snapshot $snapshot)
    {
        $data = $snapshot->data;

        return __('snapshot.charity.item.header') . "\n" .
            __('snapshot.charity.item.donation_item', ['item' => $data->get('donation_product_name')]) . "\n" .
            __('snapshot.charity.item.donation_amount', ['amount' => $data->get('donation_product_amount')]) . "\n";
    }

    private function getInformation(Client $client)
    {
        $snapshot = $this->getSnapshot($client);
        $text = __('snapshot.message.header') . "\n\n" .
            $this->getTelegramInformation($client) . "\n\n";

        if ($this->isCharityFinance($snapshot)) {
            $text .= $this->getFinanceInfo($snapshot);
        } else {

            if ($this->isCharityItem($snapshot)) {
                $text .=$this->getCharityItemInfo($snapshot);
            }
            else if ($this->isActivity($snapshot)) {
                $text .=$this->getActivityInfo($snapshot);
            }

            $text .= "\n\n" . $this->getSignupInfo($snapshot);

        }

        Log::info($text);
        return $text . "\n";
    }

    private function send($text, Client $client)
    {
        $admins = User::first()->clients;
        $snapshot = $this->getSnapshot($client);
        foreach ($admins as $admin) {
            $response = $this->sendMessage($admin, $text);
            $this->sendNationalCard($admin, $snapshot, $response->message_id);
            $this->sendPassportImage($admin, $snapshot, $response->message_id);
        }
    }

    private function sendMessage(Client $client, $text)
    {
        return Telegram::chatId($client->tid)->sendMessage(['text' => $text, 'parse_mode' => 'Markdown']);
    }

    private function sendPhoto(Client $client, $photo, $messageId)
    {
        Telegram::chatId($client->tid)->sendPhoto(['photo' => $photo, 'reply_to_message_id' => $messageId]);
    }

    private function sendNationalCard(Client $client, Snapshot $snapshot, $messageId)
    {
        if ($image = optional($snapshot->data->get('national_card_images'))[0]) {
            $this->sendPhoto($client, $image['file_id'], $messageId);
        }
    }

    private function sendPassportImage(Client $client, Snapshot $snapshot, $messageId)
    {
        if ($image = optional($snapshot->data->get('passport_images'))[0]) {
            $this->sendPhoto($client, $image['file_id'], $messageId);
        }
    }
}

<?php

namespace App\Arbaeen\Stages;


class SelectFinanceOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'card_payment',
        'online_payment',
    ];

    public function isOk()
    {
        return $this->isDataValid();
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $this->replaceMessage(__('telegram.errors.select_finance_options'), ShowFinanceOptions::buttons());
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {
        $this->addStageOption(collect(['finance' => $this->data()]));

        switch ($this->data()) {
            case 'card_payment':
                $this->setStage(CardPayment::class);
                break;
            case 'online_payment':
                $this->setStage(OnlinePayment::class);
                break;
        }
    }
}

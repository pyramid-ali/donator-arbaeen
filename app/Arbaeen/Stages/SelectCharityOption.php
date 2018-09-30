<?php

namespace App\Arbaeen\Stages;


class SelectCharityOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'finance',
        'equipment_items',
        'consumable_items',
        'drug_items',
        'other',
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
        $this->replaceMessage(__('telegram.errors.select_charity_option', ShowCharityOptions::buttons()));
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {
        $this->addStageOption(['charity' => $this->data()]);

        switch ($this->data()) {
            case 'finance':
                $this->setStage(ShowFinanceOptions::class);
                break;
            default:
                $this->setStage(ShowDonationProductNameForm::class);
                break;
        }
    }
}

<?php

namespace App\Arbaeen\Stages;


class SelectActivityOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'therapeutic',
        'backing',
        'other_activity'
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
        $this->sendMessage(__('telegram.errors.select_activity_option'), ShowActivityOptions::buttons());
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {
        $this->addStageOption(['activity' => $this->data()]);

        switch ($this->data()) {
            case 'therapeutic':
                $this->setStage(ShowTherapeuticOptions::class);
                break;
            case 'backing':
                $this->setStage(ShowBackingOptions::class);
                break;
            case 'other_activity':
                $this->setStage(ShowOtherActivityNameForm::class);
                break;
        }
    }
}

<?php


namespace App\Arbaeen\Stages;


class SelectBackingOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'worker',
        'receipt',
        'service',
        'protection',
        'installation',
        'health_expert',
        'health_expert',
        'it_expert',
        'other_backing'
    ];

    protected function isOk()
    {
        return $this->isDataValid();
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $this->sendMessage(__('telegram.errors.select_backing_option'), ShowBackingOptions::buttons());
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {
        $this->addStageOption(['sub_activity' => $this->data()]);

        switch ($this->data()) {
            case 'other_backing':
                $this->setStage(ShowBackingServiceNameForm::class);
                break;
            default:
                $this->setStage(Signup::class);
        }
    }
}

<?php

namespace App\Arbaeen\Stages;

class SelectHelpOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'charity',
        'activity'
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
        $this->replaceMessage(__('telegram.errors.select_help_option'), ShowHelpOptions::buttons());
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {

        $this->setStageOptions(['help' => $this->data()]);

        switch ($this->data()) {
            case 'charity':
                $name = ShowCharityOptions::class;
                break;
            case 'activity':
                $name = ShowActivityOptions::class;
                break;
        }

        $this->setStage($name);
    }
}

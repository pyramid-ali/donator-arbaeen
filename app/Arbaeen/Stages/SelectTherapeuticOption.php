<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:35 AM
 */

namespace App\Arbaeen\Stages;


class SelectTherapeuticOption extends Base
{
    use CallbackQuery;

    private $validData = [
        'dentist',
        'doctor',
        'nurse',
        'drug_store',
        'paramedic',
        'paramedical',
        'other_therapeutic'
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
        $this->sendMessage(__('telegram.errors.select_therapeutic_option'), ShowTherapeuticOptions::buttons());
    }

    protected function respondToClient()
    {
        $this->answerCallback(__('telegram.callback.selected', ['name' => __('telegram.words.' . $this->data())]));
    }

    protected function done()
    {
        $this->addStageOption(['sub_activity' => $this->data()]);

        switch ($this->data()) {
            case 'other_therapeutic':
                $this->setStage(ShowTherapeuticServiceNameForm::class);
                break;
            default:
                $this->setStage(Signup::class);
        }
    }
}

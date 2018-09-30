<?php

namespace App\Arbaeen\Stages;


trait StageHelper
{

    /**
     * @param $name
     * @param null $options
     */
    public function setStage($name, $options = null)
    {
        $this->client->stage->setName($name);

        if ($options) {
            $this->setStageOptions(collect($options));
        }
    }

    /**
     * @param $options
     */
    public function setStageOptions($options)
    {
        $this->client->stage->setOptions(collect($options));
    }

    /**
     * @param $option
     */
    public function addStageOption($option)
    {
        $this->client->stage->addOption(collect($option));
    }

    public function resetStage()
    {
        $snapshot = $this->createSnapshot();
        $this->client->stage->delete();
        return $snapshot;
    }

    public function createSnapshot()
    {
        $this->client->snapshots()->create([
            'data' => $this->client->stage->options->toJson()
        ]);
    }

}

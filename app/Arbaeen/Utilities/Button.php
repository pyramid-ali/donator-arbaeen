<?php

namespace App\Arbaeen\Utilities;


class Button
{
    public static function inline($arr, $cols = 1, $backButton = null)
    {
        $buttons = collect();
        $counter = 1;
        $row = collect();
        foreach ($arr as $item) {
            $row->push($item);
            if($counter % $cols == 0 || $arr[count($arr) - 1] === $item) {
                $buttons->push($row);
                $row = collect();
            }
            $counter++;
        }

        if($backButton) {
            $row->push(['text' => __('telegram.buttons.back'), 'callback_data' => $backButton]);
            $buttons->push($row);
        }


        return json_encode(['inline_keyboard' => $buttons->toArray()]);
    }

    public static function reply($arr, $cols, $options = [], $backButton = null)
    {
        $buttons = collect();
        $counter = 1;
        $row = collect();
        foreach ($arr as $item) {
            $row->push($item);
            if($counter % $cols == 0 || $arr[count($arr) - 1] === $item) {
                $buttons->push($row);
                $row = collect();
            }
            $counter++;
        }

        if($backButton) {
            $row->push(['text' => __('telegram.buttons.back')]);
            $buttons->push($row);
        }


        $keyboard = ['keyboard' => $buttons->toArray()];
        $result = array_merge($keyboard, $options);

        return json_encode($result);
    }

    public static function removeKeyboard()
    {
        return json_encode(['remove_keyboard' => true]);
    }
}

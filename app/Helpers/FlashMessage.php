<?php


namespace App\Helpers;

trait FlashMessage
{
    public function message($key, $message)
    {
        session()->flash($key, $message);
    }
}

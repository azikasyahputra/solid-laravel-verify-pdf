<?php

namespace App\Http\Action;

class CheckRecipient
{
    public function __invoke(Object $document): bool
    {
        $recipientName = isset($document->data->recipient->name);
        $recipientEmail = isset($document->data->recipient->email);

        if ($recipientName && $recipientEmail) {
            return true;
        } else {
            return false;
        }
    }
}

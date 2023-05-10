<?php

namespace App\Http\Action;

use App\Http\DataTransferObject\DocumentRecipient;

class CheckRecipient
{
    public function __invoke(DocumentRecipient $request): bool
    {
        $recipientName = isset($request->name);
        $recipientEmail = isset($request->email);

        return $recipientName && $recipientEmail;
    }
}

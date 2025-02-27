<?php

namespace Junges\InviteCodes\Exceptions;

class DuplicateInviteCodeException extends InviteCodesException
{
    /** @throws DuplicateInviteCodeException */
    public static function forEmail(): void
    {
        throw new static("You can't create more than one invite for each email");
    }
}

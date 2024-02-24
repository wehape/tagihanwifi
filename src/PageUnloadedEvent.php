<?php

namespace PHPMaker2024\tagihanwifi01;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Page Unloaded Event
 */
class PageUnloadedEvent extends GenericEvent
{
    public const NAME = "page.unloaded";

    public function getPage(): mixed
    {
        return $this->subject;
    }
}

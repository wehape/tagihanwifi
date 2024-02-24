<?php

namespace PHPMaker2024\tagihanwifi01;

/**
 * Advanced filter class
 */
class AdvancedFilter
{
    public $Enabled = true;

    public function __construct(
        public $ID,
        public $Name,
        public $FunctionName,
    ) {
    }
}

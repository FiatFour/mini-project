<?php

namespace App\Enums;

abstract class AccidentStatusEnum
{
    const WAITING_CLAIM = 'WAITING_CLAIM';
    const WAITING_REPAIR = 'WAITING_REPAIR';
    const IN_PROGRESS = 'IN_PROGRESS';
    const SUCCESS = 'SUCCESS';
    const NOT_REPAIR = 'NOT_REPAIR';
    const TTL = 'TTL';

    const WAITING_OPEN_ORDER = 'WAITING_OPEN_ORDER';
    const OPEN_ORDER = 'OPEN_ORDER';
}

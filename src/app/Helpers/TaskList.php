<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class TaskList
{
    const CANNOT_START_YET = 'Cannot start yet';

    const NOT_STARTED = 'Not started';

    const IN_PROGRESS = 'In progress';

    const COMPLETED = 'Completed';

    const STATUSES = [
        self::CANNOT_START_YET => 'grey',
        self::NOT_STARTED => 'grey',
        self::IN_PROGRESS => 'light-blue',
        self::COMPLETED => 'blue',
    ];
}

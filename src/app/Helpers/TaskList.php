<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class TaskList
{
    const CANNOT_START = 'Cannot start yet';

    const COMPLETED = 'Completed';

    const IN_PROGRESS = 'In progress';

    const NOT_STARTED = 'Not yet started';

    const PROBLEM = 'There is a problem';

    const STATUSES = [
        self::CANNOT_START => null,
        self::NOT_STARTED => 'yellow',
        self::IN_PROGRESS => 'blue',
        self::PROBLEM => 'red',
        self::COMPLETED => 'green',
    ];
}

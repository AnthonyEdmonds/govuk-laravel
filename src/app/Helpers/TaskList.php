<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class TaskList
{
    public const CANNOT_START = 'Cannot start yet';

    public const COMPLETED = 'Completed';

    public const IN_PROGRESS = 'In progress';

    public const NOT_STARTED = 'Not yet started';

    public const PROBLEM = 'There is a problem';

    public const STATUSES = [
        self::CANNOT_START => null,
        self::NOT_STARTED => 'yellow',
        self::IN_PROGRESS => 'blue',
        self::PROBLEM => 'red',
        self::COMPLETED => 'green',
    ];
}

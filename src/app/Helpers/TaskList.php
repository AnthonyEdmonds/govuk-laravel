<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class TaskList
{
    public const string CANNOT_START = 'Cannot start yet';

    public const string COMPLETED = 'Completed';

    public const string IN_PROGRESS = 'In progress';

    public const string NOT_STARTED = 'Not yet started';

    public const string PROBLEM = 'There is a problem';

    public const array STATUSES = [
        self::CANNOT_START => null,
        self::NOT_STARTED => 'yellow',
        self::IN_PROGRESS => 'blue',
        self::PROBLEM => 'red',
        self::COMPLETED => 'green',
    ];
}

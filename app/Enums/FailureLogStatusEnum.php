<?php

namespace App\Enums;

enum FailureLogStatusEnum: string
{
    case OPEN = 'open';
    case ANALYZED = 'analyzed';
    case ESCALATED = 'escalated';
    case RESOLVED = 'resolved';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::ANALYZED => 'Analyzed',
            self::ESCALATED => 'Escalated',
            self::RESOLVED => 'Resolved',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OPEN => 'danger',
            self::ANALYZED => 'primary',
            self::ESCALATED => 'warning',
            self::RESOLVED => 'success',
        };
    }
}

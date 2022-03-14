<?php

namespace App\classes;

class NotificationClass
{
    public function __construct(
        public  string  $title = '',
        public  string  $message = '',
        public  bool $userSettingAvailableNotification = true,
        public ?array $relatedData = null
    ) {}

    public static function new(...$args): self
    {
        return new self(...$args);
    }
}

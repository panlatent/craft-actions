<?php

namespace panlatent\craft\actions\triggers;

use panlatent\craft\actions\base\Trigger;
use panlatent\craft\actions\base\WithCronExpression;
use panlatent\craft\actions\helpers\CronHelper;

abstract class Timer extends Trigger implements WithCronExpression
{
    /**
     * @var string|null
     */
    public ?string $expression = null;

    public function getCronExpression(): string
    {
        return $this->expression;
    }

    public function getCronDescription(): string
    {
        return CronHelper::toDescription($this->expression);
    }

    /**
     * @param string $cron
     */
    public function setCronExpression(string $cron): void
    {
        [$this->minute, $this->hour, $this->day, $this->month, $this->week, ] = explode(' ', $cron);
    }
}
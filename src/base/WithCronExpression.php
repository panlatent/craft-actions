<?php

namespace panlatent\craft\actions\base;

interface WithCronExpression
{
    /**
     * Returns cron expression.
     *
     * @return string
     */
    public function getCronExpression(): string;
}
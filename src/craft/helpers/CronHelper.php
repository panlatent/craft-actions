<?php

namespace panlatent\craft\actions\helpers;

use Craft;
use Panlatent\CronExpressionDescriptor\Exceptions\ExpressionException;
use Panlatent\CronExpressionDescriptor\ExpressionDescriptor;

abstract class CronHelper
{
    /**
     * @param string|array $expression
     * @param bool $throw
     * @return string
     * @throws ExpressionException
     */
    public static function toDescription(string|array $expression, bool $throw = true): string
    {
        $targetLanguage = Craft::$app->getTargetLanguage();
        if ($targetLanguage === 'zh') {
            $targetLanguage = 'zh-Hans';
        }

        try {
            $descriptor = new ExpressionDescriptor($expression, $targetLanguage);
        } catch (ExpressionException $exception) {
            if ($throw) {
                throw $exception;
            }
            return '';
        }

        return $descriptor->getDescription();
    }
}
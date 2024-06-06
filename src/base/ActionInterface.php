<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponentInterface;
use panlatent\craft\actions\enums\ActionKind;

interface ActionInterface extends ActionAbstractInterface, SavableComponentInterface
{
    public static function defineKind(): ActionKind;
}
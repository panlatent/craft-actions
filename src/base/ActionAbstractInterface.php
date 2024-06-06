<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponentInterface;
use panlatent\craft\actions\enums\ActionKind;

interface ActionAbstractInterface
{
    public function execute(ContextInterface $context): bool;
}
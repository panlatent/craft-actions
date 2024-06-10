<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponent;
use Panlatent\Actions\TriggerInterface;

abstract class Trigger extends SavableComponent implements TriggerInterface
{
    use TriggerTrait;
}
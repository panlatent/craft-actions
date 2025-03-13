<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponent;
use Panlatent\Action\TriggerInterface;

abstract class Trigger extends SavableComponent implements TriggerInterface
{
    use TriggerTrait;
}
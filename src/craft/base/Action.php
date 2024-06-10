<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponent;
use Panlatent\Actions\ActionInterface;

abstract class Action extends SavableComponent implements ActionInterface
{
    use ActionTrait;
}
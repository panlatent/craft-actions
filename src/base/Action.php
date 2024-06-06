<?php

namespace panlatent\craft\actions\base;

use craft\base\SavableComponent;

abstract class Action extends SavableComponent implements ActionAbstractInterface
{
    use ActionTrait;
}
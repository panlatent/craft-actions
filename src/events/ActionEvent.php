<?php

namespace panlatent\craft\actions\events;

use craft\events\ModelEvent;
use panlatent\craft\actions\base\ActionInterface;

class ActionEvent extends ModelEvent
{
    public ?ActionInterface $action;
}
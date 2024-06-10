<?php

namespace panlatent\craft\actions\events;

use craft\events\ModelEvent;
use Panlatent\Actions\ActionInterface;

class ActionEvent extends ModelEvent
{
    public ?ActionInterface $action;
}
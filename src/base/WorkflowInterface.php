<?php

namespace panlatent\craft\actions\base;

interface WorkflowInterface
{
    public function getTriggers();
    public function getConditions();
    public function getActions();
}
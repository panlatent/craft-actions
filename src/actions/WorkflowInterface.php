<?php

namespace Panlatent\Actions;

interface WorkflowInterface
{
    public function getTriggers();
    public function getConditions();
    public function getActions();
}
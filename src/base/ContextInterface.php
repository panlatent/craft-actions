<?php

namespace panlatent\craft\actions\base;

interface ContextInterface
{
    public function getInput(): InputInterface;

    public function getLogger();


}
<?php

namespace panlatent\craft\actions\base;

interface ActionInterface
{
    public function run(ContextInterface $context): OutputInterface;
}
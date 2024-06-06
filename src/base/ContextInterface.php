<?php

namespace panlatent\craft\actions\base;

interface ContextInterface
{
    public function getInput(): InputInterface;

    public function getOutput(): OutputInterface;

    public function getLogger();
}
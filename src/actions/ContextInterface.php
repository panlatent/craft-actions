<?php

namespace Panlatent\Actions;

interface ContextInterface
{
    public function getInput(): InputInterface;

    public function getOutput(): OutputInterface;

    public function getLogger();
}
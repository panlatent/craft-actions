<?php

namespace Panlatent\Actions;

interface ActionInterface
{
    public function execute(ContextInterface $context): bool;
}
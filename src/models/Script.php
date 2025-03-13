<?php

namespace panlatent\craft\actions\models;

use craft\base\Model;
use Panlatent\Action\ActionInterface;
use Panlatent\Action\ContextInterface;
use panlatent\craft\actions\Plugin;

class Script extends Model implements ActionInterface
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $handle = null;
    public ?string $uid = null;

    private ?array $_actions = null;

    public function execute(ContextInterface $context): bool
    {
        $actions = $this->getActions();
        foreach ($actions as $action) {
            if (!$action->execute($context)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        if ($this->_actions === null) {
            $this->_actions = Plugin::getInstance()->actions->getScriptActions($this->id) ?? false;
        }
        return $this->_actions;
    }
}
<?php

namespace panlatent\craft\actions\services;

use Craft;
use craft\db\Query;
use craft\events\ConfigEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\ArrayHelper;
use craft\helpers\Component as ComponentHelper;
use craft\helpers\Db;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use Panlatent\Actions\ActionInterface;
use panlatent\craft\actions\base\Service;
use panlatent\craft\actions\db\Table;
use panlatent\craft\actions\events\ActionEvent;

class Actions extends Service
{
    public const EVENT_REGISTER_ACTION_TYPES = 'registerActionTypes';
    public const EVENT_AFTER_SAVE_ACTION = 'afterSaveAction';

    private ?array $_actions;

    /**
     * @return string[]
     */
    public function getAllActionTypes(): array
    {
        $types = [];
        $event = new RegisterComponentTypesEvent(['types' => $types]);
        $this->trigger(self::EVENT_REGISTER_ACTION_TYPES, $event);
        return $event->types;
    }

    public function getAllActions(): array
    {
        if ($this->_actions === null) {
            $this->_actions = [];
            foreach ($this->_createQuery()->all() as $row) {
                $this->_actions[] = $this->createAction($row);
            }
        }
        return $this->_actions;
    }

    public function getActionByUid(string $uid): ?ActionInterface
    {
        return ArrayHelper::firstWhere($this->getAllActions(), 'uid', $uid);
    }

    public function createAction(array $config): ActionInterface
    {
        try {
            return ComponentHelper::createComponent($config, ActionInterface::class);
        } catch (\Throwable $exception) {
            throw new \InvalidArgumentException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function saveAction(ActionInterface $action, bool $runValidation = true): bool
    {
        $isNew = $action->getIsNew();

        if ($isNew) {
            $action->uid = StringHelper::UUID();
        } elseif (!$action->uid) {
            $action->uid = Db::uidById(Table::ACTIONS, $action->id);
        }

        if ($runValidation && !$action->validate()) {
            Craft::info('Action not saved due to validation error.', __METHOD__);
            return false;
        }

        $path = "actions.actions.{$action->uid}";

        Craft::$app->getProjectConfig()->set($path, [
            'name' => $action->name,
            'handle' => $action->handle,
            'type' => $action->type,
            'settings' => $action->getSettings(),
        ]);

        if ($isNew) {
            $action->id = Db::idByUid(Table::ACTIONS, $action->uid);
        }

        return true;
    }

    public function handleChangeAction(ConfigEvent $event): void
    {
        $uid = $event->tokenMatches[0];

        $id = Db::idByUid(Table::ACTIONS, $uid);
        $isNew = empty($id);

        if ($isNew) {
            Db::insert(Table::ACTIONS, [
                'name' => $event->newValue['name'],
                'handle' => $event->newValue['handle'],
                'type' => $event->newValue['type'],
                'settings' => Json::encode($event->newValue['settings'] ?? []),
                'uid' => $uid,
            ]);
        } else {
            Db::update(Table::ACTIONS, [
                'name' => $event->newValue['name'],
                'handle' => $event->newValue['handle'],
                'type' => $event->newValue['type'],
                'settings' => Json::encode($event->newValue['settings'] ?? []),
            ], ['id' => $id]);
        }

        if ($this->hasEventHandlers(self::EVENT_AFTER_SAVE_ACTION)) {
            $this->trigger(self::EVENT_AFTER_SAVE_ACTION, new ActionEvent([
                'action' => $this->getActionByUid($uid),
                'isNew' => $isNew,
            ]));
        }
    }

    private function _createQuery(): Query
    {
        return (new Query())
            ->select([
                'actions.id',
                'actions.name',
                'actions.handle',
                'actions.type',
                'actions.settings',
                'actions.description',
                'actions.dateCreated',
                'actions.dateUpdated',
                'actions.uid',
            ])
            ->from(['actions' => Table::ACTIONS]);

    }
}
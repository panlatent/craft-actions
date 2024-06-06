<?php

namespace panlatent\craft\actions;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use panlatent\craft\actions\models\Settings;
use panlatent\craft\actions\services\Actions;

/**
 * Actions plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @property-read Actions $actions
 * @author Panlatent <panlatent@gmail.com>
 * @copyright Panlatent
 * @license https://craftcms.github.io/license/ Craft License
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                'actions' => Actions::class,
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('actions/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}

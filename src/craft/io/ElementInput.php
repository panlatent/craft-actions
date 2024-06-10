<?php

namespace panlatent\craft\actions\io;

use craft\base\ElementInterface;
use Panlatent\Actions\InputInterface;

class ElementInput implements InputInterface
{
    public int $elementId;

    public function getElement(): ElementInterface
    {
        return \Craft::$app->getElements()->getElementById($this->elementId);
    }
}
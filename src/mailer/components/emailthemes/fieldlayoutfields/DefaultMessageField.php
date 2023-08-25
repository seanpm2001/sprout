<?php

namespace BarrelStrength\Sprout\mailer\components\emailthemes\fieldlayoutfields;

use Craft;
use craft\base\ElementInterface;
use craft\fieldlayoutelements\TextareaField;
use craft\fieldlayoutelements\TextField;

class DefaultMessageField extends TextareaField
{
    public bool $mandatory = true;

    public string $attribute = 'defaultMessage';

    public string|array|null $class = 'nicetext fullwidth';

    public ?int $rows = 11;

    public ?int $maxlength = 255;

    protected function defaultLabel(ElementInterface $element = null, bool $static = false): ?string
    {
        return Craft::t('sprout-module-mailer', 'Message');
    }

    protected function defaultInstructions(ElementInterface $element = null, bool $static = false): ?string
    {
        return Craft::t('sprout-module-mailer', 'A message that will appear in the body of your email content.');
    }
}

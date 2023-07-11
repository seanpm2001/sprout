<?php

namespace BarrelStrength\Sprout\forms\components\notificationevents;

use BarrelStrength\Sprout\forms\components\elements\conditions\SubmissionCondition;
use BarrelStrength\Sprout\forms\components\elements\SubmissionElement;
use BarrelStrength\Sprout\forms\components\events\OnSaveSubmissionEvent;
use BarrelStrength\Sprout\forms\forms\Submissions;
use BarrelStrength\Sprout\forms\FormsModule;
use BarrelStrength\Sprout\transactional\notificationevents\ElementEventInterface;
use BarrelStrength\Sprout\transactional\notificationevents\ElementEventTrait;
use BarrelStrength\Sprout\transactional\notificationevents\NotificationEvent;
use Craft;
use craft\base\ElementInterface;
use craft\elements\conditions\entries\EntryCondition;
use craft\elements\Entry;
use craft\events\ElementEvent;
use craft\events\ModelEvent;
use craft\helpers\Html;
use craft\helpers\Template;
use yii\base\Event;

class SaveSubmissionNotificationEvent extends NotificationEvent implements ElementEventInterface
{
    use ElementEventTrait;

    public static function displayName(): string
    {
        return Craft::t('sprout-module-forms', 'When a form submission is saved (Sprout)');
    }

    public static function conditionType(): string
    {
        return SubmissionCondition::class;
    }

    public static function elementType(): string
    {
        return SubmissionElement::class;
    }

    public static function getEventClassName(): ?string
    {
        return Submissions::class;
    }

    public static function getEventName(): ?string
    {
        return SubmissionElement::EVENT_AFTER_SAVE;
    }

    public function getEventHandlerClassName(): ?string
    {
        return OnSaveSubmissionEvent::class;
    }

    public function getTipHtml(): ?string
    {
        $html = Html::tag('p', Craft::t('sprout-module-forms','Access the Form Submission Element in your email templates using the <code>object</code> variable. Example:'));
        $html .= Html::tag('p', Html::tag('em', Craft::t('sprout-module-forms', 'We have received your submission, <code>{{ object.customNameFieldHandle }}</code>')));

        return $html;
    }

    public function getEventObject(): mixed
    {
        /** @var ElementEvent $event */
        $event = $this->event ?? null;

        return $event->element ?? null;
    }

    /**
     * @todo fix bug where incorrect form can be selected.
     */
    public function getMockEventObject(): mixed
    {
        $criteria = SubmissionElement::find();
        $criteria->orderBy(['id' => SORT_DESC]);

        if (!empty($this->formIds)) {

            $formId = count($this->formIds) == 1 ? $this->formIds[0] : array_shift($this->formIds);

            $criteria->formId = $formId;
        }

        $submission = $criteria->one();

        if ($submission) {
            return $submission;
        }

        Craft::warning('Unable to generate a mock form Submission. Make sure you have at least one Submission submitted in your database.', __METHOD__);

        return null;
    }

    public function matchNotificationEvent(Event $event): bool
    {
        if (!$event instanceof OnSaveSubmissionEvent) {
            return false;
        }

        $element = $event->submission;

        if (!$event->isNewSubmission) {
            return false;
        }

        if ($element->hasCaptchaErrors()) {
            return false;
        }

        return $this->matchElement($element);
    }
}

<?php
/**
 * CraftyAlgolia plugin for Craft CMS 3.x
 *
 * A Crafty Algolia plugin
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace delaneymethod\craftyalgolia\controllers;

use Craft;
use craft\web\Controller;
use delaneymethod\craftyalgolia\CraftyAlgolia;
use delaneymethod\craftyalgolia\models\CraftyAlgoliaSettingsModel;

/**
 * CraftyAlgoliaFeedbackController Controller
 *
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 */
class CraftyAlgoliaFeedbackController extends Controller {
	/**
	 * @var string
	 */
	public string $subject = '';

	/**
	 * @var string
	 */
	public string $topic = '';

	/**
	 * @var string
	 */
	public string $message = '';

	/**
	 * @throws \craft\errors\MissingComponentException
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function actionSendEmail() {
		// This action should only be available to the control panel
		$this->requireCpRequest();

		$request = Craft::$app->getRequest();

		/**
		 * @var CraftyAlgoliaSettingsModel $settings
		 */
		$settings = CraftyAlgolia::$plugin->getSettings();

		$this->subject = $request->getRequiredParam('subject');
		$this->topic = $request->getParam('topic');
		$this->message = $request->getRequiredParam('message');

		$user = Craft::$app->getUser()->getIdentity();

		$mailer = Craft::$app->getMailer();

		$message = $mailer
			->compose()
			->setFrom($user->email)
			->setTo($settings->notificationEmail)
			->setSubject($this->subject)
			->setHtmlBody($this->message);

		$success = $message->send();

		if ($success) {
			Craft::$app->getSession()->setNotice('Feedback successfully sent.');
		} else {
			Craft::$app->getSession()->setError('Feedback could not be sent.');
		}
	}
}

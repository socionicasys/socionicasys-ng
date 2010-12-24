<?php

class SiteController extends Controller
{
	public $layout = '//layouts/section-wide';
	public $layoutClass = 'wide';
	
	public function filters()
	{
		return array(
			'rights + fileManager, browse',
			array(
				'COutputCache + sitemap',
				'duration' => 86400,
			),
		);
	}
	
	public function actions()
	{
		$actions = array();
		if (isset(Yii::app()->params['enableFileManager'])
			&& Yii::app()->params['enableFileManager'])
		{
			$actions = CMap::mergeArray($actions, array(
				'fileManager' => array(
					'class' => 'ext.yiiext.widgets.elfinder.ElFinderAction',
					'root' => Yii::getPathOfAlias('webroot.images'),
					'URL' => Yii::app()->baseUrl . '/images/',
					'rootAlias' => 'Изображения',
					'disabled' => array(
						'extract',
						'archive',
					),
					'logger' => new FileOperationsLogger(),
				),
			));
		}
		return $actions;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionLogin()
	{
		$model = new LoginForm();
		
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login())
			{
				if (isset($_POST['backUrl']))
				{
					$backUrl = $_POST['backUrl'];
				}
				else
				{
					$backUrl = Yii::app()->homeUrl;
				}
				$this->redirect($backUrl);
			}
		}

		$backUrl = Yii::app()->user->returnUrl;
		if (empty($backUrl) || ($backUrl === Yii::app()->request->scriptUrl))
		{
			$backUrl = Yii::app()->request->urlReferrer;
		}
		if (empty($backUrl))
		{
			$backUrl = Yii::app()->homeUrl;
		}

		$this->render('login', array(
			'model' => $model,
			'backUrl' => $backUrl,
		));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$backUrl = Yii::app()->request->urlReferrer;
		if (empty($backUrl))
		{
			$backUrl = Yii::app()->homeUrl;
		}
		$this->redirect($backUrl);
	}
	
	public function actionBrowse()
	{
		if (!isset(Yii::app()->params['enableFileManager'])
			|| !Yii::app()->params['enableFileManager'])
		{
			throw new CHttpException(404, 'Страница не найдена');
		}
		$this->layout='//site/browse';
		$this->renderText($this->widget('ext.yiiext.widgets.elfinder.ElFinderWidget', array(
			'lang' => Yii::app()->getLanguage(),
			'url' => CHtml::normalizeUrl(array('site/fileManager')),
			'places' => '',
			'editorCallback' => 'js:function(url) {
				var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
				window.opener.CKEDITOR.tools.callFunction(funcNum, url);
				window.close();
			}',
		), true));
	}

	public function actionSitemap()
	{
		header('Content-Type: application/xml');
		$this->renderPartial('sitemap-xml', array(
			'news' => News::model()->findAll(),
			'pages' => Nav::model()->findAll('level>1'),
			'articles' => Library::model()->findAll(),
		));
	}

	public function actionContact()
	{
		$model = new ContactForm;
		$params = Yii::app()->params;
		if (isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate())
			{
				spl_autoload_unregister(array('YiiBase','autoload'));
				Yii::import('application.vendors.swiftmailer.swift_required', true);
				spl_autoload_register(array('YiiBase','autoload'));

				$message = Swift_Message::newInstance()
						->setSubject('Форма контакта')
						->setFrom(array($model->email => $model->name))
						->setSender(array($params['adminEmail']))
						->setTo(array($params['adminEmail']))
						->setBody($model->body);

				$transport = Swift_SmtpTransport::newInstance(
					$params['smtp.server'],
					$params['smtp.port'],
					$params['smtp.encryption'])
						->setUsername($params['smtp.username'])
						->setPassword($params['smtp.password']);

				$mailer = Swift_Mailer::newInstance($transport);
				$result = $mailer->send($message);
				Yii::log($result);

				$this->refresh();
			}
		}
		$this->layout = '//layouts/section';
		$this->layoutClass = 'narrow';
		$this->render('contact', array(
			'model' => $model,
			'adminEmail' => $params['adminEmail'],
		));
	}
}

require_once(Yii::getPathOfAlias('ext.yiiext.widgets.elfinder') . '/elFinder.class.php');

class FileOperationsLogger implements elFinderILogger
{
	/**
	 * @param string $cmd
	 * @param boolean $ok
	 * @param array $context
	 * @param string $err
	 * @param array $errorData
	 * @see elFinderILogger::log()
	 */
	public function log($cmd, $ok, $context, $err = '', $errorData = array())
	{
		Yii::app()->user->name;
		$message = "Command: '$cmd' from user " . Yii::app()->user->name;
		$message .= ' (IP ' . Yii::app()->request->userHostAddress . ')';
		$message .= "\nContext: " . CVarDumper::dumpAsString($context) . "\n";
		if ($ok)
		{
			$message .= 'Result: OK';
		}
		else
		{
			$message .= "Result: FAILED. Error message $err\n";
			$message .= 'ErrorData: ' . CVarDumper::dumpAsString($errorData); 
		}
		Yii::log($message, 'debug', 'FileOperationsLogger');
		// Сохранить логи до вызова exit() в коде elFinder.class
		Yii::app()->log->processLogs(new CEvent($this));
	}
}

<?php

/**
 * GitController облегчает разворачивание веб-сайта через git.
 * 
 * Информация о репозиториях берется из параметра 'git' приложения. Ожидается,
 * что этот параметр имеет вид ассоциативного массива:
 * <pre>
 * array(
 *     'path' => 'путь к git',
 *     'repositoties' => array(
 *         'ключ репозитория' => 'путь к репозиторию',
 *     ),
 * )
 * </pre>
 * 
 * @author Grey Teardrop
 */
class GitController extends Controller
{
	public function filters()
	{
		return array(
			'postOnly',
		);
	}
	
	/**
	 * При обращении (POST) к этому действию происходит синхронизация репозитория,
	 * с ключом, заданным параметром 'id'.
	 */
	public function actionPull()
	{
		Yii::log('git pull request came from ' . Yii::app()->request->userHostAddress, 'info');
		if (!isset($_GET['id']) || !isset(Yii::app()->params['git']))
		{
			throw new CHttpException(404);
		}
		
		$id = $_GET['id'];
		$gitParams = Yii::app()->params['git'];
		if (!isset($gitParams['repositories'][$id]))
		{
			throw new CHttpException(404);
		}
		
		$gitPath = $gitParams['path'];
		$repositoryPath = $gitParams['repositories'][$id];
		Yii::log("performing git pull in repository $repositoryPath (key $id)", 'info');
		chdir($repositoryPath);
		exec($gitPath . 'git pull');
	}
}

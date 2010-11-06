<?php

class RandomQuote extends CWidget
{
	public function run()
	{
		$webUser = Yii::app()->user;
		$quoteCount = Quote::model()->count();
		if ($quoteCount === 0)
		{
			return;
		}
		if ($webUser->hasState('prevQuote') && $quoteCount >= 2)
		{
			$offset = mt_rand(0, $quoteCount - 2);
			if ($offset >= $webUser->getState('prevQuote'))
			{
				$offset++;
			}
		}
		else
		{
			$offset = mt_rand(0, $quoteCount - 1);
		}
		$webUser->setState('prevQuote', $offset);
		
		$quote = Quote::model()->find(array(
			'offset' => $offset,
		));

		if (strpos($quote->text, '<p>') === false)
		{
			$quote->text = '<p>' . $quote->text . '</p>';
		}

		$this->render('random-quote', array(
			'quote' => $quote,
		));
	}
}

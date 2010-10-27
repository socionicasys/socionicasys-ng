<?php
/**
 * Вспомогательный класс, содержащий функции работы со строками.
 */
class TextHelper
{
	/**
	 * Обрезает текст до необходимой длины, при необходимости добавляя к нему индикатор (...).
	 * @static
	 * @param string $text исходный текст
	 * @param int $length максимальная длина результирующего текста
	 * @param string $indicator строка-индикатор того, что текст укорочен
	 * @param bool $wholeWord если этот параметр равер true, укорачивание происходит по границам слов, иначе — в любом
	 * месте
	 * @return string укороченный текст 
	 */
	static function truncate($text, $length, $indicator = '...', $wholeWord = false)
	{
		if (mb_strlen($text) <= $length)
		{
			return $text;
		}

		$shortLength = $length - mb_strlen($indicator);
	    if (!$wholeWord)
	    {
		    return mb_substr($text, 0, $shortLength) . $indicator;
	    }

	    $i = $shortLength;
	    while ($i >= 0 && !ctype_space(mb_substr($text, $i, 1)))
	    {
		    $i--;
	    }
	    while ($i >= 0 && ctype_space(mb_substr($text, $i, 1)))
	    {
		    $i--;
	    }

	    if ($i <= 0)
	    {
		    return mb_substr($text, 0, $shortLength) . $indicator;
	    }
	    else
	    {
		    return mb_substr($text, 0, $i + 1) . $indicator;
	    }
	}
}

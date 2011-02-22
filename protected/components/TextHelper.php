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
		mb_internal_encoding('UTF-8');
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

	/**
	 * Функция необратимой транслитерации для SEO.
	 * Текст в таком транслите утрачивает однозначность и восстановлению не поделижит,
	 * (при этом всё-таки сохраняя читабельность для посетителей сайта)
	 * так же как *не может* быть напрямую использован как уникальный идентификатор
	 * при соответствующем ограничении наложенном на кириллический заголовок.
	 * Данную проблему можно решить двумя путями - ставить ограничение именно на
	 * транслитерированный заголовок, для чего завести в базе соответствующее поле,
	 * либо дополнять ссылку реальным идентификатором.
	 *
	 * Но при всех недостатках этот транслит понятен поисковикам
	 * и послужит дополнительным бонусом при ранжировании поисковой
	 * выдачи (за некоторыми исключениями, описанными в этой статье:
	 * http://blessmaster.livejournal.com/115715.html
	 *
	 * @param string $text текст для транслитерации
	 * @return string транслитерированную строку
	 * @author BlessMaster (deep-dream@ya.ru)
	 */
	static function rus2translit($text)
	{
		$text = mb_strtoupper($text, 'UTF-8');

		$exchange = array(
			'А'=>'a',
			'Б'=>'b',
			'В'=>'v',
			'Г'=>'g',
			'Д'=>'d',
			'Е'=>'e',
			'Ё'=>'e',
			'Ж'=>'zh',
			'З'=>'z',
			'И'=>'i',
			'Й'=>'j',
			'К'=>'k',
			'Л'=>'l',
			'М'=>'m',
			'Н'=>'n',
			'О'=>'o',
			'П'=>'p',
			'Р'=>'r',
			'С'=>'s',
			'Т'=>'t',
			'У'=>'u',
			'Ф'=>'f',
			'Х'=>'h',
			'Ц'=>'c',
			'Ч'=>'ch',
			'Ш'=>'sh',
			'Щ'=>'shch',
			'Ъ'=>'',
			'Ы'=>'y',
			'Ь'=>'',
			'Э'=>'e',
			'Ю'=>'ju',
			'Я'=>'ja',
			' '=>'-', // сохраняем пробел от перехода в %20 понятным гуглу способом
			','=>'',
			'"'=>'-',
			"'"=>'-',
			'\\' => '',
			'?' => '',
			':' => '',
		);
		$text = str_replace(array_keys($exchange), array_values($exchange), $text);
		// Остальные символы - уже никуда не денешься
		$text = rawurlencode($text);
		return $text;
	}
}

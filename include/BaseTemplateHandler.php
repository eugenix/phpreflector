<?php
/**
 * Базовый класс обработчика шаблона
 * Заменяет в файле шаблоне переменные вида {UPPER_CASE} на значения,
 * которые возвращают соответсвующие методы подкласса.
 *
 * Примеры соответстивй переменной-шаблона и метода:
 * {MY_VAR} - getMyVar()
 * {NAME} - getName()
 *
 * PHP version 5
 *
 * @package
 * @author   Eugene Kurbatov <ekur@i-loto.ru>
 */

class BaseTemplateHandler
{
	/**
	 * Обработка шаблона, подстановка значений переменных
	 *
	 * @param $tplFilename Путь к файлу шаблона
	 *
	 * @return string
	 */
	public function process($tplFilename)
	{
		$content = file_get_contents($tplFilename);

		$matches = array();
		preg_match_all("/{[[:upper:]_]*?}/", $content, $matches);

		$values = array();
		foreach ($matches[0] as $p)
		{
			$match = array();
			preg_match("/{([[:upper:]_]*)}/is", $p, $match);

			$methodName = $this->convertVarNameToMethodName($match[1]);
			$values[] = $this->$methodName();
		}

		$patterns = array_map
		(
			function($val)
			{
				return "/$val/";
			},
			$matches[0]
		);
		return preg_replace($patterns, $values, $content);
	}

	private function convertVarNameToMethodName($varName)
	{
		$methodName = "get";
		foreach (explode("_", $varName) as $v)
		{
			$methodName .= ucfirst(strtolower($v));
		}
		return $methodName;
	}
}

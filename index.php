<?php

namespace Stein197\Caser;

use Exception;
use function array_map;
use function join;
use function preg_split;
use function strtolower;
use function strtoupper;
use function ucfirst;
use function lcfirst;
use const PREG_SPLIT_NO_EMPTY;

const SPLIT_REGEX = '/(?<=[a-z0-9])(?=[A-Z0-9])|(?<=[A-Z0-9])(?=[A-Z0-9][a-z0-9])|[^\w]+|_/';

/**
 * Converts a string to the given case.
 * @param string $string String to convert.
 * @param Casing $case To which case convert the string.
 * @param bool $preserveAbbreviations Do not change case of abbreviations such as 'HTML', 'HTTP' and so on.
 * @return string String with converted case.
 * @throws Exception If the `$case` is unknown.
 */
function convert(string $string, Casing $case, bool $preserveAbbreviations = true): string {
	$words = array_map(fn (string $word): string => strtoupper($word) === $word && $preserveAbbreviations ? $word : strtolower($word), split($string));
	return match ($case) {
		Casing::Camel => strtoupper(@$words[0]) === @$words[0] && $preserveAbbreviations ? convert($string, Casing::Pascal, $preserveAbbreviations) : lcfirst(convert($string, Casing::Pascal, $preserveAbbreviations)),
		Casing::Header => join('-', array_map(ucfirst(...), $words)),
		Casing::Kebab => join('-', $words),
		Casing::Pascal => join('', array_map(ucfirst(...), $words)),
		Casing::Snake => join('_', $words),
		Casing::Upper => strtoupper(join('_', $words)),
		default => throw new Exception("Unknown casing {$case}")
	};
}

/**
 * Splits the string into array of words that this string consists of, preserving the case. For example, the word
 * 'camelCase' would be splitted into `['camel', 'Case']`.
 * @param string $string String to split.
 * @return string[] Array of words.
 */
function split(string $string): array {
	return preg_split(SPLIT_REGEX, $string, -1, PREG_SPLIT_NO_EMPTY);
}

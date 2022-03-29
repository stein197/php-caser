<?php

namespace Stein197\Caser;

use PHPUnit\Framework\TestCase;

class CaserTest extends TestCase {

	/**
	 * @dataProvider data
	 */
	public function testConvert(string $string, $_, string $camel, string $upper, string $snake, string $kebab, string $pascal, string $header): void {
		$this->assertEquals($camel, convert($string, Casing::Camel, false), 'Asserting camel case');
		$this->assertEquals($upper, convert($string, Casing::Upper, false), 'Asserting upper case');
		$this->assertEquals($snake, convert($string, Casing::Snake, false), 'Asserting snake case');
		$this->assertEquals($kebab, convert($string, Casing::Kebab, false), 'Asserting kebab case');
		$this->assertEquals($pascal, convert($string, Casing::Pascal, false), 'Asserting pascal case');
		$this->assertEquals($header, convert($string, Casing::Header, false), 'Asserting header case');
	}

	/**
	 * @dataProvider data
	 */
	public function testSplit(string $string, array $extected, ...$_): void {
		$this->assertEquals($extected, split($string));
	}

	/**
	 * [data, parsed, camel, upper, snake, kebab, pascal, header]
	 */
	public function data(): array {
		return [
			["", [], "", "", "", "", "", ""],
			["a", ["a"], "a", "A", "a", "a", "A", "A"],
			["A", ["A"], "a", "A", "a", "a", "A", "A"],
			["Aa", ["Aa"], "aa", "AA", "aa", "aa", "Aa", "Aa"],
			["aA", ["a", "A"], "aA", "A_A", "a_a", "a-a", "AA", "A-A"],
			["AA", ["AA"], "aa", "AA", "aa", "aa", "Aa", "Aa"],
			["aAbB", ["a", "Ab", "B"], "aAbB", "A_AB_B", "a_ab_b", "a-ab-b", "AAbB", "A-Ab-B"],
			["AaBb", ["Aa", "Bb"], "aaBb", "AA_BB", "aa_bb", "aa-bb", "AaBb", "Aa-Bb"],
			["camelCase", ["camel", "Case"], "camelCase", "CAMEL_CASE", "camel_case", "camel-case", "CamelCase", "Camel-Case"],
			["UPPER_CASE", ["UPPER", "CASE"], "upperCase", "UPPER_CASE", "upper_case", "upper-case", "UpperCase", "Upper-Case"],
			["lowercase", ["lowercase"], "lowercase", "LOWERCASE", "lowercase", "lowercase", "Lowercase", "Lowercase"],
			["snake_case", ["snake", "case"], "snakeCase", "SNAKE_CASE", "snake_case", "snake-case", "SnakeCase", "Snake-Case"],
			["kebab-case", ["kebab", "case"], "kebabCase", "KEBAB_CASE", "kebab_case", "kebab-case", "KebabCase", "Kebab-Case"],
			["PascalCase", ["Pascal", "Case"], "pascalCase", "PASCAL_CASE", "pascal_case", "pascal-case", "PascalCase", "Pascal-Case"],
			["Header-Case",["Header", "Case"], "headerCase", "HEADER_CASE", "header_case", "header-case", "HeaderCase", "Header-Case"],
			["innerHTML", ["inner", "HTML"], "innerHtml", "INNER_HTML", "inner_html", "inner-html", "InnerHtml", "Inner-Html"],
			["SVGElement", ["SVG", "Element"], "svgElement", "SVG_ELEMENT", "svg_element", "svg-element", "SvgElement", "Svg-Element"],
			["MOSTComplexExample-Of_THIS--test___CasesMAP", ["MOST", "Complex", "Example", "Of", "THIS", "test", "Cases", "MAP"], "mostComplexExampleOfThisTestCasesMap", "MOST_COMPLEX_EXAMPLE_OF_THIS_TEST_CASES_MAP", "most_complex_example_of_this_test_cases_map", "most-complex-example-of-this-test-cases-map", "MostComplexExampleOfThisTestCasesMap", "Most-Complex-Example-Of-This-Test-Cases-Map"]
		];
	}
}

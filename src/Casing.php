<?php

namespace Stein197\Caser;

/**
 * Default casing options.
 */
enum Casing {
	/** `camelCase` */
	case Camel;
	/** `Header-Case` */
	case Header;
	/** `kebab-case` */
	case Kebab;
	/** `PascalCase` */
	case Pascal;
	/** `snake_case` */
	case Snake;
	/** `UPPER_CASE` */
	case Upper;
}

[![](https://img.shields.io/github/license/stein197/php-caser)](LICENSE)
![](https://img.shields.io/packagist/v/stein197/caser)

# String case converter and parser
This tiny package provides means for converting strings between different cases - such as converting `camelCase` to `snake_case` and so on.

## Installation
```
composer require stein197/caser
```

## Usage:
The package provides two functions and one enum:
```php
use Stein197\Caser\Casing;
use function Stein197\Caser\convert;
use function Stein197\Caser\split;

convert('camelCase', Casing::Pascal); // 'CamelCase'
convert('PascalCase', Casing::Kebab); // 'pascal-case'
split("backgroundColor");             // ['background', 'Color']
```
The library automatically detects where it should split the string. There are 6 casing options available:

```php
Casing::Camel;  // camelCase
Casing::Header; // Header-Case
Casing::Kebab;  // kebab-case
Casing::Pascal; // PascalCase
Casing::Snake;  // snake_case
Casing::Upper;  // UPPER_CASE
```

## Composer scripts
- `test` Run unit tests

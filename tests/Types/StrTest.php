<?php

declare(strict_types=1);

use Phenix\Validation\Rules\RegEx;
use Phenix\Validation\Rules\Size;
use Phenix\Validation\Types\Str;

it('runs validation with required string data', function (array $data, bool $expected) {
    $rules = Str::required()->toArray();

    [$requiredRule, $strRule] = $rules['type'];

    $requiredRule->setField('value');
    $requiredRule->setData($data);

    expect($requiredRule->passes())->toBeTruthy();

    $strRule->setField('value');
    $strRule->setData($data);

    expect($strRule->passes())->toBe($expected);
})->with([
    'string value' => [['value' => 'PHP'], true],
    'numeric value' => [['value' => '01'], true],
    'empty string value' => [['value' => ''], true],
    'string value with space' => [['value' => ' '], true],
    'integer value' => [['value' => 1], false],
    'array value' => [['value' => [1]], false],
    'bool value' => [['value' => true], false],
]);

it('runs validation with size length', function (array $data, int $size, bool $expected) {
    $rules = Str::required()->size($size)->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof Size) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid size' => [['value' => 'PHP'], 3, true],
    'size exceeds maximum allowed' => [['value' => 'PHP'], 2, false],
    'size exceeds minimum allowed' => [['value' => 'PHP'], 4, false],
]);

it('runs validation with regular expression', function (array $data, string $regex, bool $expected) {
    $rules = Str::required()->regex($regex)->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof RegEx) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 'PHP'], '/[A-Z]/', true],
    'invalid value' => [['value' => '123'], '/[A-Z]/', false],
]);

it('runs validation with regular expression to detect alphabetic string', function (array $data, bool $expected) {
    $rules = Str::required()->matchAlpha()->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof RegEx) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 'PHP'], true],
    'invalid value' => [['value' => 'PHP 8'], false],
]);

it('runs validation with regular expression to detect alpha-num string', function (array $data, bool $expected) {
    $rules = Str::required()->matchAlphaNum()->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof RegEx) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 'PHP8'], true],
    'invalid value' => [['value' => 'PHP 8'], false],
]);

it('runs validation with regular expression to detect alpha-dash string', function (array $data, bool $expected) {
    $rules = Str::required()->matchAlphaDash()->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof RegEx) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 'PHP_'], true],
    'invalid value' => [['value' => 'PHP '], false],
]);

<?php

declare(strict_types=1);

use Phenix\Validation\Rules\Between;
use Phenix\Validation\Rules\In;
use Phenix\Validation\Rules\Max;
use Phenix\Validation\Rules\Min;
use Phenix\Validation\Rules\NotIn;
use Phenix\Validation\Types\Integer;

it('runs validation with required integer data', function (array $data, bool $expected) {
    $rules = Integer::required()->toArray();

    [$requiredRule, $strRule] = $rules['type'];

    $requiredRule->setField('value');
    $requiredRule->setData($data);

    expect($requiredRule->passes())->toBeTruthy();

    $strRule->setField('value');
    $strRule->setData($data);

    expect($strRule->passes())->toBe($expected);
})->with([
    'int value' => [['value' => 1], true],
    'negative int value' => [['value' => -1], true],
    'zero value' => [['value' => 0], true],
    'string value' => [['value' => '1'], false],
    'array value' => [['value' => [1]], false],
    'bool value' => [['value' => true], false],
]);

it('runs validation with minimum allowed', function (array $data, bool $expected) {
    $rules = Integer::required()->min(5)->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof Min) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 6], true],
    'valid value with minimum allowed' => [['value' => 5], true],
    'invalid value' => [['value' => 4], false],
]);

it('runs validation with maximum allowed', function (array $data, bool $expected) {
    $rules = Integer::required()->max(5)->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof Max) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 4], true],
    'valid value with maximum allowed' => [['value' => 5], true],
    'invalid value' => [['value' => 6], false],
]);

it('runs validation with between allowed values', function (array $data, bool $expected) {
    $rules = Integer::required()->between(5, 10)->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof Between) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid value' => [['value' => 7], true],
    'valid value with minimum allowed' => [['value' => 5], true],
    'valid value with maximum allowed' => [['value' => 10], true],
    'invalid value exceeds minimum allowed' => [['value' => 4], false],
    'invalid value exceeds maximum allowed' => [['value' => 11], false],
]);

it('runs validation for allowed values in list', function (array $data, bool $expected) {
    $rules = Integer::required()->in([1, 2])->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof In) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'allowed values' => [['value' => 2], true],
    'invalid allowed values' => [['value' => 3], false],
]);

it('runs validation for not allowed values in list', function (array $data, bool $expected) {
    $rules = Integer::required()->notIn([1, 2])->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('value');
        $rule->setData($data);

        if ($rule instanceof NotIn) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'not allowed values' => [['value' => 3], true],
    'invalid not allowed values' => [['value' => 1], false],
]);

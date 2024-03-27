<?php

declare(strict_types=1);

use Phenix\Validation\Rules\Dates\After;
use Phenix\Validation\Rules\Dates\AfterOrEqual;
use Phenix\Validation\Rules\Dates\Before;
use Phenix\Validation\Rules\Dates\BeforeOrEqual;
use Phenix\Validation\Rules\Dates\Equal;
use Phenix\Validation\Rules\Dates\Format;
use Phenix\Validation\Rules\Dates\IsDate;
use Phenix\Validation\Types\Date;
use Phenix\Validation\Util\Date as Dates;

it('runs validation to check received date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof IsDate) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date' => [
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'invalid date' => [
        ['date' => 'invalid'],
        false,
    ],
]);

it('runs validation to check received date is equal to indicated date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->equal(Dates::now()->toDateString())->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof Equal) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date is equal as today' => [
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'invalid date is not equal as today' => [
        ['date' => Dates::now()->addDay()->toDateString()],
        false,
    ],
]);

it('runs validation to check received date is after than indicated date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->after(Dates::now()->toDateString())->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof After) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date is after as today' => [
        ['date' => Dates::now()->addDay()->toDateString()],
        true,
    ],
    'invalid date is not after as today' => [
        ['date' => Dates::now()->toDateString()],
        false,
    ],
]);

it('runs validation to check received date is after than or equal to indicated date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->afterOrEqual(Dates::now()->toDateString())->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof AfterOrEqual) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date is after or equal as today' => [
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'invalid date is not after or equal as today' => [
        ['date' => Dates::now()->subDay()->toDateString()],
        false,
    ],
]);

it('runs validation to check received date is less than indicated date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->before(Dates::now()->toDateString())->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof Before) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date is before as today' => [
        ['date' => Dates::now()->subDay()->toDateString()],
        true,
    ],
    'invalid date is not before as today' => [
        ['date' => Dates::now()->toDateString()],
        false,
    ],
]);

it('runs validation to check received date is before than or equal to indicated date', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->beforeOrEqual(Dates::now()->toDateString())->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof BeforeOrEqual) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid date is before or equal as today' => [
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'invalid date is not before or equal as today' => [
        ['date' => Dates::now()->addDay()->toDateString()],
        false,
    ],
]);

it('runs validation to check received date with format', function (
    array $data,
    bool $expected
) {
    $rules = Date::required()->format('Y-m-d')->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule instanceof Format) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'valid format date' => [
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'invalid date is not before or equal as today' => [
        ['date' => Dates::now()->toDateTimeString()],
        false,
    ],
]);

it('runs dates validation using shortcut methods', function (
    string $method,
    string $ruleClass,
    array $data,
    bool $expected
) {
    $rules = Date::required()->{$method}()->toArray();

    foreach ($rules['type'] as $rule) {
        $rule->setField('date');
        $rule->setData($data);

        if ($rule::class === $ruleClass) {
            expect($rule->passes())->toBe($expected);
        } else {
            expect($rule->passes())->toBeTruthy();
        }
    }
})->with([
    'date is equal today' => [
        'equalToday',
        Equal::class,
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'date is not equal today' => [
        'equalToday',
        Equal::class,
        ['date' => Dates::now()->addDay()->toDateString()],
        false,
    ],
    'date is after today' => [
        'afterToday',
        After::class,
        ['date' => Dates::now()->addDay()->toDateString()],
        true,
    ],
    'date is not after today' => [
        'afterToday',
        After::class,
        ['date' => Dates::now()->toDateString()],
        false,
    ],
    'date is before today' => [
        'beforeToday',
        Before::class,
        ['date' => Dates::now()->subDay()->toDateString()],
        true,
    ],
    'date is not before today' => [
        'beforeToday',
        Before::class,
        ['date' => Dates::now()->toDateString()],
        false,
    ],
    'date is after or equal today' => [
        'afterOrEqualToday',
        AfterOrEqual::class,
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'date is not after or equal today' => [
        'afterOrEqualToday',
        AfterOrEqual::class,
        ['date' => Dates::now()->subDay()->toDateString()],
        false,
    ],
    'date is before or equal today' => [
        'beforeOrEqualToday',
        BeforeOrEqual::class,
        ['date' => Dates::now()->toDateString()],
        true,
    ],
    'date is not before or equal today' => [
        'beforeOrEqualToday',
        BeforeOrEqual::class,
        ['date' => Dates::now()->addDay()->toDateString()],
        false,
    ],
]);

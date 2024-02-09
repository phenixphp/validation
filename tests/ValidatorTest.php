<?php

declare(strict_types=1);

use Phenix\Validation\Exceptions\InvalidCollectionDefinition;
use Phenix\Validation\Exceptions\InvalidDictionaryDefinition;
use Phenix\Validation\Types\ArrList;
use Phenix\Validation\Types\Collection;
use Phenix\Validation\Types\Dictionary;
use Phenix\Validation\Types\Str;
use Phenix\Validation\Validator;

it('runs data scalar validation successfully', function () {
    $validator = new Validator();

    $validator->setRules([
        'name' => Str::required(),
    ]);
    $validator->setData([
        'name' => 'John',
        'last_name' => 'Doe',
    ]);

    expect($validator->passes())->toBeTrue();
    expect($validator->validated())->toBe([
        'name' => 'John',
    ]);
});

it('runs data validation successfully with data dictionary', function () {
    $validator = new Validator();

    $validator->setRules([
        'customer' => Dictionary::required()->min(2)->define([
            'name' => Str::required()->min(3),
            'last_name' => Str::required()->min(3),
        ]),
    ]);

    $validator->setData([
        'customer' => [
            'name' => 'John',
            'last_name' => 'Doe',
            'address' => 'Spring street',
        ],
    ]);

    expect($validator->passes())->toBeTrue();
    expect($validator->validated())->toBe([
        'customer' => [
            'name' => 'John',
            'last_name' => 'Doe',
        ],
    ]);
});

it('throws error on an invalid dictionary definition', function (array $definition) {
    $validator = new Validator();

    $validator->setRules([
        'customer' => Dictionary::required()->min(2)->define($definition),
    ]);
})
->throws(InvalidDictionaryDefinition::class)
->with([
    'list' => [['value']],
    'dictionary without rules' => [['key' => 'value']],
    'dictionary without scalar type' => [['key' => ArrList::required()]],
]);

it('runs data validation successfully with data collection', function () {
    $validator = new Validator();

    $validator->setRules([
        'customer' => Collection::required()->min(2)->define([
            'name' => Str::required()->min(3),
        ]),
    ]);

    $validator->setData([
        'customer' => [
            [
                'name' => 'John',
                'last_name' => 'Doe',
            ],
            [
                'name' => 'Bob',
                'last_name' => 'Ross',
            ],
        ],
    ]);

    expect($validator->passes())->toBeTrue();
    expect($validator->validated())->toBe([
        'customer' => [
            [
                'name' => 'John',
            ],
            [
                'name' => 'Bob',
            ],
        ],
    ]);
});

it('throws error on an invalid collection definition', function (array $definition) {
    $validator = new Validator();

    $validator->setRules([
        'customer' => Collection::required()->min(2)->define($definition),
    ]);
})
->throws(InvalidCollectionDefinition::class)
->with([
    'list' => [['value']],
    'dictionary without rules' => [['key' => 'value']],
]);

it('runs data validation successfully with data list', function () {
    $validator = new Validator();

    $validator->setRules([
        'weekdays' => ArrList::required()->define(Str::required()),
    ]);

    $validator->setData([
        'weekdays' => ['monday', 'sunday'],
        'months' => ['january'],
    ]);

    expect($validator->passes())->toBeTrue();
    expect($validator->validated())->toBe([
        'weekdays' => ['monday', 'sunday'],
    ]);
});

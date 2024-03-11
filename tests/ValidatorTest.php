<?php

declare(strict_types=1);

use Phenix\Validation\Exceptions\InvalidCollectionDefinition;
use Phenix\Validation\Exceptions\InvalidDictionaryDefinition;
use Phenix\Validation\Rules\IsDictionary;
use Phenix\Validation\Rules\IsString;
use Phenix\Validation\Rules\Required;
use Phenix\Validation\Types\ArrList;
use Phenix\Validation\Types\Collection;
use Phenix\Validation\Types\Dictionary;
use Phenix\Validation\Types\Str;
use Phenix\Validation\Validator;

it('runs successfully validation with scalar data', function () {
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

it('runs failed validation with scalar data', function () {
    $validator = new Validator();

    $validator->setRules([
        'name' => Str::required(),
    ]);
    $validator->setData([
        'last_name' => 'Doe',
    ]);

    expect($validator->passes())->toBeFalse();
    expect($validator->validated())->toBe([
        'name' => null,
    ]);

    expect($validator->failing())->toBe([
        'name' => [Required::class],
    ]);

    expect($validator->invalid())->toBe([
        'name' => null,
    ]);
});

it('runs data successfully validation with data dictionary', function () {
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

it('runs data failed validation with data dictionary', function () {
    $validator = new Validator();

    $validator->setRules([
        'customer' => Dictionary::required()->min(2)->define([
            'name' => Str::required()->min(3),
            'email' => Str::required()->min(12),
        ]),
    ]);

    $validator->setData([
        'customer' => [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => ['john.doe@mail.com'],
        ],
    ]);

    expect($validator->passes())->toBeFalsy();

    expect($validator->validated())->toBe([
        'customer' => [
            'name' => 'John',
            'email' => ['john.doe@mail.com'],
        ],
    ]);

    expect($validator->failing())->toBe([
        'customer' => [IsDictionary::class],
        'customer.email' => [IsString::class],
    ]);

    expect($validator->invalid())->toBe([
        'customer' => [
            'email' => ['john.doe@mail.com'],
        ],
    ]);
});

it('runs data successfully validation with data collection', function () {
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

it('runs data successfully validation with data list', function () {
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

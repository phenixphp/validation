<?php

declare(strict_types=1);

use Phenix\Validation\Rules\IsString;
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
    ]);

    expect($validator->passes())->toBeTrue();
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
        ],
    ]);

    expect($validator->passes())->toBeTrue();
});

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
            ],
            [
                'name' => 'Bob',
            ],
        ],
    ]);

    expect($validator->passes())->toBeTrue();
});

it('runs data validation successfully with data list', function () {
    $validator = new Validator();

    $validator->setRules([
        'weekdays' => ArrList::required()->define(IsString::new()),
    ]);

    $validator->setData([
        'weekdays' => ['monday', 'sunday'],
    ]);

    expect($validator->passes())->toBeTrue();
});

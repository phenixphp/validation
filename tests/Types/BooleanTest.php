<?php

declare(strict_types=1);

use Phenix\Validation\Types\Boolean;


it('runs data successfully validation with required data', function (array $data, bool $expected) {
    $type = Boolean::required();

    ['type' => $typeRules,] = $type->toArray();

    foreach($typeRules as $rule) {
        $rule->setField('accepted');
        $rule->setData($data);

        expect($rule->passes())->toBe($expected);
    }
})->with([
    'accepted field' => [['accepted' => true], true],
    'no accepted field' => [['accepted' => false], true],
    'accepted field with number' => [['accepted' => 1], true],
    'no accepted field with number' => [['accepted' => 0], true],
    'accepted field with numeric value' => [['accepted' => '1'], true],
    'no accepted field with numeric value' => [['accepted' => '0'], true],
]);

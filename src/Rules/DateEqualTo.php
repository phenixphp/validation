<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Util\Date;

class DateEqualTo extends Rule
{
    public function __construct(
        protected string $relatedField
    ) {
    }

    public function passes(): bool
    {
        $date = Date::parse($this->getValue());
        $relatedDate = Date::parse($this->getRelatedValue());

        return $date->equalTo($relatedDate);
    }

    protected function getRelatedValue(): string
    {
        return $this->data->get($this->relatedField);
    }
}

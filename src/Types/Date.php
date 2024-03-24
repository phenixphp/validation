<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use DateTimeInterface;
use Phenix\Validation\Rules\After;
use Phenix\Validation\Rules\AfterOrEqual;
use Phenix\Validation\Rules\Before;
use Phenix\Validation\Rules\BeforeOrEqual;
use Phenix\Validation\Rules\DateFormat;
use Phenix\Validation\Rules\EqualDates;
use Phenix\Validation\Rules\IsDate;
use Phenix\Validation\Rules\TypeRule;

class Date extends Type
{
    protected function defineType(): TypeRule
    {
        return IsDate::new();
    }

    public function equal(DateTimeInterface|string $date): self
    {
        $this->rules['equal'] = EqualDates::new($date);

        return $this;
    }

    public function after(DateTimeInterface|string $date): self
    {
        $this->rules['after'] = After::new($date);

        return $this;
    }

    public function afterOrEqual(DateTimeInterface|string $date): self
    {
        $this->rules['after_or_equal'] = AfterOrEqual::new($date);

        return $this;
    }

    public function before(DateTimeInterface|string $date): self
    {
        $this->rules['before'] = Before::new($date);

        return $this;
    }

    public function beforeOrEqual(DateTimeInterface|string $date): self
    {
        $this->rules['before_or_equal'] = BeforeOrEqual::new($date);

        return $this;
    }

    public function format(string $format): self
    {
        $this->rules['date_format'] = DateFormat::new($format);

        return $this;
    }

    public function equalToday(): self
    {
        $this->rules['equal_today'] = EqualDates::new(Dates::today());

        return $this;
    }

    public function afterToday(): self
    {
        $this->rules['after'] = After::new(Dates::today());

        return $this;
    }

    public function beforeToday(): self
    {
        $this->rules['before'] = Before::new(Dates::today());

        return $this;
    }

    public function afterOrEqualToday(): self
    {
        $this->rules['after_or_equal_today'] = AfterOrEqual::new(Dates::today());

        return $this;
    }

    public function beforeOrEqualToday(): self
    {
        $this->rules['before_or_equal_today'] = BeforeOrEqual::new(Dates::today());

        return $this;
    }

    public function equalTo(string $field): self
}

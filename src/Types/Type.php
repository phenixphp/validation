<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\RequirementRule;
use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\Type as TypeContract;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\Nullable;
use Phenix\Validation\Rules\Optional;
use Phenix\Validation\Rules\Required;

abstract class Type implements TypeContract
{
    protected Rule&TypingRule $type;
    protected array $rules;

    public function __construct(
        protected Rule&RequirementRule $requirement,
    ) {
        $this->type = $this->defineType();
        $this->rules = [];
    }

    abstract protected function defineType(): Rule&TypingRule;

    public static function required(): static
    {
        return new static(Required::new());
    }

    public static function optional(): static
    {
        return new static(Optional::new());
    }

    public static function nullable(): static
    {
        return new static(Nullable::new());
    }

    /**
     * @return array{ type: Rule[], definition: mixed[] }
     */
    public function toArray(): array
    {
        return [
            'type' => [
                $this->requirement,
                $this->type,
                ...$this->rules,
            ],
            'definition' => [],
        ];
    }
}

<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\EmailValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Phenix\Validation\Validations\EmailValidation as FilterEmailValidation;

class Email extends Rule
{
    protected array $emailValidations;

    public function __construct(EmailValidation ...$emailValidations)
    {
        $this->emailValidations = $emailValidations ?: [new FilterEmailValidation(), new RFCValidation()];
    }

    public function passes(): bool
    {
        $emailValidator = new EmailValidator();

        return $emailValidator->isValid(
            $this->getValue(),
            new MultipleValidationWithAnd($this->emailValidations)
        );
    }
}

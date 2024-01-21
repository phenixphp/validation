<?php

declare(strict_types=1);

namespace Phenix\Validation\Constants;

enum Types
{
    case String;
    case Number;
    case Integer;
    case UnsignedInteger;
    case Decimal;
    case UnsignedDecimal;
    case Array;
    case Boolean;
    case Null;
}

<?php declare(strict_types=1);

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderEnum extends Enum
{
    public const Male = 1;
    public const Female = 2;

    public static function getArrayView(): array
    {
        return [
            'Male'  => self::Male,
            'Female'  => self::Female,
        ];
    }
}

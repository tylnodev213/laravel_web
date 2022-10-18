<?php declare(strict_types=1);

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeOfWorkEnum extends Enum
{
    public const Fulltime = 1;
    public const Partime = 2;
    public const Probationary_Staff = 3;
    public const Intern = 4;

    public static function getArrayView(): array
    {
        return [
            'Fulltime'  => self::Fulltime,
            'Partime'  => self::Partime,
            'Probationary Staff'  => self::Probationary_Staff,
            'Intern'  => self::Intern,
        ];
    }

}

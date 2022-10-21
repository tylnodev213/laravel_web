<?php declare(strict_types=1);

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PositionEnum extends Enum
{
    public const Manager = 1;
    public const Team_Leader = 2;
    public const BSE = 3;
    public const Dev = 4;
    public const Tester = 5;

    public static function getArrayView(): array
    {
        return [
            'Manager'  => self::Manager,
            'Team Leader'  => self::Team_Leader,
            'BSE'  => self::BSE,
            'Dev'  => self::Dev,
            'Tester'  => self::Tester,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}

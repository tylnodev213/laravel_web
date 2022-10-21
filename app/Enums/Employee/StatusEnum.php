<?php declare(strict_types=1);

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusEnum extends Enum
{
    public const On_Working = 1;
    public const Retired = 2;

    public static function getArrayView(): array
    {
        return [
            'On Working'  => self::On_Working,
            'Retired'  => self::Retired,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }


}

<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 30/06/2017
 * Time: 10:17
 */

namespace AppBundle\Enum;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class EnumType
 * @package AppBundle\Enum
 */
class EnumType extends Type
{
    protected static $name = '';

    protected static $values = [];

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(50)';
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return static::$name;
    }

    public static function getValues()
    {
        return static::$values;
    }

    public static function getFormValues()
    {
        $data = [];
        foreach (self::getValues() as $value) {
            $data[$value] = $value;
        }

        return $data;
    }
}
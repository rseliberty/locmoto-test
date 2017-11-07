<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 30/06/2017
 * Time: 10:27
 */

namespace AppBundle\Enum;

/**
 * Class LicenceType
 * @package AppBundle\Enum
 */
class LicenceType extends EnumType
{
    protected static $name = 'enumlicencetype';

    const A = 'PermisA' ;
    const B = 'PermisA1' ;
    const C = 'PermisB' ;

    protected static $values = [
        self::A,
        self::B,
        self::C
    ];
}
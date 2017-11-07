<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 30/06/2017
 * Time: 10:27
 */

namespace AppBundle\Enum;

/**
 * Class DurationType
 * @package AppBundle\Enum
 */
class DurationType extends EnumType
{
    protected static $name = 'enumdurationtype';

    const A = 'Journee' ;
    const B = 'Weekend' ;
    const C = '3jours' ;
    const D = '5jours' ;
    const E = '7jours' ;

    protected static $values = [
        self::A,
        self::B,
        self::C,
        self::D,
        self::E
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 06/09/2017
 * Time: 18:25
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\RentMoto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RentMotoTest extends WebTestCase
{
    /**
     * @test
     */
    public function itShouldReturnDefaultDuration()
    {
        $rentMoto = new RentMoto();

        $this->assertEquals(1, $rentMoto->getDuration());
    }

    /**
     * @test
     */
    public function itShouldNotReturnDefaultDuration()
    {
        $rentMoto = new RentMoto();

        $this->assertNotEquals(4, $rentMoto->getDuration());
    }


    /**
     * @test
     */
    public function itShouldNotReturnDefaultterminated()
    {
        $rentMoto = new RentMoto();

        $this->assertNotEquals(true, $rentMoto->getDate());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 30/06/2017
 * Time: 14:39
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

//pr l'upload
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    //ajout des propriétés et fonctions personnelles

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $birthdate;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var int
     */
    protected $zipcode;

    /**
     * @var integer
     */
    protected $city;

    /**
     * @var integer
     */
    protected $phone;

    /**
     * @var string
     */
    protected $license;


    /**
     * @ORM\Column(type="string")
     */

    private $justificatory;

    /**
     * @ORM\Column(type="boolean")
     */

    private $cnil;

    /**
     * @return mixed
     */
    public function getCnil()
    {
        return $this->cnil;
    }

    /**
     * @param mixed $cnil
     */
    public function setCnil($cnil)
    {
        $this->cnil = $cnil;
    }
    /**
     * @var ArrayCollection
     */
    protected $rents;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = ['ROLE_USER'];
        $this->rents = new ArrayCollection();
    }


    public function getJustificatory()
    {
        return $this->justificatory;
    }

    public function setJustificatory($justificatory)
    {
        $this->justificatory = $justificatory;

        return $this;
    }


    /**
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param string $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param int $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param string $license
     * @return User
     */
    public function setLicense($license)
    {
        $this->license = $license;
        return $this;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @param mixed $rents
     * return User
     */
    public function setRents($rents)
    {
        $this->rents = $rents;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRents()
    {
        return $this->rents;
    }

    /**
     * @return bool
     */
    public function hasActiveRents()
    {
        return $this->getActiveRents()->count() > 0;
    }

    /**
     * @return ArrayCollection|\Doctrine\Common\Collections\Collection
     */
    public function getActiveRents()
    {
        return $this->rents->filter(function (RentMoto $rent) {
            return $rent->isActived();
        });
    }

    /**
     * @param RentMoto $rentMoto
     * @return $this
     */
    public function addRent(RentMoto $rentMoto)
    {
        $this->rents->add($rentMoto);

        return $this;
    }




}





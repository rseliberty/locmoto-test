<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Vich\Uploadable
 *
 */

class Vehicle
{
    /**
     * @var int
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;

	/**
     * @var string
     */
	protected $model;

    /**
     * @var string
     */
	protected $brand;

    /**
     * @var string
     */
	protected $type;

    /**
     * @var string
     */
	protected $description;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var bool
     */
    protected $available;

    /**
     * @var string
     */
    protected $registration;

    /**
     * @var ArrayCollection
     */
    protected $rents;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @Vich\UploadableField(mapping="vehicle_image", fileNameProperty="logo")
     *
     * @var File $logoFile
     */
    protected $logoFile;

// ...

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @return string
     * pr BO easyadmin concernant l'affichage objet string edit/create
     */
    public function __toString()
    {
        return $this->model;
    }

    /**
     * Vehicle constructor.
     */
    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }


    /**
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

	/**
     * @return string
     */
	public function getModel()
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return $this->available;
    }

    /**
     * @return string
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param mixed $rents
     * @return Vehicle
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
     * @param RentMoto $rentMoto
     * @return $this
     */
    public function addRent(RentMoto $rentMoto)
    {
        $this->rents->add($rentMoto);

        return $this;
    }

    /**
     * @param string $model
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param string $brand
     * * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @param string $type
     * * @return Vehicle
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $description
     * * @return Vehicle
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $comment
     * * @return Vehicle
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @param bool $available
     * * @return Vehicle
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @param string $registration
     * * @return Vehicle
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;
        return $this;

    }


}

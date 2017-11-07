<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Document
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Vich\Uploadable
 *
 */


class Document
{
    /**
     * @var int
     */
    private $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="cgv", type="string", length=255)
     */
    private $cgv;


    /**
     * @var string
     *
     * @ORM\Column(name="mentions", type="string", length=255)
     */
    private $mentions;

    /**
     * @return string
     */
    public function getMentions()
    {
        return $this->mentions;
    }

    /**
     * @param string $mentions
     */
    public function setMentions($mentions)
    {
        $this->mentions = $mentions;
    }


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
    public function getCgv()
    {
        return $this->cgv;
    }

    /**
     * @param mixed $cgv
     */
    public function setCgv($cgv)
    {
        $this->cgv = $cgv;
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
     * @Vich\UploadableField(mapping="documents", fileNameProperty="cgv")
     *
     * @var File $cgvFile
     */
    protected $cgvFile;

    /**
     * @Vich\UploadableField(mapping="documents", fileNameProperty="mentions")
     *
     * @var File $mentionsFile
     */
    protected $mentionsFile;

// ...

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $pdf
     */
    public function setCgvFile(File $pdf = null)
    {
        $this->cgvFile = $pdf;

        if ($pdf) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getCgvFile()
    {
        return $this->cgvFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $pdf1
     */
    public function setmentionsFile(File $pdf1 = null)
    {
        $this->mentionsFile = $pdf1;

        if ($pdf1) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getMentionsFile()
    {
        return $this->mentionsFile;
    }

    /**
     * @return string
     * pr BO easyadmin concernant l'affichage objet string edit/create
     */
    public function __toString()
    {
        return $this->cgv;
    }


}


<?php

namespace AppBundle\Entity;

/**
 * Class rent
 */
class RentMoto
{
    /**
     * @var int
     */
	private $id;

	/**
     * pour récupérer les heures et minutes mettre "datetime"
     * @var date
     */
	protected $date;

    /**
     * @var string
     */
	protected $duration;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Vehicle
     */
    protected $vehicle;

    /**
     * @var bool
     */
    protected $actived = true;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @return string
     * pr BO easyadmin pr affichage objet string edit/create
     */
    public function __toString()
    {
        return $this->getUser()->getLastname();
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param date $date
     * @return RentMoto
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return date
     */
	public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param $vehicle
     * @return $this
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * @param string $duration
     * @return RentMoto
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActived()
    {
        return $this->actived;
    }

    /**
     * @param bool $actived
     * @return $this
     */
    public function setActived($actived)
    {
        $this->actived = $actived;

        return $this;
    }

}
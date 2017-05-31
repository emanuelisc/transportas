<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportRepository")
 */
class Report
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="reports")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reports")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=11)
     */
    private $route;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depart_time", type="time")
     */
    private $departTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrive_time", type="time")
     */
    private $arriveTime;

    /**
     * @var int
     *
     * @ORM\Column(name="depart_km", type="integer")
     */
    private $departKm;

    /**
     * @var int
     *
     * @ORM\Column(name="arrive_km", type="integer")
     */
    private $arriveKm;

    /**
     * @var int
     *
     * @ORM\Column(name="unload_time", type="integer")
     */
    private $unloadTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrive2_time", type="time")
     */
    private $arrive2Time;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depart2_time", type="time")
     */
    private $depart2Time;

    /**
     * @var int
     *
     * @ORM\Column(name="distance", type="integer")
     */
    private $distance;

    /**
     * @var int
     *
     * @ORM\Column(name="fuel", type="integer")
     */
    private $fuel;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Report
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Report
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set departTime
     *
     * @param \DateTime $departTime
     *
     * @return Report
     */
    public function setDepartTime($departTime)
    {
        $this->departTime = $departTime;

        return $this;
    }

    /**
     * Get departTime
     *
     * @return \DateTime
     */
    public function getDepartTime()
    {
        return $this->departTime;
    }

    /**
     * Set arriveTime
     *
     * @param \DateTime $arriveTime
     *
     * @return Report
     */
    public function setArriveTime($arriveTime)
    {
        $this->arriveTime = $arriveTime;

        return $this;
    }

    /**
     * Get arriveTime
     *
     * @return \DateTime
     */
    public function getArriveTime()
    {
        return $this->arriveTime;
    }

    /**
     * Set departKm
     *
     * @param integer $departKm
     *
     * @return Report
     */
    public function setDepartKm($departKm)
    {
        $this->departKm = $departKm;

        return $this;
    }

    /**
     * Get departKm
     *
     * @return int
     */
    public function getDepartKm()
    {
        return $this->departKm;
    }

    /**
     * Set arriveKm
     *
     * @param integer $arriveKm
     *
     * @return Report
     */
    public function setArriveKm($arriveKm)
    {
        $this->arriveKm = $arriveKm;

        return $this;
    }

    /**
     * Get arriveKm
     *
     * @return int
     */
    public function getArriveKm()
    {
        return $this->arriveKm;
    }

    /**
     * Set unloadTime
     *
     * @param integer $unloadTime
     *
     * @return Report
     */
    public function setUnloadTime($unloadTime)
    {
        $this->unloadTime = $unloadTime;

        return $this;
    }

    /**
     * Get unloadTime
     *
     * @return int
     */
    public function getUnloadTime()
    {
        return $this->unloadTime;
    }

    /**
     * Set arrive2Time
     *
     * @param \DateTime $arrive2Time
     *
     * @return Report
     */
    public function setArrive2Time($arrive2Time)
    {
        $this->arrive2Time = $arrive2Time;

        return $this;
    }

    /**
     * Get arrive2Time
     *
     * @return \DateTime
     */
    public function getArrive2Time()
    {
        return $this->arrive2Time;
    }

    /**
     * Set depart2Time
     *
     * @param \DateTime $depart2Time
     *
     * @return Report
     */
    public function setDepart2Time($depart2Time)
    {
        $this->depart2Time = $depart2Time;

        return $this;
    }

    /**
     * Get depart2Time
     *
     * @return \DateTime
     */
    public function getDepart2Time()
    {
        return $this->depart2Time;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return Report
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set fuel
     *
     * @param integer $fuel
     *
     * @return Report
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return int
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Get vehicle
     *
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set vehicle
     *
     * @param mixed $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Get user
     *
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}


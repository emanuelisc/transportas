<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehicleRepository")
 */
class Vehicle
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=11)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="stand", type="integer")
     */
    private $stand;

    /**
     * @var int
     *
     * @ORM\Column(name="drive", type="integer")
     */
    private $drive;

    /**
     * @var int
     *
     * @ORM\Column(name="unload", type="integer")
     */
    private $unload;

    /**
     * @ORM\OneToMany(targetEntity="Report", mappedBy="vehicle", cascade={"remove"})
     */
    private $reports;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Vehicle
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set stand
     *
     * @param integer $stand
     *
     * @return Vehicle
     */
    public function setStand($stand)
    {
        $this->stand = $stand;

        return $this;
    }

    /**
     * Get stand
     *
     * @return int
     */
    public function getStand()
    {
        return $this->stand;
    }

    /**
     * Set drive
     *
     * @param integer $drive
     *
     * @return Vehicle
     */
    public function setDrive($drive)
    {
        $this->drive = $drive;

        return $this;
    }

    /**
     * Get drive
     *
     * @return int
     */
    public function getDrive()
    {
        return $this->drive;
    }

    /**
     * Set unload
     *
     * @param integer $unload
     *
     * @return Vehicle
     */
    public function setUnload($unload)
    {
        $this->unload = $unload;

        return $this;
    }

    /**
     * Get unload
     *
     * @return int
     */
    public function getUnload()
    {
        return $this->unload;
    }

    /**
     * Get reports
     *
     * @return mixed
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * Set reports
     *
     * @param mixed $reports
     */
    public function setReports($reports)
    {
        $this->reports = $reports;
    }
}


<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("booking")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("userlight")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car")
     * @Groups("car")
     */
    private $car;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("booking")
     */
    private $startBooking;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("booking")
     */
    private $endBooking;

    /**
     * @ORM\Column(type="float")
     * @Groups("booking")
     */
    private $totalPriceHT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getStartBooking(): ?Date
    {
        return $this->startBooking;
    }

    public function setStartBooking(Date $startBooking): self
    {
        $this->startBooking = $startBooking;

        return $this;
    }

    public function getEndBooking(): Date
    {
        return $this->endBooking;
    }

    public function setEndBooking(Date $endBooking): self
    {
        $this->endBooking = $endBooking;

        return $this;
    }

    public function getTotalPriceHT(): ?float
    {
        return $this->totalPriceHT;
    }

    public function setTotalPriceHT(float $totalPriceHT): self
    {
        $this->totalPriceHT = $totalPriceHT;

        return $this;
    }
}
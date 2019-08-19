<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @ORM\Column(type="float")
     */
    private $priceBooking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startBooking;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endBooking;

    /**
     * @ORM\Column(type="float")
     */
    private $totalPriceHT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceBooking(): ?float
    {
        return $this->priceBooking;
    }

    public function setPriceBooking(float $priceBooking): self
    {
        $this->priceBooking = $priceBooking;

        return $this;
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

    public function getStartBooking(): ?\DateTimeInterface
    {
        return $this->startBooking;
    }

    public function setStartBooking(\DateTimeInterface $startBooking): self
    {
        $this->startBooking = $startBooking;

        return $this;
    }

    public function getEndBooking(): ?\DateTimeInterface
    {
        return $this->endBooking;
    }

    public function setEndBooking(?\DateTimeInterface $endBooking): self
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
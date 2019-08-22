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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("userlight")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("car")
     */
    private $car;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("booking")
     */
    private $startBooking;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("booking")
     */
    private $endBooking;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("booking")
     */
    private $totalPriceHT;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CheckOut", mappedBy="booking", cascade={"persist", "remove"})
     */
    private $checkOut;

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

    public function getStartBooking(): ?string
    {
        return $this->startBooking;
    }

    public function setStartBooking(string $startBooking): self
    {
        $this->startBooking = $startBooking;

        return $this;
    }

    public function getEndBooking(): string
    {
        return $this->endBooking;
    }

    public function setEndBooking(string $endBooking): self
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

    public function getCheckOut(): ?CheckOut
    {
        return $this->checkOut;
    }

    public function setCheckOut(CheckOut $checkOut): self
    {
        $this->checkOut = $checkOut;

        // set the owning side of the relation if necessary
        if ($this !== $checkOut->getBooking()) {
            $checkOut->setBooking($this);
        }

        return $this;
    }
}
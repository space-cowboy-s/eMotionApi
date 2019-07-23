<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("car")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("car")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("car")
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("car")
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("car")
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("car")
     */
    private $numberplate;

    /**
     * @ORM\Column(type="float")
     * @Groups("car")
     */
    private $numberKilometers;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("car")
     */
    private $purchaseDate;

    /**
     * @ORM\Column(type="float")
     * @Groups("car")
     */
    private $buyingPrice;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Booking", mappedBy="car", cascade={"persist", "remove"})
     * @Groups("car")
     */
    private $booking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getNumberplate(): ?string
    {
        return $this->numberplate;
    }

    public function setNumberplate(string $numberplate): self
    {
        $this->numberplate = $numberplate;

        return $this;
    }

    public function getNumberKilometers(): ?float
    {
        return $this->numberKilometers;
    }

    public function setNumberKilometers(float $numberKilometers): self
    {
        $this->numberKilometers = $numberKilometers;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getBuyingPrice(): ?float
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(float $buyingPrice): self
    {
        $this->buyingPrice = $buyingPrice;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking): self
    {
        $this->booking = $booking;

        // set the owning side of the relation if necessary
        if ($this !== $booking->getCar()) {
            $booking->setCar($this);
        }

        return $this;
    }
}

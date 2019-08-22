<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CheckOutRepository")
 */
class CheckOut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("checkout")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     * @Groups("checkout")
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="string")
     * @Groups("checkout")
     */
    private $paymentDate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("checkout")
     */
    private $paymentValidator;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Booking", inversedBy="checkOut", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function setTotalPrice($totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getPaymentDate(): ?string
    {
        $date = date('d/m/Y', strtotime($this->paymentDate));
        return $date;
    }

    public function setPaymentDate(string $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getPaymentValidator(): ?bool
    {
        return $this->paymentValidator;
    }

    public function setPaymentValidator(bool $paymentValidator): self
    {
        $this->paymentValidator = $paymentValidator;

        return $this;
    }


    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;

        return $this;
    }
}

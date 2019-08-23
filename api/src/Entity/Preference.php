<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreferenceRepository")
 */
class Preference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("preference")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("preference")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("preference")
     */
    private $car;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("preference")
     */
    private $numberOfViews;

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

    public function getNumberOfViews(): ?int
    {
        return $this->numberOfViews;
    }

    public function setNumberOfViews(int $numberOfViews): self
    {
        $this->numberOfViews = $numberOfViews;

        return $this;
    }
}

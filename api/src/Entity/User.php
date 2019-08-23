<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->apiKey = mt_rand(1000, 100000);
        $this->bookings = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("user")
     * @Groups("apiUser")
     */
    private $id;

    /**
     * @ORM\Column(type="simple_array")
     * @Groups("user")
     * @Assert\NotBlank
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank
     * @Groups("apiUser")
     */
    private $apiKey;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Groups("user")
     * @Groups("userlight")
     */
    private $driverLicence;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="user", orphanRemoval=true)
     * @Groups("user")
     */
    private $bookings;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $password;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDriverLicence(): ?string
    {
        return $this->driverLicence;
    }

    public function setDriverLicence(string $driverLicence): self
    {
        $this->driverLicence = $driverLicence;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setUser($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getUser() === $this) {
                $booking->setUser(null);
            }
        }

        return $this;
    }

}

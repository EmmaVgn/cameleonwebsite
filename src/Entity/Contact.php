<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "validators.This value should not be blank")]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "validators.This value should not be blank (last_name)")]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: "validators.This value is not a valid email address")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex('/^0[1-9]([ .-]?[0-9]{2}){4}$/', message:"validators.phone_invalid")]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 10,
        minMessage: "validators.This value is too short. It should have {{ limit }} characters or more"
    )]
    private ?string $content = null;

    #[ORM\Column (options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $sendAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $siretNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $requestSubject = null;

    public function __construct()
    {
        $this->sendAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSendAt(): ?\DateTimeImmutable
    {
        return $this->sendAt;
    }

    public function setSendAt(\DateTimeImmutable $sendAt): static
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siretNumber;
    }

    public function setSiretNumber(string $siretNumber): static
    {
        $this->siretNumber = $siretNumber;

        return $this;
    }

    public function getRequestSubject(): ?string
    {
        return $this->requestSubject;
    }

    public function setRequestSubject(string $requestSubject): static
    {
        $this->requestSubject = $requestSubject;

        return $this;
    }
}

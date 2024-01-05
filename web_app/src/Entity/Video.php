<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video extends File
{


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    // #[Assert\Email(message:'not valid email')]
    #[Assert\Length(min:2, max:10, minMessage:'Video ttitle must be at least {{limit}} characters long', exactMessage:'More characters')]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?User $user_t = null;

    #[ORM\Column(length: 255)]
    private ?string $format = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?SecurityUser $securityUser = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUserT(): ?User
    {
        return $this->user_t;
    }

    public function setUserT(?User $user_t): static
    {
        $this->user_t = $user_t;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSecurityUser(): ?SecurityUser
    {
        return $this->securityUser;
    }

    public function setSecurityUser(?SecurityUser $securityUser): static
    {
        $this->securityUser = $securityUser;

        return $this;
    }
}

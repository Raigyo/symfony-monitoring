<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WebsiteRepository::class)
 */
class Website
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    message = "L\'url '{{ value }}' n'est pas valide",
     * )
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
       * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit avoir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Status::class, mappedBy="website")
     */
    private $statuses;

    public function __construct()
    {
        $this->statuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(Status $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses[] = $status;
            $status->setWebsite($this);
        }

        return $this;
    }

    public function removeStatus(Status $status): self
    {
        if ($this->statuses->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getWebsite() === $this) {
                $status->setWebsite(null);
            }
        }

        return $this;
    }
}

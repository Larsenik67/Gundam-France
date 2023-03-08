<?php

namespace App\Entity;

use App\Entity\Gundam;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Gundam::class, mappedBy="category")
     */
    private $gundams;

    public function __construct()
    {
        $this->gundams = new ArrayCollection();
    }

    /**
     * @return Collection<int, Gundam>
     */
    public function getGundams(): Collection
    {
        return $this->gundams;
    }

    public function addGundam(Gundam $gundam): self
    {
        if (!$this->gundams->contains($gundam)) {
            $this->gundams[] = $gundam;
            $gundam->setCategory($this);
        }

        return $this;
    }

    public function removeGundam(Gundam $gundam): self
    {
        if ($this->gundams->removeElement($gundam)) {
            // set the owning side to null (unless already changed)
            if ($gundam->getCategory() === $this) {
                $gundam->setCategory(null);
            }
        }

        return $this;
    }

    
}

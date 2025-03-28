<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'tags')]
    private Collection $articles;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\OneToMany(targetEntity: TagTranslation::class, mappedBy: "tag", cascade: ["persist", "remove"])]
    private Collection $translations;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->updateAt = new \DateTimeImmutable();
        $this->translations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addTag($this); // Synchronisation bidirectionnelle
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            $article->removeTag($this); // Synchronisation bidirectionnelle
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getTranslations(): Collection
    {
    return $this->translations;
    }

    public function addTranslation(TagTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
            $translation->setTag($this);
        }

        return $this;
    }

    public function removeTranslation(TagTranslation $translation): self
    {
        if ($this->translations->removeElement($translation)) {
            if ($translation->getTag() === $this) {
                $translation->setTag(null);
            }
        }

        return $this;
    }

    public function getTranslation(string $locale): ?TagTranslation
    {
        foreach ($this->translations as $translation) {
            if ($translation->getLocale() === $locale) {
                return $translation;
            }
        }
        return null;
    }

    public function getTranslatedName(string $locale): ?string
{
    foreach ($this->translations as $translation) {
        if ($translation->getLocale() === $locale) {
            return $translation->getName();
        }
    }
    return $this->name;
}

}

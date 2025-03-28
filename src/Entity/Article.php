<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
class Article
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $subtitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[Vich\UploadableField(mapping: 'blog', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column( options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt = null ;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'articles')]
    private Collection $tags;

    #[ORM\OneToMany(targetEntity: ArticleTranslation::class, mappedBy: "article", cascade: ["persist", "remove"])]
    private Collection $translations;

    #[ORM\Column(nullable: true)]
    private ?int $views = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->tags = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Unnamed Article';
    }
    
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): static
    {
        $this->subtitle = $subtitle;
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

       /**
         *
    *If manually uploading a file (i.e. not using Symfony Form) ensure an instance
    *of 'UploadedFile' is injected into this setter to trigger the update. If this
    *bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
    *must be able to accept an instance of 'File' as the bundle will inject one here
    *during Doctrine hydration.
    *
    *@param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
    */
    public function setImageFile(?File $imageFile = null): void{$this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFormattedCreatedAt(): ?string
    {
        return $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : 'Not Set';
    }
    
    
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addArticle($this); // Synchronisation bidirectionnelle
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeArticle($this); // Synchronisation bidirectionnelle
        }

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): static
    {
        $this->views = $views;

        return $this;
    }

        public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(ArticleTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
            $translation->setArticle($this);
        }

        return $this;
    }

    public function removeTranslation(ArticleTranslation $translation): self
    {
        if ($this->translations->removeElement($translation)) {
            if ($translation->getArticle() === $this) {
                $translation->setArticle(null);
            }
        }

        return $this;
    }

    public function getTranslation(string $locale): ?ArticleTranslation
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
    return $this->name; // Retourne le nom par défaut si pas de traduction
}

public function getTranslatedSubtitle(string $locale): ?string
{
    foreach ($this->translations as $translation) {
        if ($translation->getLocale() === $locale) {
            return $translation->getSubtitle();
        }
    }
    return $this->subtitle;
}

public function getTranslatedContent(string $locale): ?string
{
    foreach ($this->translations as $translation) {
        if ($translation->getLocale() === $locale) {
            return $translation->getContent();
        }
    }
    return $this->content;
}

}
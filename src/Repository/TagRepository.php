<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class); // Assurez-vous que Tag::class est bien utilisé ici
    }

    private function generateRandomColor(): string
    {
        $characters = '0123456789ABCDEF';
        $color = '#';
        for ($i = 0; $i < 6; $i++) {
            $color .= $characters[rand(0, 15)];
        }
        return $color;
    }

    public function findAllWithColors(): array
    {
        $tags = $this->findAll();
        foreach ($tags as $tag) {
            // Assigner une couleur aléatoire à chaque tag
            $tag->setColor($this->generateRandomColor());
        }
        return $tags;
    }

    public function findAllWithTranslations(string $locale)
{
    return $this->createQueryBuilder('t')
        ->leftJoin('t.translations', 'tr', 'WITH', 'tr.locale = :locale')
        ->addSelect('tr')
        ->setParameter('locale', $locale)
        ->orderBy('t.name', 'ASC')
        ->getQuery()
        ->getResult();
}

public function findOneBySlugWithTranslation(string $slug, string $locale): ?Tag
{
    return $this->createQueryBuilder('t')
        ->leftJoin('t.translations', 'tr', 'WITH', 'tr.locale = :locale')
        ->addSelect('tr')
        ->where('t.slug = :slug')
        ->setParameter('slug', $slug)
        ->setParameter('locale', $locale)
        ->getQuery()
        ->getOneOrNullResult();
}

}
//    /**
//     * @return Tag[] Returns an array of Tag objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tag
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

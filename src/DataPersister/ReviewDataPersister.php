<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Controller\SchtroumpfTranslator;
use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;

final class ReviewDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {

        return $data instanceof Review;
    }

    public function persist($data, array $context = [])
    {
        //dd($data);
        $data->setContent(SchtroumpfTranslator::translateToSchtroumpf($data->getContent()));
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        // call your persistence layer to save $data

    }

    public function remove($data, array $context = [])
    {
        dd("onéici");
        // call your persistence layer to delete $data
    }
}
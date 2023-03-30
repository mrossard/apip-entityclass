<?php

namespace App\State;

use ApiPlatform\Exception\ItemNotFoundException;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\DetachedResource;
use App\Entity\DetachedEntity;

class DetachedEntityProvider implements ProviderInterface
{
    public function __construct(
        private readonly ProviderInterface      $itemProvider,
        private readonly ProviderInterface      $collectionProvider
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $data = $this->collectionProvider->provide(
                $operation->withClass($operation->getStateOptions()->getEntityClass()),
                $uriVariables,
                $context);

            $processed = [];

            foreach ($data as $item) {
                $processed[] = $this->transform($item);
            }
            return $processed;
        }

        $data = $this->itemProvider->provide(
            $operation->withClass($operation->getStateOptions()->getEntityClass()),
            $uriVariables,
            $context
        );

        if (null === $data) {
            throw new ItemNotFoundException();
        }

        return $this->transform($data);
    }

    private function transform(DetachedEntity $data) : DetachedResource
    {
        $res = new DetachedResource();
        $res->id = $data->getId();
        $res->name = $data->getName();
        return $res;
    }
}
<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\DetachedEntity;
use App\State\DetachedEntityProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate : '/detached/{id}',
        ),
        new GetCollection(
            uriTemplate : '/detached',
        )
    ],
    provider: DetachedEntityProvider::class,
    stateOptions          : new Options(entityClass: DetachedEntity::class)
)]
class DetachedResource
{
    #[ApiProperty(identifier: true)]
    public ?int $id;
    public string $name;

}
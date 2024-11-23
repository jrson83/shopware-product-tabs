<?php

declare(strict_types=1);

namespace ProductTab\Subscriber;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Content\Product\ProductEvents;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;

// https://stackoverflow.com/questions/76416451/adding-a-filter-to-criteria-weird-result

class TabSubscriber implements EventSubscriberInterface
{
    private EntityRepository $productTabRepository;

    public function __construct(EntityRepository $productTabRepository)
    {
        $this->productTabRepository = $productTabRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ProductEvents::PRODUCT_LOADED_EVENT => 'onProductsLoaded'
        ];
    }

    public function onProductsLoaded(EntityLoadedEvent $event): void
    {
        $context = $event->getContext();

        /** @var ProductEntity $productEntity */
        foreach ($event->getEntities() as $productEntity) {
            $criteria = new Criteria();
            $criteria->addFilter(new EqualsFilter('productId', $productEntity->getId()));
            $criteria->addAssociation('tab');
            $tabSearchResult = $this->productTabRepository->search($criteria, $context);
            $productEntity->addExtension('productTabs', $tabSearchResult->getEntities());

        }
    }
}

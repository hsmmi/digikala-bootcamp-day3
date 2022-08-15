<?php

namespace App\Services;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Requests\ProductRequest;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductService
{
    // __constructor
    public function __construct(
        private ProductRepository $repository, 
        private MessageBusInterface $bus,)
    {
    }

    public function new(ProductRequest $validatedRequest, ProductService $productService)
    {
        $product = new Product();
        $product->setTitle($validatedRequest->title);
        $product->setStock($validatedRequest->stock);

        $this->repository->add($product, true);

        $this->bus->dispatch(new NewProduct($product->getId()));

        return $this->json($product);
    }

}
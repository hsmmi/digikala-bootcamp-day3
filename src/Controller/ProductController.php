<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Requests\ProductRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('', name: 'app_product_new', methods: ['POST'])]
    #[ParamConverter('validatedRequest', class: ProductRequest::class)]
    public function new(
        Request $request,
        ProductRepository $repository,
        ProductRequest $validatedRequest,
        MessageBusInterface $bus,)
    {
        // throw new \Exception('test listeners');

       $product = new Product();
       $product->setTitle($validatedRequest->title);
       $product->setStock($validatedRequest->stock);

       $repository->add($product, true);

        // NewProduct is an message class
        $bus->dispatch(new NewProduct($product->getId())); 

       return $this->json($product);
    }

    #[Route('', name: 'app_product_index', methods: ['GET'])]
    public function index( ProductRepository $repository)
    {
        $products = $repository->findAll();

        return $this->json($products);
    }
}

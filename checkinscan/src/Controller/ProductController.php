<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ProductController 
{

    private ProductRepository $productRepository;
    private ValidatorInterface $validator;

    public function __constructor(ProductRepository $productRepository,ValidatorInterface $validator)
    {
        $this->productRepository = $productRepository;
        $this->validator = $validator;
    }

    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent());

        $product = new Product();
        $product->setName($data->name);
        $product->setDescription($data->description);
        $product->setPrice($data->price);

        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            return new Response("Product is not valid", Response::HTTP_BAD_REQUEST);
        }

        $this->productRepository->save($product);

        return new Response("Product created successfully", Response::HTTP_OK);
    }

    public function update(Request $request): Response
    {
        $data = json_decode($request->getContent());

        $product = $this->productRepository->find($data->id);
        $product->setName($data->name);
        $product->setDescription($data->description);
        $product->setPrice($data->price);

        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            return new Response("Product is not valid", Response::HTTP_BAD_REQUEST);
        }

        $this->productRepository->save($product);

        return new Response("Product updated successfully", Response::HTTP_OK);
    }

    public function delete(int $id): Response
    {      
        $this->productRepository->delete($id);
        
        return new Response(json_encode(['message' => 'Product deleted successfully']), Response::HTTP_OK);
    }

    public function read(): Response
    {
        $products = $this->productRepository->findAll();

        return new Response(json_encode($products), Response::HTTP_OK);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('produit_' . $i);
            $product->setSlug('slug_' . $i);
            $product->setDescription('description du produit ' . $i);
            $product->setImage('images/image_' . $i . '.jpg');
            $product->setPrice(rand(10, 35));
            $manager->persist($product);
        }
        $manager->flush();
    }
}
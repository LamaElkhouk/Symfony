<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 3; $i++) {
            $category = new Category();
            $category->setName('category_' . $i);
            $category->setSlug('slug_' . $i);
            $this->addReference("ref_category_$i", $category);
            $manager->persist($category);
        }

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('produit_' . $i);
            $product->setSlug('slug_' . $i);
            $product->setDescription('description du produit ' . $i);
            $product->setImage('images/image_' . $i . '.jpg');
            $product->setPrice(rand(10, 35));
            $numero_cat = rand(1, 2);
            $product->setCategory(
                $this->getReference("ref_category_$numero_cat")
            );
            $manager->persist($product);
        }

        $manager->flush();
    }
}
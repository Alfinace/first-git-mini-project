<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produit;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

            for ($j=0; $j <=5; $j++) { 
                    $categorie= new Category();
                    $categorie->setLibelle($faker->name);
        
                $manager->persist($categorie);

                for ($k=0; $k <=30 ; $k++) { 
                    $produit= new Produit();
                    $dateCreatedAt=$faker->dateTimeBetween('-2 months');
                    $dateUpdatedAt=$dateCreatedAt;
                    $produit->setDesignation($faker->word)
                        ->setPrix($faker->numberBetween(7000,3000000))
                        ->setQuantite($faker->numberBetween(20,100))
                        ->setImage('no_image.png')
                        ->setCategory($categorie)
                        ->setDescription($faker->text)
                        ->setCreatedAt($dateCreatedAt)
                        ->setUpdatedAt($dateUpdatedAt);
                    
                $manager->persist($produit);
                }
            }
        $manager->flush();
    }
}

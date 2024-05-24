<?php

namespace App\DataFixtures;

use App\Entity\DodatnaLica;
use Faker\Factory;
use App\Entity\NosiociOsiguranja;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $nosiocOsiguranja = new NosiociOsiguranja();
            $nosiocOsiguranja->setImePrezime($faker->name);
            $nosiocOsiguranja->setDatumRodjenja(new \DateTime($faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d')));
            $nosiocOsiguranja->setBrojPasosa($faker->numerify('##########'));
            $nosiocOsiguranja->setTelefon($faker->phoneNumber);
            $nosiocOsiguranja->setEmail($faker->email);
            $nosiocOsiguranja->setDatumPutovanjaOd(new \DateTime($faker->dateTimeBetween('now', '+1 month')->format('Y-m-d')));
            $nosiocOsiguranja->setDatumPutovanjaDo(new \DateTime($faker->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d')));
            $nosiocOsiguranja->setVrstaPolise($faker->randomElement(['Basic', 'Premium', 'Standard']));
            $nosiocOsiguranja->setDatumKreiranja(new \DateTime());
            // Postavite ostale atribute koristeći metode Faker objekta
            $manager->persist($nosiocOsiguranja);

            $nosiocOsiguranjaId = $nosiocOsiguranja->getId();

            for ($j = 0; $j < 3; $j++) {
                $dodatnaLica = new DodatnaLica();
                $dodatnaLica->setNosilacOsiguranjaId($nosiocOsiguranjaId);
                $dodatnaLica->setImePrezime($faker->name);
                $dodatnaLica->setDatumRodjenja(new \DateTime($faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d')));
                $dodatnaLica->setBrojPasosa($faker->numerify('##########'));
                $manager->persist($dodatnaLica);
            }      
        }
        $manager->flush();
    }
}

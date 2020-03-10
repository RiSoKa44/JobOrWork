<?php

namespace App\DataFixtures;

use App\Entity\Candidat;
use App\Entity\Empresa;
use App\Entity\Oferta;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $emp1 = new Empresa();
        $emp1->setCorreu("em1@giam.cat")
        ->setLogo("logo1.png")
        ->setTipus("tecnològica")
        ->setNom("Empresa 1");
        
        $manager->persist($emp1);

        $of1 = new Oferta();
        $of1->setDataPub(new DateTime())
        ->setDescripcio("desenvolupador web")
        ->setTitol("Busquem Programador Web")
        ->setEmpresa($emp1);
        $manager->persist($of1);

        $cal1 = new Candidat();
        $cal1->setNom("Lola")
        ->setCognoms("Ruiz")
        ->setTelefon("1111")
        ->setEstudis("Programador")
        ->setOferta($of1);
        $manager->persist($cal1);

        $manager->flush();
    }
}

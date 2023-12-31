<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\{Author, Pdf, Video};
;

class InheritanceEntityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 2; $i++) { 
            $author = new Author;
            $author -> setName('Author name -' . $i);
            $manager->persist($author);

            for ($j=1; $j <=3 ; $j++) { 
                # code...
                $pdf = new Pdf;
                $pdf->setFilename('Pdf name of user -' . $i);
                $pdf->setDescription('pdf description of user -' . $i);
                $pdf->setSize(5454);
                $pdf->setOrientation('portrait');
                $pdf->setPagesNumber(123);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($k=1; $k <=3 ; $k++) { 
                # code...
                $video = new Video;
                $video->setFilename('Filename of video - ' . $i);
                $video->setDescription('Description of video -' .$i);
                $video->setSize(321);
                $video->setFormat('mpeg-2');
                $video->setDuration(123);
                $video->setAuthor($author);
                $manager->persist($video);
            }
        }

        $manager->flush();
    }
}

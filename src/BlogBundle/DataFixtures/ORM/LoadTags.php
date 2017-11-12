<?php

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use BlogBundle\Entity\Tag;

/**
* Fixture para la entidad Tag
*/
class LoadTags extends Fixture
{
	public function load(ObjectManager $manager)
	{
		// Insertamos un tag
		$tag = new Tag();

		$tag->setName('php');
		$tag->setDescription('php tag');

		$manager->persist($tag);
		$this->addReference('tag-php', $tag);

		// Insertamos otro tag
		$tag = new Tag();

		$tag->setName('symfony2');
		$tag->setDescription('Framework Symfony 2');

		$manager->persist($tag);
		$this->addReference('tag-symfony2', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('symfony3');
        $tag->setDescription('Framework Symfony 3');

        $manager->persist($tag);
        $this->addReference('tag-symfony3', $tag);

		// Insertamos otro tag
		$tag = new Tag();

		$tag->setName('html');
		$tag->setDescription('Lenguaje de marcado HTML');

		$manager->persist($tag);
		$this->addReference('tag-html', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('html5');
        $tag->setDescription('Nueva generación del lenguaje de marcado HTML');

        $manager->persist($tag);
        $this->addReference('tag-html5', $tag);

		// Insertamos otro tag
		$tag = new Tag();

		$tag->setName('zend framework 2');
		$tag->setDescription('apuntate al curso de zend framework 2');

		$manager->persist($tag);
		$this->addReference('tag-zend', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('css3');
        $tag->setDescription('Diseño web con CSS3');

        $manager->persist($tag);
        $this->addReference('tag-css3', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('less');
        $tag->setDescription('Less para hojas de estilo CSS');

        $manager->persist($tag);
        $this->addReference('tag-less', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('javascript');
        $tag->setDescription('Lenguaje de script JavaScript');

        $manager->persist($tag);
        $this->addReference('tag-javascript', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('ddo');
        $tag->setDescription('Dungeons & Dragons Online');

        $manager->persist($tag);
        $this->addReference('tag-ddo', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('orm');
        $tag->setDescription('Object Relational Mapping');

        $manager->persist($tag);
        $this->addReference('tag-orm', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('doctrine');
        $tag->setDescription('ORM Doctrine');

        $manager->persist($tag);
        $this->addReference('tag-doctrine', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('twig');
        $tag->setDescription('Lenguaje de plantillas Twig');

        $manager->persist($tag);
        $this->addReference('tag-twig', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('codegniter');
        $tag->setDescription('Framework Codegniter');

        $manager->persist($tag);
        $this->addReference('tag-codegniter', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('cms');
        $tag->setDescription('Sistema de gestión de contenidos (Content Management System)');

        $manager->persist($tag);
        $this->addReference('tag-cms', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('wordpress');
        $tag->setDescription('CMS Wordpress');

        $manager->persist($tag);
        $this->addReference('tag-wordpress', $tag);

        // Insertamos otro tag
        $tag = new Tag();

        $tag->setName('prestashop');
        $tag->setDescription('CMS Prestashop');

        $manager->persist($tag);
        $this->addReference('tag-prestashop', $tag);

		$manager->flush();
	}
}

<?php

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use BlogBundle\Entity\Category;

/**
* Fixture para la entidad Category
*/
class LoadCategories extends Fixture
{
	public function load(ObjectManager $manager)
	{
		// Creamos la primera entidad 
		$category = new Category();

		$category->setName('Desarrollo web');
		$category->setDescription('Categoría de desarrollo web');

		$manager->persist($category);
		$this->addReference('cat-web', $category);

		// Creamos otra entidad 
		$category = new Category();

		$category->setName('Android');
		$category->setDescription('Categoría de desarrollo android');

		$manager->persist($category);
		$this->addReference('cat-android', $category);

        // Creamos otra entidad
        $category = new Category();

        $category->setName('JavaScript');
        $category->setDescription('Categoría de desarrollo JavaScript');

        $manager->persist($category);
        $this->addReference('cat-javascript', $category);

        // Creamos otra entidad
        $category = new Category();

        $category->setName('HTML/CSS3');
        $category->setDescription('Categoría de HTML/CSS3');

        $manager->persist($category);
        $this->addReference('cat-html-css3', $category);

        // Creamos otra entidad
        $category = new Category();

        $category->setName('DDO');
        $category->setDescription('Categoría de DDO');

        $manager->persist($category);
        $this->addReference('cat-ddo', $category);

        // Creamos otra entidad
        $category = new Category();

        $category->setName('Symfony 3');
        $category->setDescription('Categoría de Symfony 3');

        $manager->persist($category);
        $this->addReference('cat-symfony3', $category);

        $manager->flush();
	}
}
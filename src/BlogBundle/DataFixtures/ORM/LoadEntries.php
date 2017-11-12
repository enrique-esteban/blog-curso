<?php
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use BlogBundle\Entity\Entry;

/**
* Fixture para la entidad Entry
*/
class LoadEntries extends Fixture
{
	public function load(ObjectManager $manager)
	{
	    $categoriesRef = array( // Array con todas las referencias a las categorías
			'web',
			'android',
			'javascript',
			'html-css3',
			'ddo',
			'symfony3',
		);

	    $usersRef = array( // Array con todas las referencias a las usuarios
	      'victor',
	      'juan',
	      'enrique',
	      'jose',
	      'maria',
        );

        $loremImpumBody = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

        $loremIpsumTitle = array ( // Array Con los títulos de las entradas
            'Lorem ipsum',
            'Dolor sit amet',
            'Consectetur adipiscing elit',
            'Sed do eiusmod',
            'Dempor incididunt',
            'Labore et dolore',
            'Magna aliqua',
            'Ut enim ad minim veniam',
            'Quis nostrud exercitation',
            'Ullamco laboris nisi',
            'Aliquip ex ea',
            'Commodo consequat',
            'Duis aute irure',
            'Dolor in reprehenderit',
            'In voluptate velit',
            'Esse cillum dolore',
            'Fugiat nulla pariatur',
            'Excepteur sint occaecat',
            'Cupidatat non proident',
            'Sunt in culpa qui',
            'Officia deserunt',
            'Mollit anim',
            'Id est laborum',
        );

        $tagsRef = array(
            'php',
            'symfony2',
            'symfony3',
            'html',
            'html5',
            'zend',
            'css3',
            'less',
            'javascript',
            'ddo',
            'orm',
            'doctrine',
            'twig',
            'codegniter',
            'cms',
            'wordpress',
            'prestashop',
        );

        $i = 0; // Número de la referencia
        foreach ($loremIpsumTitle as $title) {
            $entry = new Entry();

            $entry->setUser($this->getReference('user-' . $usersRef[mt_rand(0, 4)]));
            $entry->setCategory($this->getReference('cat-' . $categoriesRef[mt_rand(0, 5)]));
            $entry->setTitle($title);
            $entry->setSlug(strtolower(str_replace(' ', '-', $entry->getTitle())));
            $entry->setContent('<p>' . ucfirst(trim(substr($loremImpumBody,mt_rand(0,344),100))) . '</p>');
            $entry->setStatus('public');
            $entry->setCreateAt(new \DateTime(mt_rand(2000,2016).'/'.mt_rand(1,12).'/'.mt_rand(1,28)));

            // A cada post se le asignará hasta 5 tags aleatorios
            $tagRefKeys = array(); // Keys de las tag que se agregarán

            for ($j = 0; $j < 5; $j++) {
                $newKey = mt_rand(0,16); // Se obtiene una key aleatoria
                $exists = false; // Se entiende que esa key no existe todavía hasta que no se compruebe lo contrario

                foreach ($tagRefKeys as $tagRefKey) { // Se comprueba que no existiera
                    if($tagRefKey == $newKey) {
                        $exists = true; // La key ya existía
                    }
                }

                if (!$exists) { // Si la key no existe se guarda
                    $tagRefKeys[] = $newKey;
                }
            }

            // Se guardan las tags
            foreach ($tagRefKeys as $key) {
                $entry->addTag($this->getReference('tag-'.$tagsRef[$key]));
            }

            $manager->persist($entry);
            $this->addReference('entry-'.$i++, $entry);
        }

		$manager->flush();
	}

	public function getDependencies()
	{
		return array(
		    LoadCategories::class,
            LoadUsers::class,
            LoadTags::class,
        );
	}
}
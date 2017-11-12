<?php

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use BlogBundle\Entity\Comment;

/**
* Fixture para la entidad EntryTag
*/
class LoadComments extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
	{
        $usersRef = array( // Array con todas las referencias a las usuarios
            'victor',
            'juan',
            'enrique',
            'jose',
            'maria',
        );

        $loremImpumBody = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

        for ($i = 1; $i <= 100; $i++) {
        	$comment = new Comment();

        	$comment->setContent(ucfirst(trim(substr($loremImpumBody,mt_rand(0,415),25))));
        	$comment->setCreateAt(new \DateTime('now'));
        	$comment->setUpdateAt(new \DateTime('now'));
        	$comment->setUser($this->getReference('user-'.$usersRef[mt_rand(0,4)]));
        	$comment->setEntry($this->getReference('entry-'.mt_rand(0,22)));

        	$manager->persist($comment);
        }

		$manager->flush();
	}

	public function getDependencies()
    {
        return array(
            LoadUsers::class,
            LoadEntries::class,
        );
    }
}

?> 

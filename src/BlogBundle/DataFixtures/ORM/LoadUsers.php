<?php

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use BlogBundle\Entity\User;

/**
* Fixture para la entidad User
*/
class LoadUsers extends Fixture
{
	public function load(ObjectManager $manager)
	{
        $encoder = $this->container->get('security.password_encoder');

		//Insertamos un usuario:
		$user = new User();

		$user->setUsername('victor');
		$user->setName('Victor');
		$user->setLastName('Robles');
        $user->setEmail('victor@victor.com');
        $user->setRole('admin');
        $encodedPassword = $encoder->encodePassword($user, 'victor');
        dump($encodedPassword);
        $user->setPassword($encodedPassword);
        //$user->setPassword('victor');
        $user->setIsActive('true');
        $user->setImage('default.png');

        $manager->persist($user);
		$this->addReference('user-victor', $user);

		//Insertamos otro usuario:
		$user = new User();

		$user->setUsername('juan');
		$user->setName('Juan');
		$user->setLastName('Lopez');
        $user->setEmail('juan@juan.com');
        $user->setRole('user');
        $encodedPassword = $encoder->encodePassword($user, 'juan');
        $user->setPassword($encodedPassword);
        //$user->setPassword('juan');
        $user->setIsActive('true');
        $user->setImage('default.png');

		$manager->persist($user);
		$this->addReference('user-juan', $user);

        //Insertamos otro usuario:
        $user = new User();

        $user->setUsername('enrique');
        $user->setName('Enrique');
        $user->setLastName('Esteban');
        $user->setEmail('enrique@enrique.com');
        $user->setRole('admin');
        $encodedPassword = $encoder->encodePassword($user, 'enrique');
        $user->setPassword($encodedPassword);
        //$user->setPassword('enrique');
        $user->setIsActive('true');
        $user->setImage('default.png');

        $manager->persist($user);
        $this->addReference('user-enrique', $user);

        //Insertamos otro usuario:
        $user = new User();

        $user->setUsername('jose');
        $user->setName('José');
        $user->setLastName('Esteban');
        $user->setEmail('jose@jose.com');
        $user->setRole('user');
        $encodedPassword = $encoder->encodePassword($user, 'jose');
        $user->setPassword($encodedPassword);
        //$user->setPassword('jose');
        $user->setIsActive('true');
        $user->setImage('default.png');

        $manager->persist($user);
        $this->addReference('user-jose', $user);

        //Insertamos otro usuario:
        $user = new User();

        $user->setUsername('maria');
        $user->setName('Maria');
        $user->setLastName('Plaza');
        $user->setEmail('maria@maria.com');
        $user->setRole('user');
        $encodedPassword = $encoder->encodePassword($user, 'maria');
        $user->setPassword($encodedPassword);
        //$user->setPassword('maria');
        $user->setIsActive('true');
        $user->setImage('default.png');

        $manager->persist($user);
        $this->addReference('user-maria', $user);

		$manager->flush();
	}
}

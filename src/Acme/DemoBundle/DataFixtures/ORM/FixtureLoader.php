<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Acme\DemoBundle\Entity\Redirect;

class FixtureLoader implements FixtureInterface
{

    public function load($manager)
    {
        $redirect1 = new Redirect();
        $redirect1->setSource('foo/bar');
        $redirect1->setDestination('/');
        $redirect1->setStatusCode(302);
        $manager->persist($redirect1);

        $redirect2 = new Redirect();
        $redirect2->setSource('foo/baz');
        $redirect2->setDestination('http://www.google.com/');
        $manager->persist($redirect2);

        $redirect5 = new Redirect();
        $redirect5->setSource('foo/baz/bar');
        $redirect5->setDestination('/demo/hello/bar');
        $manager->persist($redirect5);

        $redirect3 = new Redirect();
        $redirect3->setSource('foo/baz/bar#boo');
        $redirect3->setDestination('/demo/hello/boo');
        $manager->persist($redirect3);

        $redirect4 = new Redirect();
        $redirect4->setSource('foo/baz/bar#foo');
        $redirect4->setDestination('/demo/hello/foo');
        $manager->persist($redirect4);

        $notfound1 = new Redirect();
        $notfound1->setSource('not/found');
        $manager->persist($notfound1);

        $manager->flush();
    }

}

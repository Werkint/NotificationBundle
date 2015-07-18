<?php
namespace Werkint\Bundle\NotificationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * DefaultController.
 */
class DefaultController
{
    /**
     * @Rest\Get("/hello/{name}")
     * @Rest\View()
     */
    public function indexAction($name)
    {
        return ['name' => $name];
    }
}

<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class SyliusResourceController
 * @package Positibe\Bundle\SeoBundle\Controller
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SyliusResourceController extends ResourceController
{
    public function findOr404(Request $request, array $criteria = array())
    {
        $resource = parent::findOr404($request, $criteria);

        $this->get('positibe_seo.loader')->load($request, array('resource' => $resource));

        return $resource;
    }

    public function indexAction(Request $request)
    {
        $this->get('positibe_seo.loader')->load($request);
        return parent::indexAction($request);
    }


}
<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Generator;

use Positibe\Bundle\SeoBundle\Entity\SeoRoute as Route;

/**
 * Class RouteGroupgenerator
 * @package Positibe\Bundle\SeoBundle\generator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class RouteGroupGenerator
{
    /**
     * @param $name
     * @param $staticPrefix
     * @param $title
     * @param $description
     * @param $keywords
     * @param int $page
     * @param array $defaults
     * @param null $method
     * @param array $options
     * @return Route|\Symfony\Component\Routing\Route
     */
    public static function generate(
        $name,
        $staticPrefix,
        $title,
        $description,
        $keywords,
        $page = 0,
        array $defaults = array(),
        $method = null,
        array $options = array()
    ) {
        $route = new Route();

        $route->setDefaults($defaults);
        $route->setOptions($options);

        $route->setGroup($name);

        if (!$method) {
            $route = $route->setMethods($method);
        }

        if ($page == 1) {
            self::setters($route, $name, $staticPrefix, $title, $description, $keywords);
        } else {
            $route = self::setters(
                $route,
                $name . '_' . $page,
                $staticPrefix . '-page-' . $page,
                $title,
                $description,
                $keywords
            );


            $route->addDefaults(array('page' => $page));
        }

        return $route;
    }

    protected static function setters(Route $route, $name, $staticPrefix, $title, $description, $keywords)
    {
        $route->setName($name);
        $route->setStaticPrefix($staticPrefix);

        $route->setTitle($title);
        $route->setDescription($description);
        $route->setKeywords($keywords);

        return $route;
    }
} 
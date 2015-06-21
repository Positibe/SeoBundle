<?php
/**
 * This file is part of the Positibe Standard Bundles project.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Cmf\Bundle\RoutingBundle\Model\Route as BaseRoute;

use Positibe\Bundle\SeoBundle\Extractor\SeoReadInterface;

/**
 * Class SeoRoute
 * @package Positibe\Bundle\SeoBundle\Entity
 *
 * @todo Cargar el content de distintas tablas para hacerlo manejable por distintas entidades.
 * @todo Cargar la entidad solo cuando esté activado e instalado el CmfRoutingBundle
 *
 * @ORM\Table("positibe_seo_route")
 * @ORM\Entity
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SeoRoute extends BaseRoute implements SeoReadInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=TRUE)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="route_group", type="string", length=255, nullable=TRUE)
     */
    protected $group;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="integer")
     */
    protected $position = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text")
     */
    protected $keywords;

    public function extract(SeoReadInterface $content)
    {
        $this->setTitle($content->getSeoTitle());
        $this->setDescription($content->getSeoDescription());
        $this->setKeywords($content->getSeoKeywords());
    }

    /**
     * Provide a description of this page to be used in SEO context.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->description;
    }

    /**
     * Provides a list of keywords for this page to be
     * used in SEO context.
     *
     * @return string|array
     */
    public function getSeoKeywords()
    {
        return $this->keywords;
    }

    /**
     * The method returns the absolute URL as a string to redirect to or set to
     * the canonical link.
     *
     * @return string An absolute URL.
     */
    public function getSeoOriginalUrl()
    {
        return $this->getPath();
    }

    /**
     * Provides a title of this page to be used in SEO context.
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }
} 
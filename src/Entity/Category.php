<?php

namespace App\Entity;

use App\Domain\DTO\CategoryDTO;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\MaterializedPathRepository")
 * @Gedmo\Tree(type="materializedPath")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\TreePath(appendId=false, separator="/", startsWithSeparator=false, endsWithSeparator=false)
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @Gedmo\TreePathSource
     * @Gedmo\Slug(fields={"title"}, separator="_", unique=true, updatable=true)
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @Gedmo\TreeParent()
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @Gedmo\TreeLevel()
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     */
    private $level;



    public function __construct(CategoryDTO $dto)
    {
        $this->update($dto);
    }

    public function update(CategoryDTO $dto)
    {
        $this->level = $dto->level;
        $this->title = $dto->title;
    }

    /**
     * @param mixed $children
     */
    public function setChildren(Category $children)
    {
        $this->children[] = $children;
    }

    /**
     * @param mixed $parent
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}

<?php

namespace App\Form\DataTransformer;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Form\DataTransformerInterface;

readonly class TagTransformer implements DataTransformerInterface
{

    public function __construct(
        private TagRepository $tagRepository
    ) {
    }

    /**
     * @param PersistentCollection $value
     * @return string
     */
    public function transform(mixed $value): mixed
    {
        if($value === null) {
            return '';
        }
        return $value->reduce(function ($acc,$curr) {
            return $acc . ($acc ? ', ' : '') . $curr->getName();
        },'');
    }

    public function reverseTransform(mixed $value = null): ArrayCollection
    {
        if(!$value) {
            return new ArrayCollection();
        }
        $items = explode(',', $value);
        $items = array_map('trim',$items);
        $items = array_unique($items);

        $tags = new ArrayCollection();

        foreach($items as $item) {
            $tag = $this->tagRepository->findOneBy(['name' => $item]);
            if(!$tag) {
                $tag = new Tag()->setName($item);
            }
            $tags->add($tag);
        }

        return $tags;
    }
}

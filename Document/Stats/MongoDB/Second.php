<?php

/**
 * This file is part of the TchoulomViewCounterBundle package.
 *
 * @package    TchoulomViewCounterBundle
 * @author     Original Author <tchoulomernest@gmail.com>
 *
 * (c) Ernest TCHOULOM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tchoulom\ViewCounterBundle\Document\Stats\MongoDB;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(collection: 'second', repositoryClass: 'Tchoulom\ViewCounterBundle\Repository\Stats\MongoDB\SecondRepository')]
#[MongoDB\HasLifecycleCallbacks]
class Second
{
    use ViewTrait;
    use AuditTrait;

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    protected $name;

    #[MongoDB\ReferenceOne(name: 'minute_id', targetDocument: 'Tchoulom\ViewCounterBundle\Document\Stats\MongoDB\Minute', inversedBy: 'seconds')]
    protected $minute;

    /**
     * Gets Id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets Name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets Name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets Minute.
     *
     * @return Minute
     */
    public function getMinute(): Minute
    {
        return $this->minute;
    }

    /**
     * Sets Minute.
     *
     * @param Minute $minute
     *
     * @return self
     */
    public function setMinute(Minute $minute): self
    {
        $this->minute = $minute;

        return $this;
    }
}

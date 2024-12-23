<?php

/**
 * This file is part of the TchoulomViewCounterBundle package.
 *
 * @package    TchoulomViewCounterBundle
 * @author     Original Author <tchoulomernest@yahoo.fr>
 *
 * (c) Ernest TCHOULOM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tchoulom\ViewCounterBundle\Document\Stats\MongoDB;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(collection: 'minute', repositoryClass: 'Tchoulom\ViewCounterBundle\Repository\Stats\MongoDB\MinuteRepository')]
#[MongoDB\HasLifecycleCallbacks]
class Minute
{
    use ViewTrait;
    use AuditTrait;

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    protected $name;

    #[MongoDB\ReferenceOne(name: 'hour_id', targetDocument: 'Tchoulom\ViewCounterBundle\Document\Stats\MongoDB\Hour', inversedBy: 'minutes')]
    protected $hour;

    #[MongoDb\ReferenceMany(targetDocument: 'Tchoulom\ViewCounterBundle\Document\Stats\MongoDB\Second', cascade: ['persist', 'remove'], mappedBy: 'minute')]
    protected $seconds;

    /**
     * Minute constructor.
     */
    public function __construct()
    {
        $this->seconds = new ArrayCollection();
    }

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
     * Gets Hour.
     *
     * @return Hour
     */
    public function getHour(): Hour
    {
        return $this->hour;
    }

    /**
     * Sets Hour.
     *
     * @param Hour $hour
     *
     * @return self
     */
    public function setHour(Hour $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Gets Seconds.
     *
     * @return Collection|Second[]
     */
    public function getSeconds(): Collection
    {
        return $this->seconds;
    }

    /**
     * Add Second.
     *
     * @param Second $second
     *
     * @return self
     */
    public function addSecond(Second $second): self
    {
        if (!$this->seconds->contains($second)) {
            $this->seconds[] = $second;
            $second->setMinute($this);
        }

        return $this;
    }

    /**
     * Remove Second.
     *
     * @param Second $second
     *
     * @return self
     */
    public function removeSecond(Second $second): self
    {
        if ($this->seconds->contains($second)) {
            $this->seconds->removeElement($second);
        }

        return $this;
    }
}

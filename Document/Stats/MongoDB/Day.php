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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(collection: 'day', repositoryClass: 'Tchoulom\ViewCounterBundle\Repository\Stats\MongoDB\DayRepository')]
#[MongoDB\HasLifecycleCallbacks]
class Day
{
    use ViewTrait;
    use AuditTrait;

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    protected $name;

    #[MongoDB\ReferenceOne(name: 'week_id', targetDocument: 'Tchoulom\ViewCounterBundle\Document\Stats\MongoDB\Week', inversedBy: 'days')]
    protected $week;

    #[MongoDb\ReferenceMany(targetDocument: 'Tchoulom\ViewCounterBundle\Document\Stats\MongoDB\Hour', cascade: ['persist', 'remove'], mappedBy: 'day')]
    protected $hours;

    /**
     * Day constructor.
     */
    public function __construct()
    {
        $this->hours = new ArrayCollection();
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
     * Gets Week.
     *
     * @return Week
     */
    public function getWeek(): Week
    {
        return $this->week;
    }

    /**
     * Sets Week.
     *
     * @param Week $week
     *
     * @return self
     */
    public function setWeek(Week $week): self
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Gets Hours.
     *
     * @return Collection|Hour[]
     */
    public function getHours(): Collection
    {
        return $this->hours;
    }

    /**
     * Add Hour.
     *
     * @param Hour $hour
     *
     * @return self
     */
    public function addHour(Hour $hour): self
    {
        if (!$this->hours->contains($hour)) {
            $this->hours[] = $hour;
            $hour->setDay($this);
        }

        return $this;
    }

    /**
     * Remove Hour.
     *
     * @param Hour $hour
     *
     * @return self
     */
    public function removeHour(Hour $hour): self
    {
        if ($this->hours->contains($hour)) {
            $this->hours->removeElement($hour);
        }

        return $this;
    }
}

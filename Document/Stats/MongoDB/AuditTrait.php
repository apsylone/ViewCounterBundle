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

use DateTime;
use DateTimeInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Trait AuditTrait
 */
trait AuditTrait
{
    #[MongoDB\Field(name: 'created_at', type: Type::DATE)]
    protected $createdAt;

    #[MongoDB\Field(name: 'updated_at', type: Type::DATE)]
    protected $updatedAt;

    #[MongoDB\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime();
    }

    #[MongoDB\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}

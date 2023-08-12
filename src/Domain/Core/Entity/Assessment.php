<?php

namespace App\Domain\Core\Entity;

use App\Domain\Core\Exception\ExpiredAssessmentCanNotBeLocked;
use DateTime;

class Assessment
{
    private Supervisor $supervisor;
    private Client $client;
    private Standard $standard;
    private bool $rating;
    private readonly \DateTime $date;
    private ?Lock $lock;

    const EXPIRATION_DAYS = 365;

    public function __construct(Supervisor $supervisor, Client $client, Standard $standard, $rating) {
        $this->supervisor = $supervisor;
        $this->client = $client;
        $this->standard = $standard;
        $this->rating = $rating;
        $this->date = new DateTime();
    }

    public function isExpired() {
        $expirationDate = clone $this->date;
        $expirationDate->modify('+' . self::EXPIRATION_DAYS . ' days');
        return (new DateTime()) > $expirationDate;
    }

    public function lock(string $type, string $description): self {

        if ($this->isExpired()) {
            throw new ExpiredAssessmentCanNotBeLocked;
        }

        $lock = new Lock($type, $description);
        $this->lock = $lock;

        return $this;
    }

    public function unlock() {
       if ($this->lock) {
           throw new \Exception();
       }
    }

    public function withdrawn() {

    }

    public function canEvaluateAfter() {
        if ($this->rating) {
            return $this->date->modify('+180 days');
        }
        return $this->date->modify('+30 days');
    }

    public function getSupervisor(): Supervisor
    {
        return $this->supervisor;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getStandard(): Standard
    {
        return $this->standard;
    }

    public function isRating(): bool
    {
        return $this->rating;
    }

    public function getLock(): ?Lock
    {
        return $this->lock;
    }
}
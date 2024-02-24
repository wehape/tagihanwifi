<?php

namespace PHPMaker2024\tagihanwifi01\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\tagihanwifi01\AbstractEntity;
use PHPMaker2024\tagihanwifi01\AdvancedSecurity;
use PHPMaker2024\tagihanwifi01\UserProfile;
use function PHPMaker2024\tagihanwifi01\Config;
use function PHPMaker2024\tagihanwifi01\EntityManager;
use function PHPMaker2024\tagihanwifi01\RemoveXss;
use function PHPMaker2024\tagihanwifi01\HtmlDecode;
use function PHPMaker2024\tagihanwifi01\EncryptPassword;

/**
 * Entity class for "status" table
 */
#[Entity]
#[Table(name: "status")]
class Status extends AbstractEntity
{
    public static array $propertyNames = [
        'NomorStatus' => 'nomorStatus',
        'Status' => 'status',
        'Nilai' => 'nilai',
    ];

    #[Id]
    #[Column(name: "NomorStatus", type: "string", unique: true)]
    private string $nomorStatus;

    #[Column(name: "Status", type: "string")]
    private string $status;

    #[Column(name: "Nilai", type: "integer")]
    private int $nilai;

    public function getNomorStatus(): string
    {
        return $this->nomorStatus;
    }

    public function setNomorStatus(string $value): static
    {
        $this->nomorStatus = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(string $value): static
    {
        $this->status = RemoveXss($value);
        return $this;
    }

    public function getNilai(): int
    {
        return $this->nilai;
    }

    public function setNilai(int $value): static
    {
        $this->nilai = $value;
        return $this;
    }
}

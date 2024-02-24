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
 * Entity class for "subscription" table
 */
#[Entity]
#[Table(name: "subscription")]
class Subscription extends AbstractEntity
{
    public static array $propertyNames = [
        'NomorSubscription' => 'nomorSubscription',
        'JenisSubscription' => 'jenisSubscription',
        'BulanSubscription' => 'bulanSubscription',
        'KeteranganSubscription' => 'keteranganSubscription',
    ];

    #[Id]
    #[Column(name: "NomorSubscription", type: "string", unique: true)]
    private string $nomorSubscription;

    #[Column(name: "JenisSubscription", type: "string")]
    private string $jenisSubscription;

    #[Column(name: "BulanSubscription", type: "string")]
    private string $bulanSubscription;

    #[Column(name: "KeteranganSubscription", type: "string")]
    private string $keteranganSubscription;

    public function getNomorSubscription(): string
    {
        return $this->nomorSubscription;
    }

    public function setNomorSubscription(string $value): static
    {
        $this->nomorSubscription = $value;
        return $this;
    }

    public function getJenisSubscription(): string
    {
        return HtmlDecode($this->jenisSubscription);
    }

    public function setJenisSubscription(string $value): static
    {
        $this->jenisSubscription = RemoveXss($value);
        return $this;
    }

    public function getBulanSubscription(): string
    {
        return HtmlDecode($this->bulanSubscription);
    }

    public function setBulanSubscription(string $value): static
    {
        $this->bulanSubscription = RemoveXss($value);
        return $this;
    }

    public function getKeteranganSubscription(): string
    {
        return HtmlDecode($this->keteranganSubscription);
    }

    public function setKeteranganSubscription(string $value): static
    {
        $this->keteranganSubscription = RemoveXss($value);
        return $this;
    }
}

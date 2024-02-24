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
 * Entity class for "bandwidth" table
 */
#[Entity]
#[Table(name: "bandwidth")]
class Bandwidth extends AbstractEntity
{
    public static array $propertyNames = [
        'NomorBandwidth' => 'nomorBandwidth',
        'Bandwidth' => 'bandwidth',
        'Harga' => 'harga',
    ];

    #[Id]
    #[Column(name: "NomorBandwidth", type: "string", unique: true)]
    private string $nomorBandwidth;

    #[Column(name: "Bandwidth", type: "string")]
    private string $bandwidth;

    #[Column(name: "Harga", type: "integer")]
    private int $harga;

    public function getNomorBandwidth(): string
    {
        return $this->nomorBandwidth;
    }

    public function setNomorBandwidth(string $value): static
    {
        $this->nomorBandwidth = $value;
        return $this;
    }

    public function getBandwidth(): string
    {
        return HtmlDecode($this->bandwidth);
    }

    public function setBandwidth(string $value): static
    {
        $this->bandwidth = RemoveXss($value);
        return $this;
    }

    public function getHarga(): int
    {
        return $this->harga;
    }

    public function setHarga(int $value): static
    {
        $this->harga = $value;
        return $this;
    }
}

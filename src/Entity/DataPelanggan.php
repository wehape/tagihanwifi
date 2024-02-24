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
 * Entity class for "data_pelanggan" table
 */
#[Entity]
#[Table(name: "data_pelanggan")]
class DataPelanggan extends AbstractEntity
{
    public static array $propertyNames = [
        'NomorPelanggan' => 'nomorPelanggan',
        'NamaPelanggan' => 'namaPelanggan',
        'IP' => 'ip',
        'Bandwidth' => 'bandwidth',
        'Harga' => 'harga',
        'JenisSubscription' => 'jenisSubscription',
        'BulanSubscription' => 'bulanSubscription',
        'KeteranganSubscription' => 'keteranganSubscription',
    ];

    #[Id]
    #[Column(name: "NomorPelanggan", type: "string", unique: true)]
    private string $nomorPelanggan;

    #[Column(name: "NamaPelanggan", type: "string")]
    private string $namaPelanggan;

    #[Column(name: "IP", type: "string")]
    private string $ip;

    #[Column(name: "Bandwidth", type: "string")]
    private string $bandwidth;

    #[Column(name: "Harga", type: "integer")]
    private int $harga;

    #[Column(name: "JenisSubscription", type: "string")]
    private string $jenisSubscription;

    #[Column(name: "BulanSubscription", type: "string")]
    private string $bulanSubscription;

    #[Column(name: "KeteranganSubscription", type: "string")]
    private string $keteranganSubscription;

    public function getNomorPelanggan(): string
    {
        return $this->nomorPelanggan;
    }

    public function setNomorPelanggan(string $value): static
    {
        $this->nomorPelanggan = $value;
        return $this;
    }

    public function getNamaPelanggan(): string
    {
        return HtmlDecode($this->namaPelanggan);
    }

    public function setNamaPelanggan(string $value): static
    {
        $this->namaPelanggan = RemoveXss($value);
        return $this;
    }

    public function getIp(): string
    {
        return HtmlDecode($this->ip);
    }

    public function setIp(string $value): static
    {
        $this->ip = RemoveXss($value);
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

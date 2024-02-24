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
 * Entity class for "broadcast" table
 */
#[Entity]
#[Table(name: "broadcast")]
class Broadcast extends AbstractEntity
{
    public static array $propertyNames = [
        'NomorBC' => 'nomorBc',
        'Tahun' => 'tahun',
        'Bulan' => 'bulan',
        'Tanggal' => 'tanggal',
        'NamaPelanggan' => 'namaPelanggan',
        'IP' => 'ip',
        'Bandwidth' => 'bandwidth',
        'Tagihan' => 'tagihan',
        'JenisSubscription' => 'jenisSubscription',
        'BulanSubscription' => 'bulanSubscription',
        'KeteranganSubscription' => 'keteranganSubscription',
        'Status' => 'status',
        'Nilai' => 'nilai',
    ];

    #[Id]
    #[Column(name: "NomorBC", type: "string", unique: true)]
    private string $nomorBc;

    #[Column(name: "Tahun", type: "string")]
    private string $tahun = date("Y");

    #[Column(name: "Bulan", type: "string")]
    private string $bulan = date("F");

    #[Column(name: "Tanggal", type: "string")]
    private string $tanggal = date("d F Y");

    #[Column(name: "NamaPelanggan", type: "string")]
    private string $namaPelanggan;

    #[Column(name: "IP", type: "string")]
    private string $ip;

    #[Column(name: "Bandwidth", type: "string")]
    private string $bandwidth;

    #[Column(name: "Tagihan", type: "integer")]
    private int $tagihan;

    #[Column(name: "JenisSubscription", type: "string")]
    private string $jenisSubscription;

    #[Column(name: "BulanSubscription", type: "string")]
    private string $bulanSubscription;

    #[Column(name: "KeteranganSubscription", type: "string")]
    private string $keteranganSubscription;

    #[Column(name: "Status", type: "string")]
    private string $status;

    #[Column(name: "Nilai", type: "integer")]
    private int $nilai = "0";

    public function getNomorBc(): string
    {
        return $this->nomorBc;
    }

    public function setNomorBc(string $value): static
    {
        $this->nomorBc = $value;
        return $this;
    }

    public function getTahun(): string
    {
        return HtmlDecode($this->tahun);
    }

    public function setTahun(string $value): static
    {
        $this->tahun = RemoveXss($value);
        return $this;
    }

    public function getBulan(): string
    {
        return HtmlDecode($this->bulan);
    }

    public function setBulan(string $value): static
    {
        $this->bulan = RemoveXss($value);
        return $this;
    }

    public function getTanggal(): string
    {
        return HtmlDecode($this->tanggal);
    }

    public function setTanggal(string $value): static
    {
        $this->tanggal = RemoveXss($value);
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

    public function getTagihan(): int
    {
        return $this->tagihan;
    }

    public function setTagihan(int $value): static
    {
        $this->tagihan = $value;
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

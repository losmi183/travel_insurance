<?php

namespace App\Entity;

use App\Repository\NosiociOsiguranjaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NosiociOsiguranjaRepository::class)]
class NosiociOsiguranja
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ime_prezime = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_rodjenja = null;

    #[ORM\Column(length: 20)]
    private ?string $broj_pasosa = null;

    #[ORM\Column(length: 20)]
    private ?string $telefon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_putovanja_od = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_putovanja_do = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $vrsta_polise = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options:['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $datum_kreiranja = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImePrezime(): ?string
    {
        return $this->ime_prezime;
    }

    public function setImePrezime(string $ime_prezime): static
    {
        $this->ime_prezime = $ime_prezime;

        return $this;
    }

    public function getDatumRodjenja(): ?\DateTimeInterface
    {
        return $this->datum_rodjenja;
    }

    public function getDatumRodjenjaFormated(): ?string
    {
        return $this->datum_rodjenja->format('d-m-Y');
    }

    public function setDatumRodjenja(\DateTimeInterface $datum_rodjenja): static
    {
        $this->datum_rodjenja = $datum_rodjenja;

        return $this;
    }

    public function getBrojPasosa(): ?string
    {
        return $this->broj_pasosa;
    }

    public function setBrojPasosa(string $broj_pasosa): static
    {
        $this->broj_pasosa = $broj_pasosa;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): static
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDatumPutovanjaOd(): ?\DateTimeInterface
    {
        return $this->datum_putovanja_od;
    }
    public function getDatumPutovanjaOdFormated(): ?string
    {
        return $this->datum_putovanja_od->format('d-m-Y');
    }

    public function setDatumPutovanjaOd(\DateTimeInterface $datum_putovanja_od): static
    {
        $this->datum_putovanja_od = $datum_putovanja_od;

        return $this;
    }
    public function getDatumPutovanjaDoFormated(): ?string
    {
        return $this->datum_putovanja_do->format('d-m-Y');
    }

    public function getDatumPutovanjaDo(): ?\DateTimeInterface
    {
        return $this->datum_putovanja_do;
    }

    public function setDatumPutovanjaDo(\DateTimeInterface $datum_putovanja_do): static
    {
        $this->datum_putovanja_do = $datum_putovanja_do;

        return $this;
    }

    public function getVrstaPolise(): ?string
    {
        return $this->vrsta_polise;
    }

    public function setVrstaPolise(?string $vrsta_polise): static
    {
        $this->vrsta_polise = $vrsta_polise;

        return $this;
    }

    public function getDatumKreiranja(): ?\DateTimeInterface
    {
        return $this->datum_kreiranja;
    }
    public function getDatumKreiranjaFormated(): ?string
    {
        return $this->datum_kreiranja->format('d-m-Y');
    }

    public function setDatumKreiranja(\DateTimeInterface $datum_kreiranja): static
    {
        $this->datum_kreiranja = $datum_kreiranja;

        return $this;
    }
}

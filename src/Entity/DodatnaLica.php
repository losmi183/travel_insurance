<?php

namespace App\Entity;

use App\Repository\DodatnaLicaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DodatnaLicaRepository::class)]
class DodatnaLica
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?NosiociOsiguranja $nosilac_osiguranja_id = null;

    #[ORM\Column(length: 255)]
    private ?string $ime_prezime = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_rodjenja = null;

    #[ORM\Column(length: 20)]
    private ?string $broj_pasosa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNosilacOsiguranjaId(): ?NosiociOsiguranja
    {
        return $this->nosilac_osiguranja_id;
    }

    public function setNosilacOsiguranjaId(?NosiociOsiguranja $nosilac_osiguranja_id): static
    {
        $this->nosilac_osiguranja_id = $nosilac_osiguranja_id;

        return $this;
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
}

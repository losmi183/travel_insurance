<?php

namespace App\Entity;

use App\Repository\NosiociOsiguranjaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NosiociOsiguranjaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class NosiociOsiguranja
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Ime i prezime je obavezno polje.')]
    #[Assert\Length(
        min: 3,
        max: 20,
        minMessage: 'Ime i prezime mora imati bar {{ limit  }} karaktera.',
        maxMessage: 'Ime i prezime može imati najviše {{ limit  }} karaktera.'
    )]
    private ?string $ime_prezime = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $datum_rodjenja = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: 'Broj pasoša je obavezno polje.')]
    private ?string $broj_pasosa = null;

    #[ORM\Column(length: 20)]
    private ?string $telefon = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Email(message: 'Email "{{ value }}" nije validna adresa.')]
    #[Assert\Length(
        min: 3,
        max: 20,
        minMessage: 'Email mora imati bar {{ limit  }} karaktera.',
        maxMessage: 'Email može imati najviše {{ limit  }} karaktera.'
    )]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $datum_putovanja_od = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
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

    public function setDatumRodjenja(string $datum_rodjenja): ?static
    {
        if ($datum_rodjenja === null || $datum_rodjenja === '') {
            return null;
        }
        $this->datum_rodjenja = $this->stringToDate($datum_rodjenja);

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

    public function setDatumPutovanjaOd(?string $datum_putovanja_od): ?static
    {
        if ($datum_putovanja_od === null || $datum_putovanja_od === '') {
            return null;
        }
        $this->datum_putovanja_od = $this->stringToDate($datum_putovanja_od);

        return $this;
    }
    // public function getDatumPutovanjaDoFormated(): ?string
    // {
    //     return $this->datum_putovanja_do->format('d-m-Y');
    // }

    public function getDatumPutovanjaDo(): ?\DateTimeInterface
    {
        return $this->datum_putovanja_do;
    }

    public function setDatumPutovanjaDo(?string $datum_putovanja_do): ?static
    {
        if ($datum_putovanja_do === null || $datum_putovanja_do === '') {
            return null;
        }
        $this->datum_putovanja_do = $this->stringToDate($datum_putovanja_do);

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

    public function setDatumKreiranja(\DateTimeInterface $datum_kreiranja): static
    {
        $this->datum_kreiranja = $datum_kreiranja;

        return $this;
    }

    #[ORM\PrePersist]
    public function setDatumKreiranjaValue(): void
    {
        $this->datum_kreiranja = new \DateTimeImmutable();
    }

    /**
     * @param mixed $date
     * 
     * @return \DateTimeInterface|null
     */
    private function stringToDate(mixed $date): ?\DateTimeInterface {
        if (is_string($date)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                $date = null;
            }
        }
        return $date;
    }
}

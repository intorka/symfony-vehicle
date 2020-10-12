<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $producer;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $series;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $sub_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(?string $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function setSeries(?string $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSubCat(): ?string
    {
        return $this->sub_cat;
    }

    public function setSubCat(?string $sub_cat): self
    {
        $this->sub_cat = $sub_cat;

        return $this;
    }
}

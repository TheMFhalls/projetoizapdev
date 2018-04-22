<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoRepository")
 */
class Estado
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $sigla;

    public function getId()
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }
}

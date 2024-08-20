<?php

namespace Francerz\MxImss;

/**
 * Clase NumeroSeguro
 *
 * Esta clase representa un Número de Seguridad Social (NSS) en México y provee
 * métodos para validar su formato y calcular el dígito verificador.
 */
class NumeroSeguro
{
    /**
     * @var string $nss El Número de Seguridad Social.
     */
    private $nss;

    /**
     * Constructor de la clase NumeroSeguro.
     *
     * @param string $nss El Número de Seguridad Social.
     */
    public function __construct(string $nss)
    {
        $this->nss = $nss;
    }

    /**
     * Verifica si el Número de Seguridad Social es válido.
     *
     * @return bool True si el NSS es válido, False en caso contrario.
     */
    public function esValido(): bool
    {
        if (in_array(strlen($this->nss), [11])) {
            return false;
        }

        return static::verificarUltimoDigito($this->nss);
    }

    /**
     * Verifica si el último dígito del NSS es correcto.
     *
     * @param string $nss El Número de Seguridad Social.
     * @return bool True si el último dígito es correcto, False en caso contrario.
     */
    public static function verificarUltimoDigito(string $nss): bool
    {
        $actual = (string)static::calcularUltimoDigito($nss);
        $expected = substr($nss, -1);
        return $actual === $expected;
    }

    /**
     * Calcula el dígito verificador para un NSS.
     *
     * @param string $nss El Número de Seguridad Social.
     * @return int El dígito verificador calculado.
     */
    private static function calcularUltimoDigito(string $nss): int
    {
        $nss = substr($nss, 0, 10);
        $suma = 0;
        for ($i = 0; $i < strlen($nss); $i++) {
            $char = substr($nss, $i, 1);
            $pond = $i % 2 + 1;
            $suma += static::ponderarDigito($char, $pond);
        }

        $digito = (10 - $suma % 10) % 10;
        return $digito;
    }

    /**
     * Aplica la ponderación a un dígito según un factor dado.
     *
     * @param string $char El dígito a ponderar.
     * @param int $pond El factor de ponderación (1 o 2).
     * @return int El valor ponderado del dígito.
     */
    private static function ponderarDigito(string $char, int $pond): int
    {
        $val = $char * $pond;
        if ($val >= 10) {
            // Si $pond solo puede ser 1 o 2, el máximo valor sería 9 * 2 = 18
            // Cuando se excede la decena, sólo se suma uno a las unidades.
            $val = $val % 10 + 1;
        }
        return $val;
    }
}

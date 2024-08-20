# Francerz/MxImss

`francerz/mx-imss` es una librería para PHP que proporciona herramientas para trabajar con Números de Seguridad Social (NSS) en México. Actualmente, incluye la clase `NumeroSeguro` para la validación de números de seguro social del IMSS.

## Instalación

Puedes instalar esta librería utilizando Composer:

```bash
composer require francerz/mx-imss
```

## Uso

### Validación de un Número de Seguridad Social

La clase `NumeroSeguro` permite validar si un NSS es correcto en función de su longitud y el cálculo del dígito verificador. A continuación, se muestra un ejemplo de uso:

```php
require 'vendor/autoload.php';

use Francerz\MxImss\NumeroSeguro;

// Ejemplo de NSS válido
$nssValido = "84966311213";
$numeroSeguro = new NumeroSeguro($nssValido);

if ($numeroSeguro->esValido()) {
    echo "El NSS $nssValido es válido.";
} else {
    echo "El NSS $nssValido no es válido.";
}

// Ejemplo de NSS inválido
$nssInvalido = "84966311215";
$numeroSeguro = new NumeroSeguro($nssInvalido);

if ($numeroSeguro->esValido()) {
    echo "El NSS $nssInvalido es válido.";
} else {
    echo "El NSS $nssInvalido no es válido.";
}
```

### Métodos Disponibles

#### `NumeroSeguro::__construct(string $nss)`

Constructor de la clase. Recibe como parámetro el NSS que se desea validar.

#### `NumeroSeguro::esValido() : bool`

Verifica si el NSS es válido en función de su longitud y el cálculo del dígito verificador.

#### `NumeroSeguro::verificarUltimoDigito(string $nss) : bool`

Valida el dígito verificador de un NSS específico.

### Requisitos

- PHP 7.4 o superior.

## Contribución

Las contribuciones son bienvenidas. Por favor, crea un *fork* del repositorio, realiza tus cambios y abre un *pull request*.

## Licencia

Este proyecto está licenciado bajo la [ISC License](LICENSE).

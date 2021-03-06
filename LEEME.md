# Hosting
http://sergiobarrio.ociobinario.com/index.php

## Usuario administrador para la web
Usuario: admin@logrocho.local
Contraseña: usuario123ABC

# GitHub
https://github.com/sbdlv/logrocho

# Instrucciones de montaje del entorno (Local)
Por favor, leer todos los apartados de este fichero, en especial aquellos que afecten a la asignatura que se está evaluando.

## BD
- Nombre: logrocho
- usuario: root
- pass: ""
(Configurable desde el fichero db.php)

> Se adjunta un fichero con la estructura de la BD. Incluye **datos de prueba** y se encarga de recrear las tablas desde 0. En caso de error, borrar manualmente todas las tablas dentro de la DB a la que se va a importar.

## Instrucciones XAMPP:
- La carpeta htdocs dentro de XAMPP. La ruta debería de ser indiferente, ya que el index.php se encarga de abstraer la ruta en la que se encuentra.

## Detalles para DWES
- Para las peticiones que requieren de permisos admin se ha comentado la linea que comprueba dicha condición (Por comodidad a la hora de hacer las pruebas con Postman)
- Para las peticiones POST, todos los campos están definidos en el apartado de `Body`
- Para probar a subir imágenes deberías de poder ver un campo llamado `pic` en las peticiones de `Upload IMG` (Bar y pincho) aun que también se puede hacer desde backoffice
- Para la búsqueda por token se hace desde la llamada `Token search`.
- Para la obtención de pinchos y reseñas por orden de puntuación, se hace desde la llamada `Best Pinchos and Reviews`.

# Para comprobar
> Suponiendo que la raiz de index es localhost/

## Parte admin (La de bares, pero luego se puede navegar por el resto): 
http://localhost/index.php/bar/list
## Contacto: 
http://localhost/contact.php
## Registro: 
http://localhost/index.php/user/register
## Slider: 
Es el primero que sale arriba del todo en el index.

http://localhost/index.php
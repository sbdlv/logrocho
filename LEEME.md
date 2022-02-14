# Instrucciones de montaje del entorno
Por favor, leer todos los apartados de este fichero, en especial aquellos que afecten a la asignatura que se está evaluando.

## BD
- Nombre: logrocho
- usuario: root
- pass: ""
(Configurable desde el fichero db.php)

> Se adjunta un fichero con la estructura de la BD. Incluye **datos de prueba** y se encarga de recrear las tablas desde 0. En caso de error, borrar manualmente todas las tablas dentro de la DB a la que se va a importar.

## Instrucciones XAMPP:
- La carpeta htdocs dentro de XAMPP. La ruta debería de ser indiferente, ya que el index.php se encarga de abstraer la ruta en la que se encuentra.

# NOTAS
- Los campos calculados se muestran con un ?, ya que de momento no se ha pedido implementar la funcionalidad de creación de reseñas por parte del usuario, likes etc.

# Para comprobar
> Suponiendo que la raiz de index es localhost/
## Parte admin (La de bares, pero luego se puede navegar por el resto): 
http://localhost/index.php/bar
## Contacto: 
http://localhost/contact.php
## Registro: 
http://localhost/index.php/user/register
## Slider: 
Es el primero que sale arriba del todo en el index.

http://localhost/index.php
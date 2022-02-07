# Instrucciones de montaje del entorno

## BD
- Nombre: logrocho
- usuario: root
- pass: ""
(Configurable desde el fichero db.php)

> Se adjunta un fichero con la estructura de la BD. Incluye datos de prueba, y se encarga de recrear las tablas desde 0.


## Instrucciones XAMPP:
- La carpeta htdocs dentro de XAMPP. La ruta debería de ser indiferente, ya que el index.php se encarga de abstraer la ruta en la que se encuentra.
  
## Postman
- Para las pruebas de PostMan (CRUD + JSON etc) se ha añadido a la entrega el fichero `Logr8.postman_collection.json`. 
Para importarlo desde postman se hace desde el menu `File > Import` y lo importamos. De esta forma ya tendrás configuradas las diferentes peticiones
y solo tendrás que cambiar la ruta (En mi caso es logrocho.local, peor la tendrás que **CAMBIAR** por lo tuya (Ej.: localhost etc)).

## Detalles para DWES
- Para las peticiones que requieren de permisos admin se ha comentado la linea que comprueba dicha condición (Por comodidad a la hora de hacer las pruebas con Postman)
- Para las peticiones POST, todos los campos están definidos en el apartado de `Body`
- Para probar a subir imágenes deberías de poder ver un campo llamado `pic` en las peticiones de `Upload IMG` (Bar y pincho)
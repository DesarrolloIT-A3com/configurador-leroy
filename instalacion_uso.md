## INSTALACIÓN DE UN SERVIDOR LOCAL PARA EL CONFIGURADOR

Se ha de tener Docker instalado, ya que actuará como un hosting local para arrancar php y phpmyadmin.

El archivo `docker-compose.yml` debe de estar en la raíz del configurador.

Para el **configurador de leroy** se utiliza la siguiente base de datos `8432940_arjomy-17-10-22`.

Para el **configurador** se utiliza la siguiente base de datos `8432940_tiendas-arjomy-2-12-2022`.

Hay que cambiarlo también en el archivo `docker-compose.yml` ya que si no crea la base de datos con el nombre que tenga actual

Es **MUY IMPORTANTE** que en el archivo conf.php ubicado en `./etc/conf.php`la propiedad server tome como valor `db` ya que si no todos los cambios que se hagan en la base de datos **APUNTAN A PRODUCCIÓN**

La configuración que ha de haber en conf.php es la siguiente

```php
// ESTABLECEMOS ZONA HORARIA
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_TIME, 'es_ES.UTF-8');
setlocale(LC_NUMERIC, 'C');




// DATOS PARA LA CONEXIÓN DE LA BASE DE DATOS
define("SERVER","db");
define("USER","root");
define("PASS","admin");
define("DB",<base de datos dependiendo del configurador>);
```

Con esta configuración e instalación creamos 3 contenedores

- configurador-pma - Cotenedor que ejecuta phpmyadmin
- configurador-web - Contenedor que ejecuta el servidor php
- configurador-db - Contenedor que ejecuta el servidor de la base de datos

## PRIMER ARRANQUE DEL SERVIDOR

Para levantar el contenedor por primera vez usamos el siguiente comando

```console
docker compose up -d --build
```

Este comando solo lo utilizamos la primera vez que creamos el contenedor, ya que docker debe de crear y traerse la imagen para ejecutar el software.

## CARGA DE LA BASE DE DATOS

Para cargar la base de datos primero copiamos la base de datos a una carpeta llamada tmp que crearemos en docker, el comando a utilizar es el siguiente.

```console
docker cp <archivo.sql> configurador-db:/tmp/backup.sql
```

Una vez que está el archivo copiado ejecutamos el siguiente comando para ejecutar el script.sql

```console
docker exec -e MYSQL_PWD=admin configurador-db sh -c "mysql -u root --default-character-set=utf8mb4 <NOMBRE_BBDD> < /tmp/backup.sql"
```

Sustituir `<NOMBRE_BBDD>` por el nombre de la base de datos elegida.

## RECARGA DE LA BASE DE DATOS

En caso de que nos equivoquemos y eliminemos, actualicemos, o queramos volver a cargar la base de datos para empezar de nuevo o desde la última versión copiada seguimos los siguientes pasos

- Eliminamos el contenedor

```console
docker compose down -v
```

- Levantamos el contenedor nuevamente

```console
docker compose build --no-cache
docker compose up -d
```

- Copiamos la base de datos a una carpeta temporal

```console
docker cp <archivo.sql> configurador-db:/tmp/backup.sql
```

- Ejecutamos el script de la base de datos

```console
docker exec -e MYSQL_PWD=admin configurador-db sh -c "mysql -u root --default-character-set=utf8mb4 <NOMBRE_BBDD> < /tmp/backup.sql"
```

## ARRANQUE BÁSICO DEL SERVIDOR

Una vez que ya tenemos todo instalado y queremos arrancar por segunda vez el servidor, podemos hacerlo desde la interfaz de docker desktop o simplemente ejecutando los siguientes comandos

```console
docker start configurador-pma 
docker start configurador-web 
docker start configurador-db
```

Para pararlo usamos la misma lógica, desde docker desktop podemos pararlo o podemos ejecutar los siguientes comandos

```console
docker stop configurador-pma 
docker stop configurador-web 
docker stop configurador-db  
```

## REESTABLECER PROYECTO

Si se tiene que reestablecer el proyecto seguimos los siguientes pasos
 Borramos los volúmenes antiguos

```console
docker compose down -v --remove-orphans
```
Borramos los volúmenes específicos del configurador

```console
docker volume rm configurador-leroy_dbdata
docker volume rm configurador_dbdata
```

Borramos las imágenes correspondientes al proyecto

```console
docker image rm configurador-leroy-web
docker image rm mysql
docker image rm phpmyadmin
```

Reconstruimos el proyecto sin cache

```console
docker compose build --no-cache
docker compose up -d
```

Seguir los pasos para colocar la base de datos actual
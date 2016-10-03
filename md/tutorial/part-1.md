title: Parte 1

# Parte 1 - Instalación de Vendimia Framework

Hola, bienvenido al tutorial de **Vendimia**. Crearemos una aplicación web sencilla para mostrar los puntos más importantes de este framework.

## Prerrequisitos

**Vendimia** requiere para funcionar PHP 5.6 o superior, con los módulos `mbstring` y `fileinfo` instalados, así como `git`.

En Ubuntu 16.04 o superior puedes instalar todo con el siguiente comando:

``` {data-enlighter-language=bash}
sudo apt -y install php-cli php-mbstring git
```

En versiones anteriores, puedes ejecutar:

``` {data-enlighter-language=bash}
sudo apt-get -y install php5-cli git
```

<div class="notice">Todos los tutoriales aquí mostrados (y de hecho, también <strong>Vendimia</strong>) fueron desarrollados y probados en GNU/Linux. Es probable que también funcione en MacOS X. Por favor, cuéntanos tu experiencia de instalación en un <em>issue</em> de GitHub <a href="https://github.com/vendimia/vendimia/issues" target="_blank">haciendo clic aquí</a>.</div>

## Instalar el framework

**Vendimia** puede ser instalado de varias formas:

* Si deseas instalarlo a nivel de todo el sistema, descárgalo dentro de una de las carpetas listadas en la directiva [`include_path`](http://php.net/manual/en/ini.core.php#ini.include-path) del `php.ini`.
* Puedes también instalarlo individualmente una copia para cada proyecto. En tal caso crea la carpeta donde estará el futuro proyecto, y dentro de ella, descarga el **Vendimia**.

En este tutorial usaremos una 3ra forma de instalarlo, que requiere un poco más de configuración, pero es más sencilla de usar: Simplemente descarga el **Vendimia** en cualquier directorio. Usaremos tu carpeta `home` esta vez.

Ejecuta estos dos comandos dentro de `Bash`:

``` {data-enlighter-language=bash}
cd ~
git clone -b dev https://github.com/vendimia/vendimia.git
```

Ahora, necesitamos configurar dos cosas más:

<div class="notice">Si vas a continuar este tutorial en otro momento, siempre tienes que volver a ejecutar estos dos puntos.</div>

* Primero, necesitamos acceso al script de administración de **Vendimia** (llamado, oh sorpresa, `vendimia`), que está dentro del directorio `bin` de la instalación de **Vendimia**. Añadiremos temporalmente esa ruta a la variable `PATH` ejecutando este comando en la consola de `bash`:

``` {data-enlighter-language=bash}
export PATH=~/vendimia/bin:$PATH
```

Si todo va bien, al ejecutar el comando `vendimia` deberá aparecerte algo como:

``` 
Vendimia Framework Administration utility script.
Version 0.0.1

Available modules:

     init       Create a new Vendimia project.
     new        Creates new elements for an existing Vendimia project, like apps.
     server     Run a stand-alone development server.
     shell      Starts a Vendimia evaluative PHP shell.
     syncdb     Syncronize table definitions from apps with the database.


Use vendimia [module] --help for more module information.
```

* Segundo, necesitamos indicar al sistema dónde ubicará _todo el framework_. Si has instalado el **Vendimia** dentro de un directorio listado en la directiva `include_path`, o dentro del directorio de tu proyecto, esto no será necesario.

Ejecuta esta instrucción en `bash`:

```
export VENDIMIA_BASE_PATH=~/vendimia
```

## Crear un nuevo proyecto

Crear un proyecto **Vendimia** es tan sencillo como ejecutar:

``` {data-enlighter-language=bash}
vendimia init miproyecto
```

Esto creará un directorio llamado `miproyecto` con la estructura base de un proyecto **Vendimia**. Para comprobar que todo esté bien, ejecuta un servidor de pruebas dentro de dicho directorio:

``` {data-enlighter-language=bash}
cd miproyecto
vendimia server
```

Luego, abre en tu navegador web la dirección [http://localhost:8888](http://localhost:8888), y deberás ver la pantalla de bienvenida de Vendimia. 

Ahora, continua con la [Parte 2](tutorial/part-2) de este tutorial.

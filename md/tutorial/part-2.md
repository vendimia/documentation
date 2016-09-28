title: Tutorial - Parte 2

# Parte 2 - ¡Hola Mundo!

¡Hola nuevamente! Esta es la 2da parte del tutorial de **Vendimia**. En la [primera parte](tutorial/part-1) instalamos el Vendimia y creamos nuestro primer proyecto. Ahora, vamos a examinar su estructura, y empezar a programar una acción.

## Estructura de un proyecto Vendimia

El nuevo proyecto Vendimia que hemos creado, `miproyecto` tiene la siguiente estructura:

```
miproyecto
├── apps
├── base
│   ├── assets
│   │   ├── css
│   │   ├── imgs
│   │   └── js
│   ├── controllers
│   ├── db
│   ├── forms
│   ├── libs
│   ├── models
│   ├── services
│   └── views
│       └── layouts
│           └── default.php
├── config
│   ├── routes.php
│   ├── settings.development.php
│   └── settings.php
├── index.php
├── static
│   └── assets
│       ├── css
│       ├── imgs
│       └── js
└── tmp
```

Estas son los directorios principales:

* `apps/`: Cada 'app' es un módulo independiente del proyecto, y tiene un directorio dentro de éste.
* `base/`: 'base' tiene la misma estructura que una aplicación. Aquí se guarda las cosas comunes para todas las apps.
* `config/`: Aquí está la configuración de todo el proyecto, asi como la configuración de las rutas de acceso de la URL.
* `tmp/`: Una carpeta temporal, usada mayormente por el servidor web de desarrollo.
* `static/`: Almacena los ficheros que serán enviados directamente al navegador web, como los javascripts, CSS e imágenes, entre otros. Este directorio puede estar separado del proyecto, de tal manera que el acceso público está lejos de los ficheros del proyecto en si.
* `index.php`: Es el fichero de inicio de la aplicación, o *bootstrapping*. Dentro se configura el *ambiente de desarrollo* activo, como por ejemplo 'development' o 'production'.
* `.htaccess`: Fichero de acceso por defecto para que el proyecto trabaje con el servidor web Apache.
* `.gitignore`: Fichero de configuración para que [Git](https://git-scm.com) (de usarse) ignore ciertos ficheros.

El núcleo de un proyecto en **Vendimia** son las *aplicaciones* ("apps"). Cada app es un módulo autocontenido y reusable. Para crear una app, ejecutamos el siguiente comando desde dentro de la carpeta del proyecto:

``` {.bash}
Vendimia new app noticias
```

Este script creará la siguiente estructura de directorio:

``` {.nohighlight}
└── apps
    └── noticias
        ├── assets
        │   ├── css
        │   ├── imgs
        │   └── js
        ├── controllers
        │   └── default.php
        ├── db
        ├── forms
        ├── models
        ├── services
        └── views
            ├── default.php
            └── layouts
```

<div class="notice">El script sólo crea la estructura de directorios, y un par de ficheros por defecto. Tu puedes crearlos manualmente si deseas, no es siempre necesario el script.</div>

## Modelo-Vista-Controlador

**Vendimia** trabaja usando la arquitectura Modelo-Vista-Controlador ("MVC"), que propone la separeción de una aplicación en tres partes interconectadas:

* El **modelo** es la parte central de una aplicación, quien procesa la información que recibe desde el controlador o desde otras fuentes. Vendimia proporciona al modelo las herramientas para que pueda interactuar fácilmente con una base de datos.
* La **vista** se encarga de mostrar la información al usuario. Es quien *decora* la información proveída por el modelo, y la retorna al usuario en varios formatos.
* El **controlador** es el nexo entre el modelo, la vista, y el usuario. El controlador recibe la petición web desde el navegador web, la envía al modelo, y el resultado del proceso lo pasa a la vista.

Ahora, cuando el navegador web hace una petición hacia un sitio web hecho en Vendimia, se ejecuta la siguiente secuencia:

``` {.nohighlight}
navegador -->-- controlador -->-- respuesta -->-- navegador
                   │  │
                ┌──┘  └──┐
                └─modelo─┘
```

La respuesta ('*response*') es usualmente la **vista**, pero puede ser otras cosas, como por ejemplo `JSON`. Eso lo veremos más adelante.

En la configuración por defecto de un proyecto **Vendimia**, para ejecutar un controlador desde el navegador, debes escribir la dirección web en el formato **`http://sitio.web/aplicación/controlador`**. Puedes también sólo especificar `http://sitio.web/aplicación`, en tal caso **Vendimia** ejecutará el controlador `default` de la aplicación `aplicación`.

En nuestro proyecto de prueba `miproyecto`, hemos creado una aplicación `noticias`, y el script ha creado un controlador llamado `default` (en el fichero `controllers/default.php`). Entonces, podemos acceder a nuestro nuevo controlador escribiendo en el navegador web (recuerdo ejecutar el servidor de desarrollo con `Vendimia server`):

``` {.nohighlight}
http://localhost:8888/noticias
```

Aparecerá el contenido de la vista `default` de la aplicación `noticias`, que por ahora es un saludo.

## Convenciones básicas de Vendimia

**Vendimia** simplifica el desarrollo de aplicaciones web usando ciertas convenciones en cuanto a nombres de ficheros, configuraciones, y otras cosas. Estas convenciones son flexibles, ya que uno puede no usarlas si así desea.

Por ejemplo, cuando se accede via una URL a una aplicación, y no se especifica el nombre del controlador, **Vendimia** ejecutará el controlador con nombre `default`, que debe estar guardado en el fichero `controllers/default.php` dentro de la aplicación.

En nuestro proyecto, el fichero recién creado `controllers/default.php` contiene lo siguiente:

``` {data-enlighter-language=php}
<?php
namespace noticias;

use Vendimia as V;

// Your code goes here.
```

Como ves, realiza *nada* :-) Al acabar la ejecución de un controlador, si no se especifica otra cosa, **Vendimia** buscará una vista *con el mismo nombre* que el controlador. En este caso, **Vendimia** mostrará el contenido del fichero `views/default.php`. Ese fichero contiene lo siguiente:

``` {data-enlighter-language=html}
<?php namespace noticias; use Vendimia as V, Vendimia\Html;?>

<!-- Delete this and the lines below, and write your own view. -->

<h1>Hi! I'm the <em>default</em> controller from <em>noticias</em> application!</h1>
<p>Now, edit the view file <strong>apps/noticias/views/default.php</strong> for 
changing this text, or the file <strong>apps/noticias/controllers/default.php</strong>
for changing the controller behavior.</p>
```

Esa es la información que aparece al ingresar a `http://localhost:8888/noticias`. Notarás que sólo está *el contenido* de la página HTML, lo que colocarías dentro del tag `<body>`, mas no la cabecera. Eso se define en los `layouts`, y lo veremos más adelante.

Además de buscar una vista con el mismo nombre que el controlador, **Vendimia** buscará *assets* con el mismo nombre de la vista. Un *asset* es un fichero de hoja de estilos o un script en javascript, que se guardan dentro de `assets/css` y `assets/js`, respectivamente. Ejemplo: si la vista se llama `mostrar`, **Vendimia** buscará y cargará un fichero llamado `assets/css/mostrar.css` y `assets/js/mostrar.js` automáticamente, si existen.

Si quieres rápidamente aplicar estilos la vista de nuestro ejemplo, crea un fichero `assets/css/default.css` y escríbelos ahí. Por ejemplo:

``` {data-enlighter-language=css}
body {
    font-family: sans-serif;
}
```

Graba el fichero, y recarga el sitio web `http://localhost:8888/noticias`. El tipo de letra ahora ha cambiado.

## Búsqueda de ficheros

Cuando **Vendimia** requiere un fichero, lo intenta ubicar en el siguiente órden:

1. Primero lo busca dentro del directorio de la aplicación actual.
2. Luego lo busca dentro del directorio `base/`.
3. El *autocargador* de clases busca también dentro del directorio `vendor/` en la raiz del proyecto, si existe.

Si **Vendimia** sigue sin ubicar el fichero, seguirá buscando el fichero  en las carpetas de la instalación de **Vendimia**,

Vamos a añadir el fichero `estilos_base.css` a la vistas de nuestra aplicación `noticias`, pero queremos podemos guardar el fichero en `base/assets/css/estilos_base.css`, y luego añadimos el siguiente código en la (o las) vista(s):

``` {data-enlighter-language=php}
$this->addCss('estilos_base');
```

<div class="notice">Ojo que estamos especificando sólo el nombre, sin la extensión. <code>addCss()</code> buscará un fichero con extensión <code>.css</code> guardado dentro del directorio <code>assets/css</code> en alguno de los lugares donde <strong>Vendimia</strong> lo pueda encontrar.</div>

**Vendimia** buscará ese CSS en las siguientes rutas:

* `apps/noticias/assets/css/estilos_base.css`
* `base/assets/css/estilos_base.css`


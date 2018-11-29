# POO-MVC
Programación orientada a objetos con la metodología modelo, vista y controlador.

### Descripción

Este es un proyecto en PHP utilizando la estructura modelo, vista y controlador, simula el funcionamiento de un foro básico.

### Requisitos

**La versión mostrada es con la que se desarrollo el proyecto**

* PHP **>=5.6**
* Composer **1.0**
* PHP Mailer **5.2**
* MySql **5.7**
* Ajax

### Estructura

* POO-MVC

 * content 		       `//contiene CSS, Scripts,entre otros elementos públicos`

 * core   		        `//núcleo de la pagina (programación en bruto)`

    * bin

        -> ajax

        -> functions    

    * controllers

    * models

    * core.php 	     `//oculto por motivos de seguridad`

 * html 			        `//vistas de la pagina (lo que ve el usuario)`

    * categorias

    * error

    * foros

    * index

    * layouts

    * perfil

    * public

    * temas

 * vendor 		       `//archivos de Composer (oculto por seguridad)`

 * ajax.php 		    `//determina las rutas de las peticiones ajax`
 * composer.json 	  `//contiene las librerías externas a utilizar`
 * index.php 		    `//determina la ruta de las peticiones HTML`



**Este proyecto es con fines demostrativos, la intención es simplemente mostrar los conocimientos que poseo.**


# APÚNTATE - Global Emergency

## Resumen
Apúntate es una aplicación enfocada en la gestión de los diferentes servicios disponibles dentro de una agrupación.

Permite a los participantes conocer las necesidades que tiene el servicio y las diferentes posiciones necesarias, así como apuntarse de manera rápida y fácil.

La información detallada, así como comentarios de los usuarios se puede encontrar en https://globalemergency.online/proyectos/apuntate/ 

### Objetivos

- Facilitar a los diferentes componentes de las agrupaciones, la gestión de los servicios que se ofrecen, así como la gestión de las necesidades.
- Ayudar a los diferentes gestores con las necesidades actuales, futuras así como los recursos disponibles.

## Colaboración

Cualquier aportación es bienvenida, por lo que te animamos a ayudarnos a evolucionar el proyecto.
Puedes simplemente dejarnos tus comentarios en la web del proyecto, abrir un issue, o simplemente subir tu PR justificando tu cambio o evolución y estaremos agradecidos de mencionar tus aportaciones.

### Colaboradores
- vgpastor
- tu?

## Stack tecnológico
Apúntate está formada por:
- Frontal en Angular con el objetivo de ser multidispositivo, lo que permite a los usuarios acceder desde cualquier dispositivo. El repositorio se encuentra en https://github.com/GlobalEmergency/apuntate-front
- Backend basado en symfony con bbdd mysql y pensado para trabajar con PHP 8. El repositorio está en https://github.com/GlobalEmergency/apuntate-back.

## Instalación y puesta en marcha
### Producción
- Descarga la última release tanto del back como del front.
- Instala el repositorio back en tu servidor y genera las nuevas claves JWT para garantizar la seguridad.
- Modifica la url del backend en el fichero de configuración del front para que las peticiones puedan llegar correctamente en https://github.com/GlobalEmergency/apuntate-front/blob/master/src/environments/environment.ts
- Genera los diferentes frontales que desees con Angular https://angular.io/cli/build

### Desarrollo
En el fichero INSTALL.md de cada repositorio encontrarás las instrucciones adicionales y detalladas.

## Licencia
MIT attached in LICENSE.md

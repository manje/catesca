# catesca: Software de participación

Este es el software desarrollado para la plataforma de participación de Ganemos Jerez.

Está siendo usado en producción en Ganemos Jerez pero muchas de sus funcionalidades están aún en desarrollo.

info@ganemosjerez.es

## Funcionalidades

### Colaboradores

Los usuarios pueden rellenar una ficha donde muestran sus habilidades e inquietudes.

### Comisiones

Los usuarios pueden ser agregados a una comisión.

### Verificación de identidad

Sistema de verificaciones de identidad para poder garantizar que nadie puede votar dos veces, teniendo que acudir el usuario a un lugar físico con su documento de identidad (DNI o permiso de residencia).

### Herramientas de participación

90% implementado: Sistema de voto, simple, Borda y VUT.
NO IMPLEMENTADO: Grupo de trabajo, grupo de expertos, punto del día en una asamblea, DAFOs, lluvias de ideas...

Las Herramientas pueden estar vinculadas a un proceso de participación o crearse indvidualmente para una comisión, para los miembros de cualquier comisión o ser abiertas.

### Iniciativas

Los usuarios pueden enviar iniciativas, que el resto de usuarios pueden votar a favor o en contra, las iniciativas se dividen en distintas categorías, algunas categorías pueden ser privadas solo para miembros de la organización (que pertenecen a alguna comisión)

### Procesos de participación

NO IMPLEMENTADO

Una Iniciativa cuando tiene los suficientes apoyos se convierte en un proceso de participación, que no es más que la sucesión de distintas herramientas de participación.

## Instalación

Descargar todos los ficheros, hacer accesible la carpeta html como la raiz del dominio web.
Crear un archivo config.php , hay un archivo de ejemplo config-dist.php , configura al menos la base de datos.
Incluya en la base de datos mysql el dump que hay en el fichero sql

Cree la siguiente estructura de directorios vacios con permisos de escritura.

smarty/
smarty/cache
smarty/templates_c
smarty/templates_c/js
smarty/templates_c/default
smarty/configs

Ejecutar el script "descargar", que descargará un par de librerías de PHP

## Configuración

Una vez hecha la instalación el primer usuarios registrado sera administrador del sitio, a partir de entonces para poder usar todas las funcionalidades debe acceder a unos módlos para configurar la herramienta, no hay menu para estas operaciones pero se pueden acceder a través de las siguientes urls:

/adminusuarios/admin/ : Gestionar administradores del sitio

/comisiones/ : Para crear las distintas comisiones y añadir administradores a ella

/categorias/ : Para crear las distintas categorias para las iniciativas.

/adminusuarios/presencial/ : Para habilitar a usarios a hacer la verificación de DNI





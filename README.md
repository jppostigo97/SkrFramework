# Skr Framework

## Introducción
Skr es un framework MVC ligero y multipropósito para PHP con el cual se pueden desarrollar aplicaciones complejas en un abrir y cerrar de ojos.

Skr te facilita las cosas de la mejor forma: sin dejar lugar a curvas de aprendizaje. Todas sus funcionalidades son sencillas de comprender, utilizar y dominar.

### Características
- Desarrolla ágilmente gracias al patrón MVC
- Sistema de plantillas integrado `(WIP)`
- Advierte e informa al usuario mediante el sistema de errores y debugging. `(WIP)`
- Y mucho más... `(WIP)`

## Como empezar
### 1. Configurar el 
- **APP_PATH**: Se encuentra en *index.php* e indica la ruta de la aplicación web. Su valor debe ser modificado para que coincida con la ruta base de tu aplicación (por ejemplo, https://github.com, https://www.google.com).
- **DEBUG**: Indica si la aplicación está en proceso debugging y determina si los errores a nivel de desarrollo aparecerán o no. Está en el archivo *config.php* (igual que todas las configuraciones de ahora en adelante).
- **$title**: El título por defecto de la aplicación web. Puede modificarse con title("Nuevo título") u obtenerse con title().
- **date\_format**, **time\_format** y **date\_time\_format**: Indican el formato predeterminado de la fecha, la hora y la fecha y hora en conjunto, respectivamente.
- **db\_host**, **db\_name**, **db\_user** y **db\_pass**: Configuran el acceso a la base de datos.
- **controller\_path**, **helper\_path**, **model\_path**, **template\_path** y **view\_path**: Indican las rutas relativas a la raíz de la aplicación de los *controladores, helpers, modelos, plantillas y vistas*, respectivamente.

### 2. Crear modelos
#### Crear el modelo
El manejo de modelos en Skr es extremadamente simple. Para crear uno, solo tienes que crear un archivo dentro de la carpeta de modelos. El nombre del archivo debe ser el mismo que el nombre de su análogo en forma de tabla en la base de datos, en minúscula (por ejmplo, *user.php*, *post.php*, etc).
Dentro del nuevo archivo, hay que crear una clase con el mismo nombre que el archivo, escrito en UpperCamelCase (esta clase debe extender de *Model*).

#### Cargar el modelo
Listo. Tu modelo ha sido creado. Simple, ¿verdad? Prueba a cargarlo con la función *load_model("model_name")*. Esta función devuelve una instancia del modelo, así que podrás utilizarlo desde el momento en que lo cargues. Además, ahora puedes aplicar los métodos *add*, *delete*, *find* y *update* al modelo que acabas de crear o escribir tú mismo algunos métodos que puedan resultarte útiles.

#### Métodos estáticos en la clase *Model*
La clase *Model* tiene dos métodos estáticos: *encode* y *decode*.

El método *encode* se utiliza para codificar caracteres maliciosos para una base de datos, tales como las \", \', ; ó #. 

Por otro lado, el método *decode* se utiliza para decodificar el mismo tipo de caracteres codificados por su hermano *encode*, además de para mostrar correctamente los caracteres HTML.

### 3. Crear controladores
Los controladores son una parte fundamental. Son éstos quienes dan nombre a las rutas de la aplicación y quienes definen el comportamiento de la misma en cualquier caso.

#### Crear el controlador
Crear un controlador es tan sencillo como crear un modelo: simplemente crea un nuevo archivo dentro de la carpeta de controladores, cuyo nombre sea `NombreDelControladorController.php`, y dentro del mismo, crear una clase con el mismo nombre que el archivo (obviamente sin extensión) y que herede de la clase *Controller*. Siguiendo estos sencillos pasos ya has creado un controlador básico.

#### Añadiendo métodos al controlador
Los controladores están bien. Definen el comportamiento y las rutas de tu aplicación, pero les falta algo: funcionalidad. Si no hacen nada, son solo un desperdicio de espacio en nuestra unidad de almacenamiento. Como no queremos eso, vamos a añadirle algunas funciones a nuestro controlador; pero antes hay que saber como funcionan las rutas de Skr.

Supongamos que tenemos una aplicación y una de sus rutas es la siguiente: `http://www.miaplicación.com/:controlador/:metodo/:param1/:param2...`
Donde *:controlador* es el nombre de nuestro controlador (sin la palabra *controller*), *:metodo* es el nombre de nuestro método, y *:param1* y *:param2* son dos parámetros en nuestra URL. Todo se resume en que el primer parámetro en la URL es el controlador, el segundo el método y el resto son parámetros.

Dentro de los métodos de los controladores, tenemos la libertad de utilizar la lógica que más nos convenga. Los métodos en los controladores deben ser *públicos*.

### 4. Vistas y plantillas
Las vistas son una parte importante en nuestras aplicaciones (tanto que es donde se muestran los datos a los usuarios). Por ello, Skr tiene un sistema de plantillas que facilitará la creación y gestión de las vistas.

#### 4.1. Plantillas
Las plantillas son la base de nuestras vistas. Éstas describen la estructura básica de la página que será utilizada múltiples veces. En la plantilla, se sustituirá la cadena de caracteres `[[ skrcontent ]]` por el contenido real de la página, como bien se muestra en la plantilla de ejemplo que incluye Skr. Para seleccionar una plantilla, se llama al método estático `View::layout("layout_name")` donde *layout_name* es el nombre del archivo de la plantilla (sin extensión) dentro de la carpeta de plantillas.

#### 4.2. Vistas
Las vistas son los trozos de nuestra aplicación que muestran al usuario los datos. Éstas reciben parámetros en forma de array asociativo, los cuales se muestran desde la vista escribiendo `[[ param_name ]]` donde *param_name* es el nombre del parámetro a mostrar. Para incluir el contenido de una vista, se utiliza el método estático `View::load("view_name", params = [])` donde *view_name* es el nombre del archivo de la vista (sin extensión) dentro de la carpeta de vistas, y *params* un array asociativo que contiene el nombre y el valor de los parámetros que recibirá la vista cargada.

Cabe destacar que, tanto en las plantillas como en las vistas, tenemos la posibilidad de incluir código PHP.

### 5. Helpers (asistentes)
Los *helpers* o asistentes son clases que ayudan al desarrollo de una aplicación. Los helpers contienen métodos que serán utilizado mútliples veces, con el fin de modularizar nuestra aplicación y hacerla más accesible.

#### Crear y cargar un helper
Crear un helper es también sencillo. Solo necesitas un archivo con el nombre `test_helper.php`, y tener dentro de ese archivo la clase `TestHelper`, la cual hereda de *Helper*. Sabiendo que `test` es el nombre de tu asistente. Hecho ésto, solo queda añadirle constantes, variables y métodos para que el asistente nos resulte útil.

Para cargar un helper, se utiliza la función `load_helper("test")`, donde *test* es el nombre de nuestro helper. Esta función devuelve una instancia creada de nuestro asistente listo para ser utilizado.

## Funciones globales
Las funciones globales existen para facilitar la vida, como todo en Skr. Éstas tienen un propósito general. Son las siguientes:

- **display_error**: Muestra el error (si es que existe) con el identificador que se le pasa como parámetro.

- **error**: Lanza un error. Recibe tres parámetros: identificador, título del error y cuerpo del mensaje de error.

- **link\_css** y **link\_script**: Incluyen un archivo de hoja de estilos css o un script js. Ambos reciben dos parámetros: el nombre del archivo (sin extensión) localizado en su correspondiente carpeta y un array asociativo que equivale a los atributos de las etiquetas \<link\> y \<script\>, respectivamente.

- **link_to**: Crea un hiperenlace para mostrarlo en la vista. Recibe tres parámetros: enlace dentro de la aplicación (en la forma `controlador/metodo/par1/...`), la etiqueta (el texto a mostrar como enlace) y un array asociativo que se corresponde con los atributos de la etiqueta \<a\>.

- **forbid\_login** y **require\_login**: Prohiben o solicitan al usuario tener una sesión iniciada en la aplicación, respectivamente. Si las condiciones que una de estas funciones no se cumple, se realizará una *redirección forzada* a la página principal de la aplicación.

- **force\_redirect**: Fuerza una redirección a una ruta dentro de la aplicación.

- **parse\_datetime**: Parsea fecha y/u hora. Recibe dos parámetros: el formato al que parsear y la fecha/hora que se dispone a parsear.

- **title**: Esta función devuelve el título de la aplicación si no recibe parámetros. Si recibe como parámetro una cadena de caractéres, modificará el título de la aplicación a esa misma cadena de caracteres.

Descripción del tema elegido:
El proyecto es una encuesta simple sobre comida favorita, desarrollada
en PHP sin base de datos. Los usuarios pueden seleccionar su opción
preferida y el sistema guarda los votos en un archivo JSON. La interfaz
utiliza Bootstrap.

Cómo ejecutar el proyecto:
1.Descargar o copiar el repositorio.
2.Abrir la carpeta del proyecto en tu servidor local.
3.Asegurate de que la estructura del proyecto sea:
TP-ENCUESTAONLINE/
    assets/
        boostrap.min.css
    clases/
        Encuesta.php
    data/
        data.json
    includes/
        footer.php
        header.php
    index.php

4.Abrir en el navegador: localhost/TP-EncuetaOnline
5.El archivo data/data.json debe tener permisos de escritura para que
se pueda guardar la encuesta.

Qué funciones, arrays y clases implementé:
Funciones:
- loadData(): Carga los votos desde el archivo data.json.
- saveData($data): Guarda el array actualizado con los votos.
- processVote($option): Incrementa el contador de votos.
- printResults($data): Muestra los resultados en pantalla.

Arrays:
- Array asociativo para almacenar votos: Pizza, pasta, milanesa, lomito, empanadas, 
arroz integral, ensalada, sanguchito de miga
- Array para inicializar el archivo JSON (si está vacío).
- Array recibido vía POST desde el formulario.

Clases:
implementé la clase Survey en la carpeta /classes: 
Métodos usados:
__construct($filePath): Indica qué archivo JSON usar.
getResults(): Devuelve los resultados actuales.
vote(option): Suma un voto a la opción elegida. 
save(): Guarda los resultados en JSON.

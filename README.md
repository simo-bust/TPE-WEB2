# Libreria

### Integrantes: 
+ Simón Bustamante (46.353.537)
+ Valentino Sabbattini (45.542.165)

### Descripcion
Elegimos realizar una base de datos de una libreria. Esta va a constar inicialmente de tres tablas: 
- Libro, la cual contiene un id de tipo clave primaria auto incremental; un titulo de tipo varchar; autor de tipo varchar; genero del libro de tipo varchar; un precio de tipo integer, una descripcion tipo text yuna ID_Editorial usada como clave foranea (existe una columna de imagen, que no llegamos a implementar la funcion de agregado via form, pero si llegamos a implementar que los libros ya ingresados tuvieran una imagen por numero de id). 
- Editorial, es la segunda tabla que se relaciona con la tabla de libro a traves de su clave foranea ID_Libro. Tambien cuenta con su id de tipo clave primaria auto incremental; un nombre de tipo varchar y un pais de origen de tipo varchar.
- Usuario, es la tercera tabla que posee los datos del usuario administrador que tiene permisos para modificar el contenido de la pagina (agregar, eliminar y editar libros). (nombre de usuario: webadmin / contraseña: admin).

Para desplegar el sitio de manera debida, se necesita tener el programa XAMPP instalado. Despues, abrir la carpeta htdocs y abrir Git Bash para clonar el repositorio. Luego, se debe iniciar los servicios Apache y MySQL desde el panel de control de XAMPP.
Para ingresar a la pagina web se debe acceder al localhost desde el navegador(colocar la url: localhost/tpe2).
La base de datos se debe importar en phpmyadmin solo creando una base de datos vacia solo con el nombre correspondiente (en este caso nuestra base se llama: libreria_tudai.sql).

![image](![image](https://github.com/user-attachments/assets/3d17949b-fc04-48d3-9197-dd2208504745)
)

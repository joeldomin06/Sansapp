# Sansapp
Joel Dominguez N. 201973500-4
Pablo Estobar F. 201973615-9

Se utilizo la aplicacion XAMPP v3.3.0

Como usar la base de datos:

- Luego de haber instalado XAMPP,se inicia la aplicación, primero apache y luego mysql.

- Se presiona el botón que dice admin en el apartado de mysql para acceder al entorno de phpmyadmin.

- Estando ya en el entorno, se crea una nueva conexión con el nombre: SansApp, 
utilizando como conjuto de caracteres del archivo: utf8

- Dentro de esta conexión se importa el archivo de .sql ubicado en la carpeta BD.



Como ingresar a la página local:

- De la carpeta llamada PHP se debe mover la carpeta Sansapp (la cual contiene los archivos .php y complementos).

- Este movimiento es realizado hacia el lugar de instalación de XAMPP, dentro de la carpeta htdocs.

- Con todo esto realizado sigue el paso para ingresar a la página local con el siguiente enlace: localhost/Sansapp


Consideraciones especiales:

- Para todas las casillas de tipo input se ha realizado expresiones regulares, por lo que es necesario seguir el formato dado en el ejemplo.

- Un usuario sin sesión iniciada, no tiene permisos para comprar, calificar, comentar ni vender, solo podrá ver los detalles de los productos, comentarios realizados por otros y relizar los distintos tipos de búsqueda.

- Una vez presionado el botón de compra en el carro de compra, esta se concreta, por lo que el carro se verá vacío, pero los productos comprados aparecerán en el historial de compra y venta.

- Un producto eliminado es representado con su stock = 0, por lo que solo podrá verlo el usuario que vende el producto (para añadir stock) y los usuarios que lo contengan en su historial de compra.

- Un usuario eliminado es representado con su contraseña nula, por lo que no podrá reingresar a su cuenta. Sus productos serán eliminados y los usuarios no podrán verlos, pero existirán en la base de datos para casos donde un usuario quiera ver en su historial sobre quién le vendió y que producto era si este ya no existe.

- Siguiendo lo anterior, el usuario eliminado no se puede volver a registrar ni arreglar su contraseña nula (a menos que se haga desde la base de datos).

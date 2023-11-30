Joel Dominguez N. 201973500-4
Pablo Estobar F. 201973615-9

Se utilizo la aplicacion XAMPP v3.3.0

Como usar la base de datos:

- Luego de haber instalado XAMPP,se inicia la aplicaci�n, primero apache y luego mysql.

- Se presiona el bot�n que dice admin en el apartado de mysql para acceder al entorno de phpmyadmin.

- Estando ya en el entorno, se crea una nueva conexi�n con el nombre: SansApp, 
utilizando como conjuto de caracteres del archivo: utf8

- Dentro de esta conexi�n se importa el archivo de .sql ubicado en la carpeta BD.



Como ingresar a la p�gina local:

- De la carpeta llamada PHP se debe mover la carpeta Sansapp (la cual contiene los archivos .php y complementos).

- Este movimiento es realizado hacia el lugar de instalaci�n de XAMPP, dentro de la carpeta htdocs.

- Con todo esto realizado sigue el paso para ingresar a la p�gina local con el siguiente enlace: localhost/Sansapp


Consideraciones especiales:

- Para todas las casillas de tipo input se ha realizado expresiones regulares, por lo que es necesario seguir el formato dado en el ejemplo.

- Un usuario sin sesi�n iniciada, no tiene permisos para comprar, calificar, comentar ni vender, solo podr� ver los detalles de los productos, comentarios realizados por otros y relizar los distintos tipos de b�squeda.

- Una vez presionado el bot�n de compra en el carro de compra, esta se concreta, por lo que el carro se ver� vac�o, pero los productos comprados aparecer�n en el historial de compra y venta.

- Un producto eliminado es representado con su stock = 0, por lo que solo podr� verlo el usuario que vende el producto (para a�adir stock) y los usuarios que lo contengan en su historial de compra.

- Un usuario eliminado es representado con su contrase�a nula, por lo que no podr� reingresar a su cuenta. Sus productos ser�n eliminados y los usuarios no podr�n verlos, pero existir�n en la base de datos para casos donde un usuario quiera ver en su historial sobre qui�n le vendi� y que producto era si este ya no existe.

- Siguiendo lo anterior, el usuario eliminado no se puede volver a registrar ni arreglar su contrase�a nula (a menos que se haga desde la base de datos).


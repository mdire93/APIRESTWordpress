# Instrucciones de conexión  
Se debe importar el archivo **bdd_aiudo.sql** en phpmyadmin (Este archivo esta guardado en la raiz).

**Este proyecto usa la versión php 8.0.10**.

Es necesario ejecutar el comando **composer update**.(**Sobre la carpeta que contiene el proyecto**)

Una vez hayamos echo esto e importado la base de datos podermos ejecutar el comando **symfony serve** (**Sobre la carpeta que contiene el proyecto**)
Cuando el proyecto este arrancado debemos importar los archivos **.json** (Guardado en la raíz) en el sotfware **POSTMAN**, en el están guardadas todas las rutas necesarias para comprobar que todo funciona correctamente y el enviroment para crear la sesión.
**La credencial para la sesión se obtendrá cuando el cliente haga login (La tenemos que copiar en initial value, en el sotware postman (enviroments) y activar el enviroment)**

# Información sobre el proyecto
Esta API REST simula un sistema bancario al que solo pueden acceder usuarios logeados.
Los clientes (usuarios logeados) pueden ver los préstamos disponibles, ver los préstamos que ha solicitado y ver los movimientos de sus cuentas bancarias.
Además, los clientes pueden pedir préstamos y devolverlos.
Cuando un cliente pide un préstamo se genera un "ingreso" y cuando el cliente decide devolver un préstamo se genera un "pago", quedando ambos reflejados en la base de datos.

### Documentación de la Api: https://app.swaggerhub.com/apis/dfnf/DocumentacionAPI/1.0.0#/
### Usuarios de la API
	usuario: mdire pass: admin93
	usuario pep pass: admin93 


## Tablas 
#### Clientes : Tabla que almacena los datos de cada cliente
	- id: Clave primaria. Id del cliente
	- usuario: Usuario del cliente
	- nombre: Nombre del cliente 
	- apellidos: Apellidos del cliente
	- pass: Contraseña de acceso del cliente
	- credencial: Clave de sesion del cliente
	
#### Cuentacliente: Tabla que relacciona a cada cliente con una cuenta. Cuando se creó esta tabla se pensó en que varios clientes pueden compartir una misma cuenta.
	- id: Clave primaria.
	- id_cuenta
	- id_cliente: Id del cliente que tiene acceso a la cuenta
al que pertenece la cuenta
#### Prestamos: Tabla que almacena los datos de los préstamos disponibles para solcitar 
	- id: Clave primaria 
	- nombre: Nombre del préstamo
	- cantidad: Cantidad en € del préstamo
	- tae: TAE del préstamo 
	- duración: Durante cuanto tiempo te dan el prestamo 
	- devolver: Cantidad a de
#### Cuentas: Tabla que almacena los datos de todas las cuentas que tienen los clientes
	- id: Clave primaria.
	- cuenta: Cuenta del cliente. Contiene números y letras.
	- titular: Id del cliente 
#### Historialpagos: Tabla que contiene los movimientos (pagos e ingresos) de cada cuenta 
	- id: Clave primaria 
	- id_cuenta
	- id_cuentacliente
	- cantidad: Cantidad de dinero del pago
	- fecha: Fecha del pago
	- opercion: Tipo de operación (Transferencia o ingreso)
#### Prestamocliente: Tabla que relacciona un préstamo con un cliente 
	- id: Clave primaria 
	- id_prestamo
	- id_cliente



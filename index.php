<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo "CREATE DATABASE pbd_contacts;<br>";

echo "CREATE TABLE IF NOT EXISTS pbd_contacts.contact (<br>";
echo "id int(10) NOT NULL auto_increment,<br>";
echo "nombre varchar(50) default NULL,<br>";
echo "apellido1 varchar(50) default NULL,<br>";
echo "apellido2 varchar(50) default NULL,<br>";
echo "telefono varchar(9) default NULL,<br>";
echo "email varchar(50) default NULL,<br>";
echo "imagen varchar(150) default NULL,<br>";
echo "PRIMARY KEY (id)<br>";
echo ");<br>";

echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Pablo','Iglesias','Turrion','684528355','coletamorada@podemos.es','".$actual_link."pablo.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Pedro','Sanchez','Perez-Castejon','632542587','pdrosnchez@psoe.es','".$actual_link."pedro.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Mariano','Rajoy','Brey','632145255','todoescierto@salvoalgunascosillas.es','".$actual_link."mariano.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Albert','Rivera','Diaz','687258542','soyellider@ciutadans.es','".$actual_link."albert.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Sergio','Casero','Hernandez','600000000','scaseroh@alumnos.unex.es','".$actual_link."sergio.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Jacobo','Conejo','Lima','699999999','jconejol@alumnos.unex.es','".$actual_link."jacobo.jpg');<br>";
echo "INSERT INTO pbd_contacts.contact (nombre,apellido1,apellido2,telefono,email,imagen) VALUES('Enrique','Pastor','Cisneros','655555555','epastorc@alumnos.unex.es','".$actual_link."enrique.jpg');<br>";
?>
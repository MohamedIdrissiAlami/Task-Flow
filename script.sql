create database TaskFlow;

use TaskFlow;
 
 create table AssignedTo(
 	UserID int PRIMARY key AUTO_INCREMENT,
     Name varchar(50) not null
 
 );
 
 CREATE table Task(
 	TaskID int PRIMARY key AUTO_INCREMENT,
     Title varchar(100) not null,
     Description varchar(255) null,
     type varchar(50) not null DEFAULT('basic'),
     UserID int not null,
     Status varchar(100) not null DEFAULT('pending'),
     FOREIGN key (UserID) REFERENCES AssignedTo(UserID)

 );
 
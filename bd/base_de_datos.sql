create database CECyTEDB;
use CECyTEDB;

create table Tutor (
	id int primary key AUTO_INCREMENT,
	name varchar(20) not null,
	last_name_p varchar(20) not null,
	last_name_m varchar(20),
	tel_home varchar(15) not null,
	tel_personal varchar(15) not null
);

create table Rol (
	id int primary key AUTO_INCREMENT,
	name varchar(20) not null
);

create table Especialities (
	id int primary key AUTO_INCREMENT,
	name varchar(20) not null
);

create table User (
	id int primary key AUTO_INCREMENT,
	barcode varchar(20) not null,
	tutor_id int,
	speciality_id int,
	rol_id int,
	user_name varchar(20),
	password varchar(30),
	name varchar(20) not null,
	last_name_p varchar(20) not null,
	last_name_m varchar(20),
	FOREIGN KEY (tutor_id) references Tutor(id),
	FOREIGN KEY (speciality_id) references Especialities(id),
	FOREIGN KEY (rol_id) references Rol(id)
);

create table Asistences (
	id int primary key AUTO_INCREMENT,
	user_id int,
	date_capture datetime,
	FOREIGN KEY (user_id) references User(id)
);
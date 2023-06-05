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
	barcode varchar(20),
	tutor_id int,
	speciality_id int,
	rol_id int,
	user_name varchar(20) null,
	password varchar(60) null,
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

create table config_semester (
	id int primary key AUTO_INCREMENT,
	name varchar(50) not null,
	initial_day_semester date not null,
	final_day_semester date not null
);

create table non_working_days (
	id int primary key AUTO_INCREMENT,
	day date
);
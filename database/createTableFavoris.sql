
drop database if exists favoris_itunes;
create database favoris_itunes;

\c favoris_itunes

create table Utilisateur (
	userId SERIAL,
	login VARCHAR(350),
	password VARCHAR(350),
	primary key (userId)
);

create table Favoris (
	userId int,
	trackId int,
	genre VARCHAR(30),
	primary key (userId, trackId)
);

insert into utilisateur (login, password) values ('admin', 'admin');


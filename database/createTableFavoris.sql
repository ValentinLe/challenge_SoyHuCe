
drop database if exists favoris_itunes;
create database favoris_itunes;

\c favoris_itunes

-- SERIAL = INT AUTO INCREMENT c'est mieux pour PostgreSQL
create table Utilisateur (
	userId SERIAL,
	login VARCHAR(350),
	password VARCHAR(350),
	primary key (userId),
	unique(login)
);

create table Favoris (
	userId int,
	trackId int,
	type VARCHAR(30),
	primary key (userId,trackId)
);

/*
ajout =>
	login : admin
	password : admin
*/
insert into utilisateur (login, password) values ('admin', '$2y$10$lGwOSByZzPtlTE5VtUvS6O5yDHf3I1XnkfGD7dzOfbzhBWGs4eoZG ');


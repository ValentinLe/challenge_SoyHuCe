create database favoris_itunes;
\c favoris_itunes
create table Favoris (
	trackId int constraint trackId primary key,
	titre VARCHAR(250),
	genre VARCHAR(30)
);

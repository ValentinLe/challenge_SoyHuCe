create database favoris_itunes;
\c favoris_itunes
create table Favoris (
	trackId int constraint trackId primary key,
	genre VARCHAR(30)
);

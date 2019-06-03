DROP DATABASE IF EXISTS projekt;
CREATE DATABASE projekt DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE projekt;

CREATE TABLE `nieaktywne_uslugi` (
  `id_nieaktywnej_uslugi` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_uslugi` int(11),
  `data_poczatkowa` date,
  `data_koncowa` date,
  `id_pakietu` int(11),
  `id_serwera` int(11)
);

CREATE TABLE `pakiety` (
  `id_pakietu` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(16),
  `wartosc` int(11),
  `max_pamiec` int(11)
);

CREATE TABLE `posiadane_uslugi` (
  `id_posiadania` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11),
  `id_uslugi` int(11)
);

CREATE TABLE `powiadomienia` (
  `id_powiadomienia` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `tytul` varchar(50),
  `tresc` varchar(256),
  `data` date,
  `id_uzytkownika` int(11)
);

CREATE TABLE `rodzaj_konta` (
  `id_rodzaju` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(16)
);

CREATE TABLE `rodzaj_serwera` (
  `id_rodzaju` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nazwa_rodzaju` varchar(16)
);

CREATE TABLE `serwery` (
  `id_serwera` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pojemnosc` int(11),
  `zajeta_pamiec` int(11),
  `id_rodzaju` int(11)
);

CREATE TABLE `uslugi` (
  `id_uslugi` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `zajeta_pamiec` int(11),
  `data_poczatkowa` date,
  `data_koncowa` date,
  `id_pakietu` int(11),
  `id_serwera` int(11)
);

CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `login` varchar(16),
  `haslo` varchar(16),
  `imie` varchar(20),
  `nazwisko` varchar(25),
  `email` varchar(50),
  `telefon` int(15),
  `data_dolaczenia` date,
  `id_rodzaju` int(11)
);

/*
ALTER TABLE `nieaktywne_uslugi`
  ADD PRIMARY KEY (`id_nieaktywnej_uslugi`);

ALTER TABLE `pakiety`
  ADD PRIMARY KEY (`id_pakietu`);

ALTER TABLE `posiadane_uslugi`
  ADD PRIMARY KEY (`id_posiadania`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_uslugi` (`id_uslugi`);

ALTER TABLE `powiadomienia`
  ADD PRIMARY KEY (`id_powiadomienia`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

ALTER TABLE `rodzaj_konta`
  ADD PRIMARY KEY (`id_rodzaju`);

ALTER TABLE `rodzaj_serwera`
  ADD PRIMARY KEY (`id_rodzaju`);

ALTER TABLE `serwery`
  ADD PRIMARY KEY (`id_serwera`),
  ADD KEY `id_rodzaju` (`id_rodzaju`);

ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id_uslugi`),
  ADD KEY `id_pakietu` (`id_pakietu`),
  ADD KEY `id_serwera` (`id_serwera`);

ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`),
  ADD KEY `id_rodzaju` (`id_rodzaju`);
  */

ALTER TABLE `posiadane_uslugi`
  ADD FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`),
  ADD FOREIGN KEY (`id_uslugi`) REFERENCES `uslugi` (`id_uslugi`);

ALTER TABLE `powiadomienia`
  ADD FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`);

ALTER TABLE `serwery`
  ADD FOREIGN KEY (`id_rodzaju`) REFERENCES `rodzaj_serwera` (`id_rodzaju`);

ALTER TABLE `uslugi`
  ADD FOREIGN KEY (`id_pakietu`) REFERENCES `pakiety` (`id_pakietu`),
  ADD FOREIGN KEY (`id_serwera`) REFERENCES `serwery` (`id_serwera`);

ALTER TABLE `uzytkownicy`
  ADD FOREIGN KEY (`id_rodzaju`) REFERENCES `rodzaj_konta` (`id_rodzaju`);


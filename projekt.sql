-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Cze 2019, 09:34
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nieaktywne_uslugi`
--

CREATE TABLE `nieaktywne_uslugi` (
  `id_nieaktywnej_uslugi` int(11) NOT NULL,
  `id_uslugi` int(11) NOT NULL,
  `data_poczatkowa` date NOT NULL,
  `data_koncowa` date NOT NULL,
  `id_pakietu` int(11) NOT NULL,
  `id_serwera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `nieaktywne_uslugi`
--

INSERT INTO `nieaktywne_uslugi` (`id_nieaktywnej_uslugi`, `id_uslugi`, `data_poczatkowa`, `data_koncowa`, `id_pakietu`, `id_serwera`) VALUES
(7, 29, '2019-05-01', '2019-05-29', 1, 1),
(8, 30, '2019-05-01', '2019-05-29', 1, 1),
(9, 31, '2019-05-27', '2019-05-28', 1, 1),
(10, 33, '2019-06-02', '2019-07-02', 1, 1),
(11, 34, '2019-06-02', '2019-07-02', 1, 1),
(12, 35, '2019-06-02', '2019-07-02', 1, 1),
(13, 36, '2019-06-02', '2019-07-02', 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pakiety`
--

CREATE TABLE `pakiety` (
  `id_pakietu` int(11) NOT NULL,
  `nazwa` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `wartosc` int(11) DEFAULT NULL,
  `max_pamiec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pakiety`
--

INSERT INTO `pakiety` (`id_pakietu`, `nazwa`, `wartosc`, `max_pamiec`) VALUES
(1, 'premium', 50, 10000),
(2, 'standard', 15, 50000),
(3, 'medium', 20, 50000),
(4, 'JAKIS', 500, 300000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posiadane_uslugi`
--

CREATE TABLE `posiadane_uslugi` (
  `id_posiadania` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_uslugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posiadane_uslugi`
--

INSERT INTO `posiadane_uslugi` (`id_posiadania`, `id_uzytkownika`, `id_uslugi`) VALUES
(33, 5, 37);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `powiadomienia`
--

CREATE TABLE `powiadomienia` (
  `id_powiadomienia` int(11) UNSIGNED NOT NULL,
  `tytul` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `tresc` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `id_uzytkownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `powiadomienia`
--

INSERT INTO `powiadomienia` (`id_powiadomienia`, `tytul`, `tresc`, `data`, `id_uzytkownika`) VALUES
(1, 'Zbliżający się termin!', 'Twoja usługa o ID 30 zakończyła się 2019-06-01 18:54:42', '2019-06-01', 5),
(2, 'Zakończenie usługi', 'Twoja usługa o ID 31 zakończyła się!', '2019-06-01', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_konta`
--

CREATE TABLE `rodzaj_konta` (
  `id_rodzaju` int(11) NOT NULL,
  `nazwa` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rodzaj_konta`
--

INSERT INTO `rodzaj_konta` (`id_rodzaju`, `nazwa`) VALUES
(1, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_serwera`
--

CREATE TABLE `rodzaj_serwera` (
  `id_rodzaju` int(11) NOT NULL,
  `nazwa_rodzaju` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rodzaj_serwera`
--

INSERT INTO `rodzaj_serwera` (`id_rodzaju`, `nazwa_rodzaju`) VALUES
(1, 'games'),
(2, 'www');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwery`
--

CREATE TABLE `serwery` (
  `id_serwera` int(11) NOT NULL,
  `pojemnosc` int(11) DEFAULT NULL,
  `zajeta_pamiec` int(11) NOT NULL,
  `id_rodzaju` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `serwery`
--

INSERT INTO `serwery` (`id_serwera`, `pojemnosc`, `zajeta_pamiec`, `id_rodzaju`) VALUES
(1, 1000000, 50000, 1),
(2, 1000000, 0, 1),
(3, 1000000, 0, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id_uslugi` int(11) NOT NULL,
  `zajeta_pamiec` int(11) NOT NULL,
  `data_poczatkowa` date DEFAULT NULL,
  `data_koncowa` date DEFAULT NULL,
  `id_pakietu` int(11) DEFAULT NULL,
  `id_serwera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uslugi`
--

INSERT INTO `uslugi` (`id_uslugi`, `zajeta_pamiec`, `data_poczatkowa`, `data_koncowa`, `id_pakietu`, `id_serwera`) VALUES
(37, 0, '2019-06-02', '2019-07-02', 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(11) NOT NULL,
  `login` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `telefon` int(15) DEFAULT NULL,
  `data_dolaczenia` date NOT NULL,
  `id_rodzaju` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownika`, `login`, `haslo`, `imie`, `nazwisko`, `email`, `telefon`, `data_dolaczenia`, `id_rodzaju`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@admin.pl', 0, '2019-05-07', 1),
(4, 'dsa', 'lal', 'dpsa', 'dsada', 'dsada@wp.pl', 123123123, '2019-04-04', 3),
(5, 'pat', 'lolek123', 'Patryk', 'Wolski', 'wolakv2@gmail.com', 537881604, '2019-05-16', 3),
(9, 'ghotka', 'dlbinumv', 'pau', 'lina', '09510@wp.pl', 506568833, '2019-05-16', 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `nieaktywne_uslugi`
--
ALTER TABLE `nieaktywne_uslugi`
  ADD PRIMARY KEY (`id_nieaktywnej_uslugi`);

--
-- Indeksy dla tabeli `pakiety`
--
ALTER TABLE `pakiety`
  ADD PRIMARY KEY (`id_pakietu`);

--
-- Indeksy dla tabeli `posiadane_uslugi`
--
ALTER TABLE `posiadane_uslugi`
  ADD PRIMARY KEY (`id_posiadania`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_uslugi` (`id_uslugi`);

--
-- Indeksy dla tabeli `powiadomienia`
--
ALTER TABLE `powiadomienia`
  ADD PRIMARY KEY (`id_powiadomienia`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `rodzaj_konta`
--
ALTER TABLE `rodzaj_konta`
  ADD PRIMARY KEY (`id_rodzaju`);

--
-- Indeksy dla tabeli `rodzaj_serwera`
--
ALTER TABLE `rodzaj_serwera`
  ADD PRIMARY KEY (`id_rodzaju`);

--
-- Indeksy dla tabeli `serwery`
--
ALTER TABLE `serwery`
  ADD PRIMARY KEY (`id_serwera`),
  ADD KEY `id_rodzaju` (`id_rodzaju`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id_uslugi`),
  ADD KEY `id_pakietu` (`id_pakietu`),
  ADD KEY `id_serwera` (`id_serwera`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`),
  ADD KEY `id_rodzaju` (`id_rodzaju`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `nieaktywne_uslugi`
--
ALTER TABLE `nieaktywne_uslugi`
  MODIFY `id_nieaktywnej_uslugi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `pakiety`
--
ALTER TABLE `pakiety`
  MODIFY `id_pakietu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `posiadane_uslugi`
--
ALTER TABLE `posiadane_uslugi`
  MODIFY `id_posiadania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT dla tabeli `powiadomienia`
--
ALTER TABLE `powiadomienia`
  MODIFY `id_powiadomienia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `rodzaj_konta`
--
ALTER TABLE `rodzaj_konta`
  MODIFY `id_rodzaju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `rodzaj_serwera`
--
ALTER TABLE `rodzaj_serwera`
  MODIFY `id_rodzaju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `serwery`
--
ALTER TABLE `serwery`
  MODIFY `id_serwera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id_uslugi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `posiadane_uslugi`
--
ALTER TABLE `posiadane_uslugi`
  ADD CONSTRAINT `posiadane_uslugi_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`),
  ADD CONSTRAINT `posiadane_uslugi_ibfk_2` FOREIGN KEY (`id_uslugi`) REFERENCES `uslugi` (`id_uslugi`);

--
-- Ograniczenia dla tabeli `powiadomienia`
--
ALTER TABLE `powiadomienia`
  ADD CONSTRAINT `powiadomienia_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`);

--
-- Ograniczenia dla tabeli `serwery`
--
ALTER TABLE `serwery`
  ADD CONSTRAINT `serwery_ibfk_1` FOREIGN KEY (`id_rodzaju`) REFERENCES `rodzaj_serwera` (`id_rodzaju`);

--
-- Ograniczenia dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD CONSTRAINT `uslugi_ibfk_1` FOREIGN KEY (`id_pakietu`) REFERENCES `pakiety` (`id_pakietu`),
  ADD CONSTRAINT `uslugi_ibfk_2` FOREIGN KEY (`id_serwera`) REFERENCES `serwery` (`id_serwera`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`id_rodzaju`) REFERENCES `rodzaj_konta` (`id_rodzaju`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

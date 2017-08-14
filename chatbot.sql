-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2017 at 04:06 PM
-- Server version: 5.6.30
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative_names`
--

CREATE TABLE `alternative_names` (
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternative_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternative_names`
--

INSERT INTO `alternative_names` (`name`, `alternative_name`, `id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
('help', 'info', 1, NULL, NULL, NULL, NULL),
('help', 'informatie', 3, NULL, NULL, NULL, NULL),
('help', 'readme', 4, NULL, NULL, NULL, NULL),
('medewerkers', 'medewerkers', 5, NULL, NULL, NULL, NULL),
('medewerkers', 'medewerker', 6, NULL, NULL, NULL, NULL),
('tommy', 'tommy van der vorst', 7, NULL, NULL, NULL, NULL),
('tommy', 'tommy vd vorst', 8, NULL, NULL, NULL, NULL),
('wouter', 'wouter koppers', 9, NULL, NULL, NULL, NULL),
('wouter', 'wouter', 10, NULL, NULL, NULL, NULL),
('diakleuren', 'diakleuren', 11, NULL, NULL, NULL, NULL),
('diakleuren', 'kleuren', 12, NULL, NULL, NULL, NULL),
('diakleuren', 'dia kleuren', 13, NULL, NULL, NULL, NULL),
('tommy', 'tommy', 14, NULL, NULL, NULL, NULL),
('tommy', 'van der vorst', 15, NULL, NULL, NULL, NULL),
('wouter', 'koppers', 16, NULL, NULL, NULL, NULL),
('help', 'help', 17, NULL, NULL, '2017-08-07 13:01:10', '2017-08-07 13:01:10'),
('helpme', 'helpme', 22, NULL, NULL, '2017-08-07 13:10:33', '2017-08-07 13:10:33'),
('addSynonym', 'toevoegen:synoniem', 42, NULL, NULL, '2017-08-07 13:41:48', '2017-08-07 13:41:48'),
('addSynonym', 't:s', 66, NULL, NULL, '2017-08-08 10:15:49', '2017-08-08 10:15:49'),
('testtt', 'testttttt', 68, NULL, NULL, '2017-08-08 10:16:52', '2017-08-08 10:16:52'),
('wefewf', 'wefwef', 69, NULL, NULL, '2017-08-08 10:20:31', '2017-08-08 10:20:31'),
('wefewfasd', 'wefwefasdsd', 71, NULL, NULL, '2017-08-08 10:21:21', '2017-08-08 10:21:21'),
('showCommands', 'commands', 72, NULL, NULL, '2017-08-08 10:25:39', '2017-08-08 10:25:39'),
('showCommands', 'showCommands', 73, NULL, NULL, '2017-08-08 10:34:17', '2017-08-08 10:34:17'),
('wouter', 'ikbenwouter', 74, NULL, NULL, '2017-08-08 11:15:21', '2017-08-08 11:15:21'),
('help', 'geefmijhelp', 75, NULL, NULL, '2017-08-10 06:19:23', '2017-08-10 06:19:23'),
('showSynonyms', 'showsynonyms', 76, NULL, NULL, NULL, NULL),
('showSynonyms', 'synonyms', 77, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `id` int(10) UNSIGNED NOT NULL,
  `variable` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `word` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_of_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id`, `variable`, `word`, `type`, `group_name`, `part_of_group`, `description`, `text`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'medewerkers', 'medewerkers', 'group', 'medewerkers', '', 'Alle medewerkers van Dialogic.', 'Dit zijn de personen die bij Dialogic werken, tik een naam in om wat details te zien.', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'wouter', 'wouter', 'group_member', '', 'medewerkers', '', 'Wouter Koppers, koppers@dialogic.nl, 99', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'tommy', 'tommy', 'group_member', '', 'medewerkers', '', 'TvdV', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'diakleuren', 'diakleuren', '', 'dia', '', '', 'R: 234\\r\\nG: 123\\r\\nB: 123', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'help', 'help', '', 'help', '', 'Wat uitleg over dit botje', 'Slim om even te checken hoe dit werkt. Dit programma is bedoeld om informatie te geven over simpele onderwerpen. Het beste onderdeel hiervan is dat je zelf content zeer eenvoudig kunt toevoegen. Oftewel... kan je hier niet vinden wat je zocht, maar is het wel belangrijk? Voeg het toe! Het programma is niet superslim dat het tekst analyseert en door verbanden te trekken erachter komt wat je wilt weten. Toch zitten er een paar handigheidjes in waardoor je makkelijker op het juiste pad wordt gehouden.\\n\\nAlle userinput wordt gefilterd, alle leestekens worden verwijderd, alle speciale tekens worden omgezet naar normale tekens en alle hoofdletters worden klein gemaakt. Hierdoor hoef je minder nauwkeurig input te geven. Vervolgens wordt er gezocht of de commando`s gekoppeld kunnen worden aan iets in de database. Oftewel, kan je door het intikken van diakleuren, dia kleuren of kleuren vinden wat je zoekt? Dit doen we door 1: alternatieve zoekwoorden in de database op te slaan. 2: wanneer nodig, fuzzy matching. Je hebt kans dat diaklueren ook het gewenste resultaat oplevert.', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'addSynonym', 'toevoegen:synoniem', 'special', NULL, NULL, 'If a user types help, the program will look for the word help and show the matching text. Sadly we have many synonyms for the same word: information, helpme, i need help, guide... and this for all the words. \\r\\n\\r\\nThats why you can add synonyms for a word. To do so type: toevoegen:synoniem 2 extra fields will appear. You can use these to enter the words and save them to the database.', NULL, '', '', NULL, NULL),
(7, 'showCommands', 'commands', 'special', NULL, NULL, 'Shows all the available commands with id, variable and description', NULL, '', '', NULL, NULL),
(9, 'showSynonyms', 'synonyms', 'special', NULL, NULL, 'Shows all the available synonyms with id, variable and description', NULL, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_03_125647_commands', 1),
(4, '2017_08_03_154024_alternative_names', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative_names`
--
ALTER TABLE `alternative_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternative_names_alternative_name_unique` (`alternative_name`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commands_word_unique` (`word`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative_names`
--
ALTER TABLE `alternative_names`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

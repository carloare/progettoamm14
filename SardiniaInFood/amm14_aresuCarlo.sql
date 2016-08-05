-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ago 05, 2016 alle 20:08
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm14_aresuCarlo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Amministratore`
--

CREATE TABLE IF NOT EXISTS `Amministratore` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nome_completo` varchar(128) NOT NULL,
  `ruolo` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `Amministratore`
--

INSERT INTO `Amministratore` (`id`, `username`, `password`, `nome_completo`, `ruolo`) VALUES
(1, 'admin', 'admin', 'Carlo', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `Attivita`
--

CREATE TABLE IF NOT EXISTS `Attivita` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `Attivita`
--

INSERT INTO `Attivita` (`id`, `tipo`) VALUES
(1, 'Agriturismo'),
(2, 'American Bar'),
(3, 'Bar Caffe'),
(4, 'Birreria'),
(5, 'Bistrot'),
(6, 'Fast Food'),
(7, 'Gelateria'),
(8, 'Osteria'),
(9, 'Pasticceria'),
(10, 'Pizzeria'),
(11, 'Pub'),
(12, 'Ristorante'),
(13, 'Self Service'),
(14, 'Snack Bar'),
(15, 'Take Away'),
(16, 'Trattoria'),
(17, 'Altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `Aziende`
--

CREATE TABLE IF NOT EXISTS `Aziende` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(128) DEFAULT NULL,
  `tipo_incarichi_id` bigint(20) unsigned DEFAULT NULL,
  `email_personale` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nome_azienda` varchar(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `indirizzo` varchar(128) DEFAULT NULL,
  `tipo_attivita_id` bigint(20) unsigned DEFAULT NULL,
  `descrizione` varchar(300) DEFAULT NULL,
  `telefono` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `sito_web` varchar(128) DEFAULT NULL,
  `ruolo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_incarichi_id` (`tipo_incarichi_id`),
  KEY `tipo_attivita_id` (`tipo_attivita_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dump dei dati per la tabella `Aziende`
--

INSERT INTO `Aziende` (`id`, `nome_completo`, `tipo_incarichi_id`, `email_personale`, `username`, `password`, `nome_azienda`, `citta`, `indirizzo`, `tipo_attivita_id`, `descrizione`, `telefono`, `email`, `sito_web`, `ruolo`) VALUES
(1, 'Carlo', 1, 'carlo@email.com', 'carlo', '111', 'Mela', 'Cagliari', 'via Ydfkdskfj dfd dsffdsf 7', 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean sdfadf dfa sdfadf asdhfgdg gfh dfghgfsdf sdaf sdaf sadf adf sd fffff', '123456789', 'mela@email.com', 'www.mela.com', 1),
(2, 'Massimiliano', 1, 'massimiliano@email.com', 'max', '111', 'Pera', 'Cagliari', 'via Yfdsfsdkf fd 8', 10, 'Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il cap', '123456789', 'pera@email.com', 'www.pera.com', 1),
(3, 'Roberta', 2, 'roberta@email.com', 'roberta', '111', 'Arancia', 'Sassari', 'via Hfdjfkd kfd fdjff 5', 2, 'La mia anima è pervasa da una mirabile serenità, simile a queste belle mattinate di maggio che io godo con tutto il cuore. Sono solo e mi rallegro di vivere in questo luogo che sembra esser creato per', '123456789', 'arancia@email.com', 'www.arancia.com', 1),
(4, 'Gianni', 1, 'gianni@email.com', 'gianni', '111', 'Melone', 'Nuoro', 'via Hfdfkdk Hdfd 4', 6, 'In una terra lontana, dietro le montagne Parole, lontani dalle terre di Vocalia e Consonantia, vivono i testi casuali. Vivono isolati nella cittadina di Lettere, sulle coste del Semantico, un immenso.', '123456789', 'melone@email.com', 'www.melone.com', 1),
(5, 'Andrea', 1, 'andrea@email.com', 'andrea', '111', 'Anguria', 'Oristano', 'via Hdfsfs 5', 10, 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pro', '123456789', 'anguria@email.com', 'www.anguria.com', 1),
(6, 'Michele', 1, 'michele@email.com', 'michele', '111', 'Cocomero', 'Cagliari', 'via Hfdffd J Jkkjk 3', 7, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta.', '123456789', 'cocomero@email.com', 'www.cocomero.com', 1),
(7, 'Lucia', 2, 'lucia@email.com', 'lucia', '111', 'Ananas', 'Sassari', 'via Hfdfdfdf 9', 8, 'Praesent pharetra egestas condimentum. Nunc vel purus eu sem volutpat euismod eget nec magna. Fusce sodales, dolor sed venenatis rhoncus, arcu leo aliquet velit, id pulvinar massa ipsum non cras amet.', '123456789', 'osteria@email.com', 'www.ananas.com', 1),
(8, 'Raffaele', 1, 'raffaele@email.com', 'raffaele', '111', 'Lampone', 'Nuoro', 'via Jdfddf 32', 9, 'Come figliolo Confesso come fosse antani con scappellamento a destra costantinato ammaliti. Quante volte figliolo Fifty fifty, prematinea come fosse mea culpa. Alla supercazzola. Come figliolo Confesso come fosse antani con', '123456789', 'lampone@email.com', 'www.lampone.com', 1),
(9, 'Gabriele', 1, 'gabriele@email.com', 'gabriele', '111', 'Lime', 'Oristano', 'via Hdfdf 8', 13, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'lime@email.com', 'www.lime.com', 1),
(10, 'Maria', 1, 'maria@email.com', 'maria', '111', 'Fragola', 'Cagliari', 'via Kfdskfjs 7', 7, 'Liquorice powder danish tart sweet dessert. Pie cookie pie pudding caramels croissant bonbon chocolate bar pudding. Cheesecake sweet roll cupcake icing cupcake apple pie tiramisu sweet.', '123456789', 'fragola@email.com', 'www.fragola.com', 1),
(11, 'Rosalinda', 3, 'rosalinda@email.com', 'rosalinda', '111', 'Kiwi', 'Nuoro', 'via Mdkfjd Mkjfdjsfd 9', 11, 'Beetroot water spinach okra water chestnut ricebean pea catsear courgette summer purslane. Water spinach arugula pea tatsoi aubergine spring onion bush tomato kale radicchio turnip chicory salsify pea sprouts fava bean.', '123456789', 'kiwi@email.com', 'www.kiwi.com', 1),
(12, 'Nicola', 4, 'nicola@email.com', 'nicola', '111', 'Noce', 'Sassari', 'via Kfdksfjs 4', 12, 'Dessert fruitcake dragée chocolate bar chocolate bar lollipop bear claw chupa chups. Croissant fruitcake jelly cupcake muffin. Donut croissant chocolate cake cotton candy marzipan toffee.', '123456789', 'noce@email.com', 'www.noce.com', 1),
(13, 'Federica', 3, 'federica@email.com', 'federica', '111', 'Papaya', 'Cagliari', 'via Ndfskf Jdskjfksdj 56', 15, 'Cake fruitcake sweet roll marzipan tootsie roll cheesecake. Gummies soufflé marzipan topping sweet cheesecake. Topping muffin jujubes. Sugar plum jujubes tiramisu.', '123456789', 'papaya@email.com', 'www.papaya.com', 1),
(14, 'Annalisa', 2, 'annalisa@email.com', 'annalisa', '111', 'Melograno', 'Nuoro', 'via Hkdsjfksdjf 54', 16, 'Cake fruitcake sweet roll marzipan tootsie roll cheesecake. Gummies soufflé marzipan topping sweet cheesecake. Topping muffin jujubes. Sugar plum jujubes tiramisu.', '123456789', 'melograno@email.com', 'www.melograno.com', 1),
(15, 'Luisa', 3, 'luisa@email.com', 'luisa', '111', 'Ciliegia', 'Cagliari', 'via Ksdkjfsldfk 76', 5, 'Cake fruitcake sweet roll marzipan tootsie roll cheesecake. Gummies soufflé marzipan topping sweet cheesecake. Topping muffin jujubes. Sugar plum jujubes tiramisu.', '123456789', 'ciliegia@email.com', 'www.ciliegia.com', 1),
(16, 'Francesco', 1, 'francesco@email.com', 'francesco', '111', 'Mirtillo', 'Cagliari', 'via Jdkjskfsj 67', 4, 'Cake fruitcake sweet roll marzipan tootsie roll cheesecake. Gummies soufflé marzipan topping sweet cheesecake. Topping muffin jujubes. Sugar plum jujubes tiramisu.', '123456789', 'mirtillo@email.com', 'www.mirtillo.com', 1),
(17, 'Ignazia', 1, 'ignazia@email.com', 'ignazia', '111', 'Mandarino', 'Cagliari', 'via Kdsfsdfsf 34', 3, 'Cake fruitcake sweet roll marzipan tootsie roll cheesecake. Gummies soufflé marzipan topping sweet cheesecake. Topping muffin jujubes. Sugar plum jujubes tiramisu.', '123456789', 'mandarino@email.com', 'www.mandarino.com', 1),
(18, 'Salvatore', 1, 'salvatore@email.com', 'salvatore', '111', 'Mandarancio', 'Nuoro', 'via Jdkdkf 53', 10, 'Dessert fruitcake dragée chocolate bar chocolate bar lollipop bear claw chupa chups. Croissant fruitcake jelly cupcake muffin. Donut croissant chocolate cake cotton candy marzipan toffee.', '123456789', 'mandarancio@email.com', 'www.mandarancio.com', 1),
(19, 'Raffaella', 1, 'raffaella@email.com', 'raffaella', '111', 'Limone', 'Nuoro', 'via Wkjdfkdf 23', 9, 'Dessert fruitcake dragée chocolate bar chocolate bar lollipop bear claw chupa chups. Croissant fruitcake jelly cupcake muffin. Donut croissant chocolate cake cotton candy marzipan toffee.', '123456789', 'limone@email.com', 'www.limone.com', 1),
(20, 'Valentina', 3, 'valentina@email.com', 'valentina', '111', 'Amarena', 'Sassari', 'via Jdffdffd 33', 4, 'Dessert fruitcake dragée chocolate bar chocolate bar lollipop bear claw chupa chups. Croissant fruitcake jelly cupcake muffin. Donut croissant chocolate cake cotton candy marzipan toffee.', '123456789', 'amarena@email.com', 'www.amarena.com', 1),
(21, 'Maria Elena', 3, 'mariaelena@email.com', 'maria elena', '111', 'Pompelmo', 'Oristano', 'via Jdfdsksf 78', 12, 'Dessert fruitcake dragée chocolate bar chocolate bar lollipop bear claw chupa chups. Croissant fruitcake jelly cupcake muffin. Donut croissant chocolate cake cotton candy marzipan toffee.', '123456789', 'pompelmo@email.com', 'www.pompelmo.com', 1),
(22, 'Filippo', 2, 'filippo@email.com', 'filippo', '111', 'Albicocca', 'Cagliari', 'via Gkdfdsk 43', 13, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'albicocca@email.com', 'www.albicocca.com', 1),
(23, 'Giulia', 2, 'giulia@email.com', 'giulia', '111', 'Pesca', 'Nuoro', 'via Jdfdf 43', 6, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'pesca@email.com', 'www.pesca.com', 1),
(24, 'Loredana', 3, 'loredana@email.com', 'loredana', '111', 'Prugna', 'Sassari', 'via Ofdksdjf Kkjdkf 7', 14, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'prugna@email.com', 'www.prugna.com', 1),
(25, 'Marco', 3, 'marco@email.com', 'marco', '111', 'Banana', 'Cagliari', 'via Hdkjfskjfskdf Jfkdjsfk 76', 11, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'banana@email.com', 'www.banana.com', 1),
(26, 'Federico', 4, 'federico@email.com', 'federico', '111', 'Susina', 'Oristano', 'via Jsdfafasfa Jdfskjfksj 36', 10, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'susina@email.com', 'www.susina.com', 1),
(27, 'Francesca', 3, 'francesca@email.com', 'francesca', '111', 'Uva', 'Sassari', 'via Jdkfsjdkfjsd 43', 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'uva@email.com', 'www.uva.com', 1),
(28, 'Sara', 4, 'sara@email.com', 'sara', '111', 'Mora', 'Nuoro', 'via Jdkfjsklf 43', 8, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'mora@email.com', 'www.mora.com', 1),
(29, 'Pierluigi', 4, 'pierluigi@email.it', 'pierluigi', '111', 'Noce di cocco', 'Sassari', 'via Udkkfdkf 87', 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec', '123456789', 'nocedicocco@email.com', 'www.nocedicocco.com', 1),
(30, 'Edoardo', 3, 'edoardo@email.com', 'edoardo', '111', 'Engkala', 'Nuoro', 'via Udddffdf 87', 16, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '123456789', 'engkala@email.com', 'www.engkala.com', 1),
(31, 'Luigi', 4, 'luigi@email.com', 'luigi', '111', 'Clementina', 'Sassari', 'via Kfkdjfsdkf 42', 5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '123456789', 'clementina@email.com', 'www.clementina.com', 1),
(32, 'Anastasia', 2, 'anastasia@email.com', 'anastasia', '111', 'Alkekengi', 'Cagliari', 'via Mdkdjf 8', 12, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'alkekengi@email.com', 'www.alkekengi.com', 1),
(33, 'Nicoletta', 3, 'nicoletta@email.com', 'nicoletta', '111', 'Voacanga', 'Nuoro', 'via Hkdjfksdfjskldf 87', 11, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'voacanga@email.com', 'www.voacanga.com', 1),
(34, 'Mirko', 2, 'mirko@email.com', 'mirko', '111', 'Litchi', 'Sassari', 'via Sksadjfsakjf r 34', 6, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'litchi@email.com', 'www.litchi.com', 1),
(35, 'Alessandro', 1, 'alessandro@email.com', 'alessandro', '111', 'Viscola', 'Oristano', 'via Hdkjfslkf 83', 3, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'viscola@email.com', 'www.viscola.com', 1),
(36, 'Laura', 2, 'laura@email.com', 'laura', '111', 'Ichang', 'Cagliari', 'via Kfksdjfksjf 37', 2, 'Candy canes liquorice sweet chocolate bar sesame snaps croissant sesame snaps jelly beans. Tiramisu brownie toffee fruitcake gummies candy jujubes. Jelly pudding chupa chups gingerbread pie.', '123456789', 'ichang@email.com', 'www.ichang.com', 1),
(37, 'Danilo', 3, 'danilo@email.com', 'danilo', '111', 'Mandorla', 'Cagliari', 'via Hdffdsfs 32', 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', '123456789', 'mardorla@email.com', 'www.mandorla.it', 1),
(38, 'Attila', 1, 'attila@email.it', 'attila', '111', 'Tamarillo', 'Cagliari', 'via Fkjkdjfkd 9', 11, 'Akdjsfksjdf sdkfdsfksdf d fsdadsalkjfsalkdfjsladfjsdk fjsd jfsdlkjflsadkjfksd jflksdjf.', '123456789', 'tamarillo@email.it', 'www.tamarillo.it', 1),
(39, 'Omar', 1, 'omar@email.it', 'omar', '111', 'Sapodilla', 'Cagliari', 'Via Hkdjlafkj ds Fdfasf 189', 11, 'sdkfjlkajdfl jdfl kjdsalfkjasldfkjsadlkfjasdl fjlksdj flksadjf lkajdflk j.', '123456789', 'sapodilla@email.it', 'www.sapodilla.com', 1),
(40, 'Gennaro', 1, 'gennaro@email.it', 'gennaro', '111', 'Guava', 'Cagliari', 'via Kjdkksfjskfj 54', 12, 'Gestdsfgsfdg sfdg sdfgsdfg fds fds gdg dsfg sfg.', '123456789', 'guava@email.it', 'www.guava.com', 1),
(41, 'Peppino', 3, 'peppino@email.it', 'peppino', '111', 'Litchi', 'Sassari', 'via Hkjlsdkjflsdk 78', 2, 'dflajlfkajdlfkjadlkfjalkf jsldkf jsda jdasl fjg dhghdfg hdgh dghdfghdfgh h.', '123456789', 'litchi@email.it', 'www.litchi.com', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Aziende_Servizi`
--

CREATE TABLE IF NOT EXISTS `Aziende_Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_servizi` bigint(20) unsigned DEFAULT NULL,
  `valore` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_servizi` (`id_servizi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=703 ;

--
-- Dump dei dati per la tabella `Aziende_Servizi`
--

INSERT INTO `Aziende_Servizi` (`id`, `id_aziende`, `id_servizi`, `valore`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 1, 6, 0),
(7, 1, 7, 0),
(8, 1, 8, 0),
(9, 1, 9, 0),
(10, 1, 10, 0),
(11, 1, 11, 0),
(12, 1, 12, 0),
(13, 1, 13, 0),
(14, 1, 14, 0),
(15, 1, 15, 0),
(16, 1, 16, 0),
(17, 1, 17, 0),
(18, 1, 18, 0),
(19, 2, 1, 0),
(20, 2, 2, 0),
(21, 2, 3, 1),
(22, 2, 4, 0),
(23, 2, 5, 0),
(24, 2, 6, 0),
(25, 2, 7, 0),
(26, 2, 8, 0),
(27, 2, 9, 0),
(28, 2, 10, 0),
(29, 2, 11, 0),
(30, 2, 12, 0),
(31, 2, 13, 1),
(32, 2, 14, 0),
(33, 2, 15, 0),
(34, 2, 16, 0),
(35, 2, 17, 0),
(36, 2, 18, 0),
(37, 3, 1, 0),
(38, 3, 2, 0),
(39, 3, 3, 0),
(40, 3, 4, 0),
(41, 3, 5, 0),
(42, 3, 6, 0),
(43, 3, 7, 0),
(44, 3, 8, 0),
(45, 3, 9, 1),
(46, 3, 10, 0),
(47, 3, 11, 0),
(48, 3, 12, 0),
(49, 3, 13, 0),
(50, 3, 14, 1),
(51, 3, 15, 0),
(52, 3, 16, 0),
(53, 3, 17, 0),
(54, 3, 18, 0),
(55, 5, 1, 0),
(56, 5, 2, 0),
(57, 5, 3, 0),
(58, 5, 4, 0),
(59, 5, 5, 0),
(60, 5, 6, 0),
(61, 5, 7, 0),
(62, 5, 8, 0),
(63, 5, 9, 1),
(64, 5, 10, 0),
(65, 5, 11, 0),
(66, 5, 12, 0),
(67, 5, 13, 0),
(68, 5, 14, 0),
(69, 5, 15, 0),
(70, 5, 16, 0),
(71, 5, 17, 0),
(72, 5, 18, 0),
(73, 6, 1, 0),
(74, 6, 2, 0),
(75, 6, 3, 0),
(76, 6, 4, 0),
(77, 6, 5, 0),
(78, 6, 6, 0),
(79, 6, 7, 0),
(80, 6, 8, 0),
(81, 6, 9, 0),
(82, 6, 10, 0),
(83, 6, 11, 0),
(84, 6, 12, 0),
(85, 6, 13, 0),
(86, 6, 14, 0),
(87, 6, 15, 1),
(88, 6, 16, 1),
(89, 6, 17, 0),
(90, 6, 18, 0),
(91, 7, 1, 0),
(92, 7, 2, 0),
(93, 7, 3, 0),
(94, 7, 4, 0),
(95, 7, 5, 0),
(96, 7, 6, 0),
(97, 7, 7, 0),
(98, 7, 8, 1),
(99, 7, 9, 0),
(100, 7, 10, 0),
(101, 7, 11, 0),
(102, 7, 12, 0),
(103, 7, 13, 0),
(104, 7, 14, 0),
(105, 7, 15, 0),
(106, 7, 16, 0),
(107, 7, 17, 0),
(108, 7, 18, 0),
(109, 8, 1, 0),
(110, 8, 2, 0),
(111, 8, 3, 0),
(112, 8, 4, 0),
(113, 8, 5, 1),
(114, 8, 6, 0),
(115, 8, 7, 0),
(116, 8, 8, 0),
(117, 8, 9, 1),
(118, 8, 10, 0),
(119, 8, 11, 0),
(120, 8, 12, 0),
(121, 8, 13, 0),
(122, 8, 14, 0),
(123, 8, 15, 0),
(124, 8, 16, 0),
(125, 8, 17, 0),
(126, 8, 18, 0),
(127, 9, 1, 0),
(128, 9, 2, 0),
(129, 9, 3, 0),
(130, 9, 4, 0),
(131, 9, 5, 1),
(132, 9, 6, 0),
(133, 9, 7, 0),
(134, 9, 8, 0),
(135, 9, 9, 0),
(136, 9, 10, 0),
(137, 9, 11, 0),
(138, 9, 12, 0),
(139, 9, 13, 0),
(140, 9, 14, 0),
(141, 9, 15, 0),
(142, 9, 16, 0),
(143, 9, 17, 0),
(144, 9, 18, 0),
(145, 10, 1, 1),
(146, 10, 2, 1),
(147, 10, 3, 1),
(148, 10, 4, 1),
(149, 10, 5, 1),
(150, 10, 6, 1),
(151, 10, 7, 1),
(152, 10, 8, 1),
(153, 10, 9, 1),
(154, 10, 10, 1),
(155, 10, 11, 1),
(156, 10, 12, 1),
(157, 10, 13, 1),
(158, 10, 14, 1),
(159, 10, 15, 1),
(160, 10, 16, 1),
(161, 10, 17, 1),
(162, 10, 18, 1),
(163, 11, 1, 0),
(164, 11, 2, 0),
(165, 11, 3, 0),
(166, 11, 4, 0),
(167, 11, 5, 0),
(168, 11, 6, 0),
(169, 11, 7, 0),
(170, 11, 8, 0),
(171, 11, 9, 0),
(172, 11, 10, 1),
(173, 11, 11, 0),
(174, 11, 12, 0),
(175, 11, 13, 0),
(176, 11, 14, 0),
(177, 11, 15, 0),
(178, 11, 16, 0),
(179, 11, 17, 0),
(180, 11, 18, 0),
(181, 12, 1, 0),
(182, 12, 2, 0),
(183, 12, 3, 0),
(184, 12, 4, 1),
(185, 12, 5, 0),
(186, 12, 6, 0),
(187, 12, 7, 0),
(188, 12, 8, 0),
(189, 12, 9, 0),
(190, 12, 10, 0),
(191, 12, 11, 0),
(192, 12, 12, 0),
(193, 12, 13, 1),
(194, 12, 14, 0),
(195, 12, 15, 0),
(196, 12, 16, 0),
(197, 12, 17, 0),
(198, 12, 18, 0),
(199, 13, 1, 0),
(200, 13, 2, 0),
(201, 13, 3, 0),
(202, 13, 4, 0),
(203, 13, 5, 1),
(204, 13, 6, 0),
(205, 13, 7, 0),
(206, 13, 8, 0),
(207, 13, 9, 0),
(208, 13, 10, 0),
(209, 13, 11, 1),
(210, 13, 12, 0),
(211, 13, 13, 0),
(212, 13, 14, 0),
(213, 13, 15, 0),
(214, 13, 16, 0),
(215, 13, 17, 0),
(216, 13, 18, 0),
(217, 14, 1, 0),
(218, 14, 2, 0),
(219, 14, 3, 1),
(220, 14, 4, 0),
(221, 14, 5, 0),
(222, 14, 6, 0),
(223, 14, 7, 0),
(224, 14, 8, 0),
(225, 14, 9, 0),
(226, 14, 10, 0),
(227, 14, 11, 0),
(228, 14, 12, 0),
(229, 14, 13, 0),
(230, 14, 14, 1),
(231, 14, 15, 0),
(232, 14, 16, 0),
(233, 14, 17, 0),
(234, 14, 18, 0),
(235, 15, 1, 1),
(236, 15, 2, 1),
(237, 15, 3, 0),
(238, 15, 4, 0),
(239, 15, 5, 0),
(240, 15, 6, 0),
(241, 15, 7, 0),
(242, 15, 8, 0),
(243, 15, 9, 0),
(244, 15, 10, 0),
(245, 15, 11, 0),
(246, 15, 12, 0),
(247, 15, 13, 0),
(248, 15, 14, 0),
(249, 15, 15, 0),
(250, 15, 16, 0),
(251, 15, 17, 0),
(252, 15, 18, 0),
(253, 16, 1, 1),
(254, 16, 2, 0),
(255, 16, 3, 0),
(256, 16, 4, 0),
(257, 16, 5, 0),
(258, 16, 6, 0),
(259, 16, 7, 0),
(260, 16, 8, 0),
(261, 16, 9, 0),
(262, 16, 10, 0),
(263, 16, 11, 1),
(264, 16, 12, 0),
(265, 16, 13, 0),
(266, 16, 14, 0),
(267, 16, 15, 0),
(268, 16, 16, 0),
(269, 16, 17, 0),
(270, 16, 18, 0),
(271, 17, 1, 0),
(272, 17, 2, 0),
(273, 17, 3, 0),
(274, 17, 4, 0),
(275, 17, 5, 0),
(276, 17, 6, 0),
(277, 17, 7, 0),
(278, 17, 8, 0),
(279, 17, 9, 0),
(280, 17, 10, 0),
(281, 17, 11, 1),
(282, 17, 12, 0),
(283, 17, 13, 0),
(284, 17, 14, 0),
(285, 17, 15, 0),
(286, 17, 16, 0),
(287, 17, 17, 1),
(288, 17, 18, 1),
(289, 18, 1, 0),
(290, 18, 2, 0),
(291, 18, 3, 0),
(292, 18, 4, 0),
(293, 18, 5, 0),
(294, 18, 6, 0),
(295, 18, 7, 0),
(296, 18, 8, 0),
(297, 18, 9, 1),
(298, 18, 10, 0),
(299, 18, 11, 0),
(300, 18, 12, 0),
(301, 18, 13, 1),
(302, 18, 14, 0),
(303, 18, 15, 0),
(304, 18, 16, 0),
(305, 18, 17, 0),
(306, 18, 18, 0),
(307, 19, 1, 0),
(308, 19, 2, 0),
(309, 19, 3, 0),
(310, 19, 4, 0),
(311, 19, 5, 0),
(312, 19, 6, 0),
(313, 19, 7, 0),
(314, 19, 8, 0),
(315, 19, 9, 0),
(316, 19, 10, 0),
(317, 19, 11, 0),
(318, 19, 12, 0),
(319, 19, 13, 0),
(320, 19, 14, 1),
(321, 19, 15, 0),
(322, 19, 16, 1),
(323, 19, 17, 0),
(324, 19, 18, 0),
(325, 20, 1, 0),
(326, 20, 2, 0),
(327, 20, 3, 0),
(328, 20, 4, 0),
(329, 20, 5, 0),
(330, 20, 6, 0),
(331, 20, 7, 0),
(332, 20, 8, 0),
(333, 20, 9, 0),
(334, 20, 10, 0),
(335, 20, 11, 0),
(336, 20, 12, 0),
(337, 20, 13, 1),
(338, 20, 14, 0),
(339, 20, 15, 1),
(340, 20, 16, 0),
(341, 20, 17, 0),
(342, 20, 18, 0),
(343, 21, 1, 0),
(344, 21, 2, 0),
(345, 21, 3, 0),
(346, 21, 4, 0),
(347, 21, 5, 0),
(348, 21, 6, 0),
(349, 21, 7, 0),
(350, 21, 8, 0),
(351, 21, 9, 0),
(352, 21, 10, 0),
(353, 21, 11, 0),
(354, 21, 12, 0),
(355, 21, 13, 0),
(356, 21, 14, 0),
(357, 21, 15, 0),
(358, 21, 16, 0),
(359, 21, 17, 0),
(360, 21, 18, 1),
(361, 23, 1, 0),
(362, 23, 2, 0),
(363, 23, 3, 1),
(364, 23, 4, 0),
(365, 23, 5, 0),
(366, 23, 6, 1),
(367, 23, 7, 0),
(368, 23, 8, 0),
(369, 23, 9, 0),
(370, 23, 10, 0),
(371, 23, 11, 0),
(372, 23, 12, 0),
(373, 23, 13, 0),
(374, 23, 14, 0),
(375, 23, 15, 0),
(376, 23, 16, 0),
(377, 23, 17, 0),
(378, 23, 18, 0),
(379, 24, 1, 0),
(380, 24, 2, 0),
(381, 24, 3, 0),
(382, 24, 4, 0),
(383, 24, 5, 0),
(384, 24, 6, 0),
(385, 24, 7, 0),
(386, 24, 8, 0),
(387, 24, 9, 0),
(388, 24, 10, 0),
(389, 24, 11, 0),
(390, 24, 12, 1),
(391, 24, 13, 1),
(392, 24, 14, 0),
(393, 24, 15, 0),
(394, 24, 16, 0),
(395, 24, 17, 0),
(396, 24, 18, 0),
(397, 25, 1, 0),
(398, 25, 2, 0),
(399, 25, 3, 0),
(400, 25, 4, 0),
(401, 25, 5, 0),
(402, 25, 6, 0),
(403, 25, 7, 0),
(404, 25, 8, 0),
(405, 25, 9, 0),
(406, 25, 10, 0),
(407, 25, 11, 0),
(408, 25, 12, 1),
(409, 25, 13, 0),
(410, 25, 14, 0),
(411, 25, 15, 1),
(412, 25, 16, 0),
(413, 25, 17, 0),
(414, 25, 18, 0),
(415, 26, 1, 0),
(416, 26, 2, 0),
(417, 26, 3, 0),
(418, 26, 4, 0),
(419, 26, 5, 0),
(420, 26, 6, 0),
(421, 26, 7, 0),
(422, 26, 8, 0),
(423, 26, 9, 0),
(424, 26, 10, 0),
(425, 26, 11, 1),
(426, 26, 12, 0),
(427, 26, 13, 0),
(428, 26, 14, 0),
(429, 26, 15, 0),
(430, 26, 16, 0),
(431, 26, 17, 0),
(432, 26, 18, 0),
(433, 27, 1, 0),
(434, 27, 2, 0),
(435, 27, 3, 0),
(436, 27, 4, 0),
(437, 27, 5, 1),
(438, 27, 6, 0),
(439, 27, 7, 0),
(440, 27, 8, 0),
(441, 27, 9, 0),
(442, 27, 10, 1),
(443, 27, 11, 0),
(444, 27, 12, 0),
(445, 27, 13, 0),
(446, 27, 14, 0),
(447, 27, 15, 0),
(448, 27, 16, 0),
(449, 27, 17, 0),
(450, 27, 18, 0),
(451, 28, 1, 0),
(452, 28, 2, 0),
(453, 28, 3, 0),
(454, 28, 4, 0),
(455, 28, 5, 1),
(456, 28, 6, 0),
(457, 28, 7, 1),
(458, 28, 8, 1),
(459, 28, 9, 0),
(460, 28, 10, 0),
(461, 28, 11, 0),
(462, 28, 12, 0),
(463, 28, 13, 0),
(464, 28, 14, 0),
(465, 28, 15, 0),
(466, 28, 16, 0),
(467, 28, 17, 0),
(468, 28, 18, 0),
(469, 29, 1, 0),
(470, 29, 2, 0),
(471, 29, 3, 0),
(472, 29, 4, 1),
(473, 29, 5, 0),
(474, 29, 6, 0),
(475, 29, 7, 0),
(476, 29, 8, 0),
(477, 29, 9, 0),
(478, 29, 10, 1),
(479, 29, 11, 0),
(480, 29, 12, 0),
(481, 29, 13, 0),
(482, 29, 14, 0),
(483, 29, 15, 0),
(484, 29, 16, 0),
(485, 29, 17, 1),
(486, 29, 18, 0),
(487, 30, 1, 0),
(488, 30, 2, 0),
(489, 30, 3, 0),
(490, 30, 4, 0),
(491, 30, 5, 0),
(492, 30, 6, 0),
(493, 30, 7, 1),
(494, 30, 8, 0),
(495, 30, 9, 0),
(496, 30, 10, 0),
(497, 30, 11, 0),
(498, 30, 12, 0),
(499, 30, 13, 0),
(500, 30, 14, 1),
(501, 30, 15, 0),
(502, 30, 16, 0),
(503, 30, 17, 0),
(504, 30, 18, 0),
(505, 31, 1, 0),
(506, 31, 2, 0),
(507, 31, 3, 0),
(508, 31, 4, 0),
(509, 31, 5, 0),
(510, 31, 6, 0),
(511, 31, 7, 0),
(512, 31, 8, 0),
(513, 31, 9, 0),
(514, 31, 10, 1),
(515, 31, 11, 0),
(516, 31, 12, 0),
(517, 31, 13, 0),
(518, 31, 14, 0),
(519, 31, 15, 0),
(520, 31, 16, 1),
(521, 31, 17, 0),
(522, 31, 18, 0),
(523, 32, 1, 0),
(524, 32, 2, 0),
(525, 32, 3, 1),
(526, 32, 4, 0),
(527, 32, 5, 0),
(528, 32, 6, 0),
(529, 32, 7, 0),
(530, 32, 8, 0),
(531, 32, 9, 0),
(532, 32, 10, 1),
(533, 32, 11, 0),
(534, 32, 12, 0),
(535, 32, 13, 0),
(536, 32, 14, 1),
(537, 32, 15, 0),
(538, 32, 16, 0),
(539, 32, 17, 0),
(540, 32, 18, 1),
(541, 33, 1, 0),
(542, 33, 2, 0),
(543, 33, 3, 0),
(544, 33, 4, 0),
(545, 33, 5, 0),
(546, 33, 6, 0),
(547, 33, 7, 0),
(548, 33, 8, 0),
(549, 33, 9, 1),
(550, 33, 10, 0),
(551, 33, 11, 0),
(552, 33, 12, 0),
(553, 33, 13, 0),
(554, 33, 14, 0),
(555, 33, 15, 1),
(556, 33, 16, 0),
(557, 33, 17, 0),
(558, 33, 18, 0),
(559, 34, 1, 1),
(560, 34, 2, 0),
(561, 34, 3, 0),
(562, 34, 4, 0),
(563, 34, 5, 0),
(564, 34, 6, 0),
(565, 34, 7, 0),
(566, 34, 8, 0),
(567, 34, 9, 0),
(568, 34, 10, 1),
(569, 34, 11, 0),
(570, 34, 12, 0),
(571, 34, 13, 0),
(572, 34, 14, 0),
(573, 34, 15, 1),
(574, 34, 16, 1),
(575, 34, 17, 0),
(576, 34, 18, 0),
(577, 35, 1, 0),
(578, 35, 2, 0),
(579, 35, 3, 0),
(580, 35, 4, 0),
(581, 35, 5, 0),
(582, 35, 6, 0),
(583, 35, 7, 0),
(584, 35, 8, 0),
(585, 35, 9, 1),
(586, 35, 10, 0),
(587, 35, 11, 0),
(588, 35, 12, 1),
(589, 35, 13, 0),
(590, 35, 14, 0),
(591, 35, 15, 0),
(592, 35, 16, 0),
(593, 35, 17, 0),
(594, 35, 18, 0),
(595, 36, 1, 0),
(596, 36, 2, 0),
(597, 36, 3, 0),
(598, 36, 4, 0),
(599, 36, 5, 0),
(600, 36, 6, 0),
(601, 36, 7, 0),
(602, 36, 8, 0),
(603, 36, 9, 1),
(604, 36, 10, 0),
(605, 36, 11, 0),
(606, 36, 12, 0),
(607, 36, 13, 0),
(608, 36, 14, 0),
(609, 36, 15, 0),
(610, 36, 16, 0),
(611, 36, 17, 0),
(612, 36, 18, 0),
(613, 37, 1, 0),
(614, 37, 2, 0),
(615, 37, 3, 0),
(616, 37, 4, 0),
(617, 37, 5, 0),
(618, 37, 6, 0),
(619, 37, 7, 0),
(620, 37, 8, 0),
(621, 37, 9, 1),
(622, 37, 10, 0),
(623, 37, 11, 0),
(624, 37, 12, 0),
(625, 37, 13, 0),
(626, 37, 14, 1),
(627, 37, 15, 0),
(628, 37, 16, 0),
(629, 37, 17, 0),
(630, 37, 18, 0),
(631, 38, 1, 1),
(632, 38, 2, 0),
(633, 38, 3, 0),
(634, 38, 4, 0),
(635, 38, 5, 0),
(636, 38, 6, 0),
(637, 38, 7, 0),
(638, 38, 8, 0),
(639, 38, 9, 0),
(640, 38, 10, 0),
(641, 38, 11, 0),
(642, 38, 12, 0),
(643, 38, 13, 0),
(644, 38, 14, 0),
(645, 38, 15, 0),
(646, 38, 16, 0),
(647, 38, 17, 0),
(648, 38, 18, 0),
(649, 39, 1, 1),
(650, 39, 2, 0),
(651, 39, 3, 0),
(652, 39, 4, 0),
(653, 39, 5, 0),
(654, 39, 6, 0),
(655, 39, 7, 0),
(656, 39, 8, 0),
(657, 39, 9, 0),
(658, 39, 10, 0),
(659, 39, 11, 0),
(660, 39, 12, 0),
(661, 39, 13, 0),
(662, 39, 14, 0),
(663, 39, 15, 0),
(664, 39, 16, 0),
(665, 39, 17, 0),
(666, 39, 18, 0),
(667, 40, 1, 0),
(668, 40, 2, 0),
(669, 40, 3, 1),
(670, 40, 4, 0),
(671, 40, 5, 1),
(672, 40, 6, 1),
(673, 40, 7, 1),
(674, 40, 8, 0),
(675, 40, 9, 0),
(676, 40, 10, 0),
(677, 40, 11, 0),
(678, 40, 12, 0),
(679, 40, 13, 0),
(680, 40, 14, 0),
(681, 40, 15, 0),
(682, 40, 16, 0),
(683, 40, 17, 0),
(684, 40, 18, 0),
(685, 41, 1, 1),
(686, 41, 2, 0),
(687, 41, 3, 1),
(688, 41, 4, 0),
(689, 41, 5, 1),
(690, 41, 6, 0),
(691, 41, 7, 1),
(692, 41, 8, 0),
(693, 41, 9, 1),
(694, 41, 10, 0),
(695, 41, 11, 1),
(696, 41, 12, 0),
(697, 41, 13, 1),
(698, 41, 14, 0),
(699, 41, 15, 1),
(700, 41, 16, 0),
(701, 41, 17, 1),
(702, 41, 18, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Clienti`
--

CREATE TABLE IF NOT EXISTS `Clienti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `ruolo` int(1) DEFAULT NULL,
  `numero_richiami` int(11) DEFAULT NULL,
  `bannato` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `Clienti`
--

INSERT INTO `Clienti` (`id`, `nome_completo`, `username`, `password`, `email`, `ruolo`, `numero_richiami`, `bannato`) VALUES
(1, 'Carlo', 'Carlo', '111', 'carlo@email.it', 0, 0, 0),
(2, 'Luigi', 'luigi', '111', 'luigi@email.it', 0, 0, 0),
(3, 'mario', 'mario', '111', 'mario@email.it', 0, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Incarichi`
--

CREATE TABLE IF NOT EXISTS `Incarichi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `Incarichi`
--

INSERT INTO `Incarichi` (`id`, `tipo`) VALUES
(1, 'Proprietario'),
(2, 'Dirigente Generale'),
(3, 'Consulente'),
(4, 'Altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `Preferiti`
--

CREATE TABLE IF NOT EXISTS `Preferiti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dump dei dati per la tabella `Preferiti`
--

INSERT INTO `Preferiti` (`id`, `id_aziende`, `id_clienti`) VALUES
(13, 29, 1),
(18, 35, 1),
(23, 1, 1),
(24, 37, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Qualita_Prezzo`
--

CREATE TABLE IF NOT EXISTS `Qualita_Prezzo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensioni`
--

CREATE TABLE IF NOT EXISTS `Recensioni` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `data` varchar(32) DEFAULT NULL,
  `recensione` varchar(200) DEFAULT NULL,
  `segnalato` int(1) DEFAULT NULL,
  `valido` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

--
-- Dump dei dati per la tabella `Recensioni`
--

INSERT INTO `Recensioni` (`id`, `id_aziende`, `id_clienti`, `data`, `recensione`, `segnalato`, `valido`) VALUES
(1, 1, 1, '27/06/2016', 'recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1 recentione 1', 0, 0),
(2, 1, 1, '27/06/2016', 'recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 recensione 2 ', 0, 0),
(3, 1, 1, '27/06/2016', 'recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 recensione 3 ', 0, 0),
(4, 1, 1, '27/06/2016', 'recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 recension 4 ', 0, 0),
(5, 1, 1, '27/06/2016', 'recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 recensione 5 ', 0, 0),
(6, 1, 1, '27/06/2016', 'recensione 6', 0, 0),
(7, 1, 1, '27/06/2016', 'recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 recensione 7 ', 0, 0),
(8, 1, 1, '27/06/2016', 'recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 recensione 8 ', 0, 0),
(9, 1, 1, '27/06/2016', 'recensione 9', 0, 0),
(10, 1, 1, '27/06/2016', 'recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 recensione 10 ', 0, 0),
(11, 1, 1, '27/06/2016', 'recensione 11 recensione 11 recensione 11 recensione 11 recensione 11 recensione 11 recensione 11 recensione 11 recensione 11 ', 1, 0),
(12, 1, 1, '27/06/2016', 'recensione 12 recensione 12 recensione 12 recensione 12', 1, 0),
(13, 1, 1, '27/06/2016', 'recensione 13', 1, 0),
(14, 1, 1, '27/06/2016', 'recensione 14', 1, 0),
(15, 1, 1, '27/06/2016', 'recensione 15', 0, 0),
(16, 1, 1, '27/06/2016', 'recensione 16', 1, 0),
(17, 1, 1, '27/06/2016', 'recensione 17\n', 1, 0),
(18, 1, 2, '29/06/2016', 'recensione scritta da Luigi 1', 1, 0),
(19, 1, 2, '29/06/2016', 'recensione scritta da Luigi 2', 1, 0),
(20, 1, 3, '30/06/2016', 'COMMENTO OFFENSIVO 1', 1, 0),
(21, 1, 3, '30/06/2016', 'COMMENTO OFFENSIVO 2', 1, 1),
(22, 1, 2, '08/07/2016', 'test recensione', 0, 0),
(23, 1, 2, '08/07/2016', 'jkkjk', 0, 0),
(24, 37, 2, '08/07/2016', 'sfsdfsdfsdfsdf', 0, 0),
(25, 37, 2, '08/07/2016', 'ljojuopi', 0, 0),
(26, 37, 2, '08/07/2016', 'pipipipipip', 0, 0),
(27, 1, 2, '08/07/2016', 'test', 0, 0),
(28, 1, 2, '08/07/2016', 'adsfdsafadf', 0, 0),
(29, 1, 2, '08/07/2016', 'rertetetet', 0, 0),
(30, 1, 2, '08/07/2016', 'ldjflakjflakjdflkajflkaj', 0, 0),
(31, 1, 2, '08/07/2016', 'retertert', 0, 0),
(32, 1, 2, '08/07/2016', 'lkjsldkfjlasdjfla', 0, 0),
(33, 1, 2, '08/07/2016', 'lkjsldkfjlasdjfla', 0, 0),
(34, 1, 2, '08/07/2016', 'ciao', 0, 0),
(35, 1, 2, '08/07/2016', 'ciao', 0, 0),
(36, 1, 1, '08/07/2016', 'test11111', 0, 0),
(37, 1, 1, '08/07/2016', 'testwweqweqe', 0, 0),
(38, 1, 1, '08/07/2016', 'gfgfgfgf', 0, 0),
(39, 1, 1, '08/07/2016', 'gfgfgfgf', 0, 0),
(40, 1, 1, '08/07/2016', 'gigi ', 0, 0),
(41, 1, 1, '08/07/2016', '656565656', 0, 0),
(42, 1, 1, '08/07/2016', 'jkjkjkjkjkjk', 0, 0),
(43, 1, 1, '08/07/2016', 'jkjkjkjkjkjk', 0, 0),
(44, 37, 1, '08/07/2016', 'nuovo commento', 0, 0),
(45, 37, 1, '09/07/2016', 'test nuovo commento', 0, 0),
(46, 37, 1, '09/07/2016', 'test nuovo commento', 0, 0),
(47, 37, 1, '09/07/2016', 'asfdadf', 0, 0),
(48, 37, 1, '09/07/2016', 'asfdadf', 0, 0),
(49, 37, 1, '09/07/2016', 'nuovo inserimento', 0, 0),
(50, 37, 1, '09/07/2016', 'nuovo inserimento', 0, 0),
(51, 37, 1, '09/07/2016', 'altro inserimento', 0, 0),
(52, 37, 1, '09/07/2016', 'altro inserimento', 0, 0),
(53, 37, 1, '09/07/2016', 'nuovo', 0, 0),
(54, 37, 1, '09/07/2016', 'nuovo', 0, 0),
(55, 37, 1, '09/07/2016', '', 0, 0),
(56, 37, 1, '09/07/2016', 'tertert', 0, 0),
(57, 37, 1, '09/07/2016', 'dfdgdgdgdgdddddddddddddddd', 1, 0),
(58, 1, 1, '09/07/2016', 'RTYTRYNE ', 0, 0),
(59, 1, 1, '09/07/2016', 'RTYTRYNE ', 0, 0),
(60, 1, 1, '09/07/2016', 'RTYTRYNE ', 0, 0),
(61, 1, 1, '09/07/2016', 'rerrerererrere', 0, 0),
(62, 1, 1, '09/07/2016', 'rerrerererrere', 0, 0),
(63, 37, 1, '09/07/2016', 'test nuovo commento 1', 1, 0),
(64, 37, 1, '09/07/2016', 'yrgsdfg', 1, 0),
(65, 37, 1, '09/07/2016', 'yrgsdfg', 1, 0),
(66, 1, 1, '09/07/2016', 'tetwetwet', 0, 0),
(67, 1, 1, '09/07/2016', 'tetwetwet', 0, 0),
(68, 1, 1, '09/07/2016', 'tetwetwet', 0, 0),
(69, 37, 1, '09/07/2016', 'werwerwrewerwerwerwewewerwwwwwwwwwww', 1, 0),
(70, 37, 1, '09/07/2016', 'werwerwrewerwerwerwewewerwwwwwwwwwww', 1, 0),
(71, 37, 1, '09/07/2016', 'tyrtyry', 1, 0),
(72, 1, 1, '09/07/2016', 'ytuyut', 0, 0),
(73, 1, 1, '09/07/2016', 'afadfasdfasdfsdfasdfafadfa', 0, 0),
(74, 1, 1, '09/07/2016', 'sdfsdfafsdfsdfsadfasdfdssdf', 0, 0),
(75, 1, 1, '09/07/2016', 'sdfsdfafsdfsdfsadfasdfdssdf', 0, 0),
(76, 1, 1, '09/07/2016', 'dsfadsfafdafdsfasdfasdcvcccc', 0, 0),
(77, 1, 1, '09/07/2016', 'dsfadsfafdafdsfasdfasdcvcccc', 0, 0),
(78, 1, 1, '09/07/2016', '2324r23v23v32', 0, 0),
(79, 1, 1, '09/07/2016', '2324r23v23v32', 1, 0),
(80, 1, 1, '09/07/2016', 'sdsadfafdaf', 1, 0),
(81, 1, 1, '09/07/2016', 'sdfasfda', 1, 0),
(82, 1, 1, '09/07/2016', 'sadfasdfadf', 1, 0),
(83, 1, 1, '09/07/2016', 'kyuiyuiyuiyuiyuiyiyiy', 1, 0),
(84, 1, 1, '09/07/2016', 'test di inserimento 4\r\n', 1, 0),
(85, 1, 1, '09/07/2016', 'test di inserimento 4\r\n', 1, 0),
(86, 25, 1, '09/07/2016', 'test', 0, 0),
(87, 3, 1, '09/07/2016', 'test 2343244', 0, 0),
(88, 3, 1, '09/07/2016', 'tatetaet ea afa dfad fasdf asd fafd asfa', 0, 0),
(89, 3, 1, '09/07/2016', 'dsf asdf asdf adf dsf sadf ', 0, 0),
(90, 3, 1, '09/07/2016', 'test di inserimento di un altro commento', 0, 0),
(91, 3, 1, '09/07/2016', 'altro commento ancora', 0, 0),
(92, 3, 1, '09/07/2016', 'altro commento ancora', 0, 0),
(93, 3, 1, '09/07/2016', 'altra recensione\r\nsasdfas', 0, 0),
(94, 3, 1, '09/07/2016', 'tesartare', 0, 0),
(95, 1, 1, '14/07/2016', 'dfgsdfgsfgs', 0, 0),
(96, 1, 1, '14/07/2016', 'hfghfghfghdfg', 0, 0),
(97, 1, 1, '14/07/2016', 'hfghfghfghdfg', 0, 0),
(98, 1, 1, '14/07/2016', 'dsagasgasg', 0, 0),
(99, 1, 1, '14/07/2016', 'dsagasgasg', 0, 0),
(100, 1, 1, '14/07/2016', 'fgsdfgsg', 0, 0),
(101, 1, 1, '14/07/2016', 'fgsdfgsg', 0, 0),
(102, 1, 1, '14/07/2016', 'fgsdfgsg', 0, 0),
(103, 1, 1, '14/07/2016', 'ghrhgrtsg', 0, 0),
(104, 1, 1, '14/07/2016', 'ghrhgrtsg', 0, 0),
(105, 1, 1, '14/07/2016', 'sdDFF', 0, 0),
(106, 1, 1, '14/07/2016', 'sdDFF', 0, 0),
(107, 1, 1, '14/07/2016', 'DFAFAD', 0, 0),
(108, 1, 1, '14/07/2016', 'DFAFAD', 0, 0),
(109, 1, 1, '14/07/2016', 'SDFSDAFSADFSDFSDA', 0, 0),
(110, 1, 1, '14/07/2016', 'ASDFASD', 0, 0),
(111, 1, 1, '15/07/2016', 'fgsdfgsdgf', 0, 0),
(112, 1, 1, '15/07/2016', 'fgsdfgsdgf', 0, 0),
(113, 1, 1, '15/07/2016', 'HGDFHDH', 0, 0),
(114, 1, 1, '15/07/2016', 'HGDFHDH', 0, 0),
(115, 1, 1, '15/07/2016', 'AFASDFA', 0, 0),
(116, 1, 1, '15/07/2016', 'AFASDFA', 0, 0),
(117, 1, 1, '15/07/2016', 'GSDGSGS', 0, 0),
(118, 1, 1, '15/07/2016', 'AFADFAFA', 0, 0),
(119, 1, 1, '15/07/2016', 'dfafda', 0, 0),
(120, 1, 1, '15/07/2016', 'dfafda', 0, 0),
(121, 1, 1, '15/07/2016', 'sadfasdf asdf asdf asdf ', 0, 0),
(122, 1, 1, '15/07/2016', 'afaf', 0, 0),
(123, 1, 1, '15/07/2016', 'dsfafafa', 0, 0),
(124, 1, 1, '15/07/2016', 'afada', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Segnalazioni`
--

CREATE TABLE IF NOT EXISTS `Segnalazioni` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_recensioni` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_recensioni` (`id_recensioni`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Servizi`
--

CREATE TABLE IF NOT EXISTS `Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `Servizi`
--

INSERT INTO `Servizi` (`id`, `tipo`) VALUES
(1, 'Accesso disabili'),
(2, 'Accetta carte di credito'),
(3, 'Accetta prenotazioni'),
(4, 'Bagno diponibile'),
(5, 'Bancomat'),
(6, 'Bevande alcoliche'),
(7, 'Catering'),
(8, 'Consegna a domicilio'),
(9, 'Da asporto'),
(10, 'Guardaroba disponibile'),
(11, 'Musica'),
(12, 'Parcheggio auto'),
(13, 'Parcheggio bici'),
(14, 'Per fumatori'),
(15, 'Posti a sedere all''aperto'),
(16, 'Stanza privata'),
(17, 'Tv'),
(18, 'Wi-Fi');

-- --------------------------------------------------------

--
-- Struttura della tabella `Statistiche`
--

CREATE TABLE IF NOT EXISTS `Statistiche` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `visualizzazioni` int(11) DEFAULT '0',
  `media_voto` float DEFAULT '0',
  `numero_voti` int(11) NOT NULL DEFAULT '0',
  `media_rapporto_qualita_prezzo` float DEFAULT '0',
  `numero_voti_qualita_prezzo` int(11) NOT NULL DEFAULT '0',
  `numero_preferenze` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dump dei dati per la tabella `Statistiche`
--

INSERT INTO `Statistiche` (`id`, `id_aziende`, `visualizzazioni`, `media_voto`, `numero_voti`, `media_rapporto_qualita_prezzo`, `numero_voti_qualita_prezzo`, `numero_preferenze`) VALUES
(1, 1, 43, 0, 0, 0, 0, 58),
(2, 2, 1, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0),
(4, 4, 1, 0, 0, 0, 0, 0),
(5, 5, 0, 0, 0, 0, 0, 0),
(6, 6, 2, 0, 0, 0, 0, 0),
(7, 7, 3, 0, 0, 0, 0, 0),
(8, 8, 0, 0, 0, 0, 0, 0),
(9, 9, 0, 0, 0, 0, 0, 0),
(10, 10, 1, 0, 0, 0, 0, 0),
(11, 11, 0, 0, 0, 0, 0, 0),
(12, 12, 0, 0, 0, 0, 0, 0),
(13, 13, 0, 0, 0, 0, 0, 0),
(14, 14, 0, 0, 0, 0, 0, 0),
(15, 15, 3, 0, 0, 0, 0, 0),
(16, 16, 3, 0, 0, 0, 0, 0),
(17, 17, 0, 0, 0, 0, 0, 1),
(18, 18, 0, 0, 0, 0, 0, 0),
(19, 19, 0, 0, 0, 0, 0, 0),
(20, 20, 0, 0, 0, 0, 0, 0),
(21, 21, 0, 0, 0, 0, 0, 0),
(22, 22, 0, 0, 0, 0, 0, 0),
(23, 23, 0, 0, 0, 0, 0, 0),
(24, 24, 0, 0, 0, 0, 0, 0),
(25, 25, 0, 0, 0, 0, 0, 0),
(26, 26, 0, 0, 0, 0, 0, 0),
(27, 27, 0, 0, 0, 0, 0, 6),
(28, 28, 0, 0, 0, 0, 0, 0),
(29, 29, 0, 0, 0, 0, 0, 2),
(30, 30, 0, 0, 0, 0, 0, 0),
(31, 31, 0, 0, 0, 0, 0, 0),
(32, 32, 0, 0, 0, 0, 0, 0),
(33, 33, 0, 0, 0, 0, 0, 0),
(34, 34, 0, 0, 0, 0, 0, 0),
(35, 35, 0, 0, 0, 0, 0, 3),
(36, 36, 0, 0, 0, 0, 0, 0),
(37, 37, 5, 0, 0, 0, 0, 41),
(38, 38, 0, 0, 0, 0, 0, 0),
(39, 39, 0, 0, 0, 0, 0, 0),
(40, 40, 0, 0, 0, 0, 0, 0),
(41, 41, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Voti`
--

CREATE TABLE IF NOT EXISTS `Voti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_clienti` (`id_clienti`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Aziende`
--
ALTER TABLE `Aziende`
  ADD CONSTRAINT `Aziende_ibfk_1` FOREIGN KEY (`tipo_incarichi_id`) REFERENCES `Incarichi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_ibfk_2` FOREIGN KEY (`tipo_attivita_id`) REFERENCES `Attivita` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_ibfk_3` FOREIGN KEY (`tipo_attivita_id`) REFERENCES `Attivita` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Aziende_Servizi`
--
ALTER TABLE `Aziende_Servizi`
  ADD CONSTRAINT `Aziende_Servizi_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_Servizi_ibfk_2` FOREIGN KEY (`id_servizi`) REFERENCES `Servizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_Servizi_ibfk_3` FOREIGN KEY (`id_servizi`) REFERENCES `Servizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Preferiti`
--
ALTER TABLE `Preferiti`
  ADD CONSTRAINT `Preferiti_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Preferiti_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Preferiti_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Qualita_Prezzo`
--
ALTER TABLE `Qualita_Prezzo`
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Recensioni`
--
ALTER TABLE `Recensioni`
  ADD CONSTRAINT `Recensioni_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recensioni_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recensioni_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Segnalazioni`
--
ALTER TABLE `Segnalazioni`
  ADD CONSTRAINT `Segnalazioni_ibfk_1` FOREIGN KEY (`id_recensioni`) REFERENCES `Recensioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Segnalazioni_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Statistiche`
--
ALTER TABLE `Statistiche`
  ADD CONSTRAINT `Statistiche_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Voti`
--
ALTER TABLE `Voti`
  ADD CONSTRAINT `Voti_ibfk_1` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Voti_ibfk_2` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Voti_ibfk_3` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

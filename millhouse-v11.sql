CREATE DATABASE  IF NOT EXISTS `millhouse` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `millhouse`;
-- MySQL dump 10.13  Distrib 5.6.17, for osx10.6 (i386)
--
-- Host: localhost    Database: millhouse
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adress2`
--

DROP TABLE IF EXISTS `adress2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adress2` (
  `adress2_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `street1` varchar(100) DEFAULT NULL,
  `street2` varchar(100) DEFAULT NULL,
  `zip` int(10) unsigned DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`adress2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adress2`
--

LOCK TABLES `adress2` WRITE;
/*!40000 ALTER TABLE `adress2` DISABLE KEYS */;
/*!40000 ALTER TABLE `adress2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) DEFAULT NULL,
  `description` text,
  `title` varchar(45) DEFAULT NULL,
  `Inactive` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'img/category/watches.jpeg','Letar du efter snygga klockor eller armbandsur? Vi väljer noggrant ut de mest attraktiva och prisvärda klockorna, både för kvinnans och mannen. Hitta en accessoar som får dig att sticka ut från mängden och njut av komplimangerna.','Klockor',0),(2,'img/category/sunglass.jpg','Att bära solglasögon är ett perfekt sätt att skydda ögonen mot solens strålar och samtidigt ge din stil ett lyft. Ett par snygga solglasögon ger din look en personlig touch och drar garanterat till sig andras blickar!','Solglasögon',0),(3,'img/category/candle.jpg','Doften blir en del av din inredning. Intresset för doftljus ökar och förutom att de är vackra så sprider de en skön och hemtrevlig känsla i ditt hem. Hos oss väljer du bland många varianter och priser. Vilket blir din favorit?','Doftljus',0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `order_items_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `price` int(10) unsigned DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_items_id`),
  KEY `product_id_idx` (`product_id`),
  KEY `order_id_idx` (`order_id`),
  CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,22,159,2),(2,1,1,2229,1),(3,3,20,159,3),(4,4,3,2549,1);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `order_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` VALUES (1,NULL,'Behandlad'),(2,NULL,'Skickad'),(3,NULL,'Levererad');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned DEFAULT NULL,
  `shipper_id` int(10) unsigned DEFAULT NULL,
  `payment_id` int(10) unsigned DEFAULT NULL,
  `order_status_id` int(10) unsigned DEFAULT NULL,
  `adress2_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `order_status_id_idx` (`order_status_id`),
  KEY `shipper_id_idx` (`shipper_id`),
  KEY `person_id_idx` (`person_id`),
  KEY `payment_id_idx` (`payment_id`),
  KEY `adress_id_idx` (`adress2_id`),
  CONSTRAINT `adress2_id` FOREIGN KEY (`adress2_id`) REFERENCES `adress2` (`adress2_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_status_id` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `shipper_id` FOREIGN KEY (`shipper_id`) REFERENCES `shipping` (`shipper_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,1,1,1,NULL,'2017-03-14 16:12:37'),(3,NULL,1,1,2,NULL,'2017-03-14 16:14:10'),(4,NULL,2,2,1,NULL,'2017-03-14 16:14:37');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `pages_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `content1` text,
  `content2` text,
  `head_img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Om Oss','Maecenas sed diam eget risus varius blandit sit amet non magna. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Cras mattis consectetur purus sit amet fermentum. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.','hejsanhejjappsdf,mn,dmsnf','img/inspo/about.jpg'),(2,'Bli medlem i Millhouse More!','När du blir medlem i vår kundklubb Millhouse More får du 10% rabatt på ditt första köp. ','Bli medlem nu','img/inspo/sunglass_inspo5.png');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(45) DEFAULT NULL,
  `payment_allowed` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,'Kortbetalning',1),(2,'Paypal',1),(3,'Klarna',0),(4,'Direktbetalning via bank',1);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `street1` varchar(100) DEFAULT NULL,
  `street2` varchar(100) DEFAULT NULL,
  `zip` int(10) unsigned DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `newletter` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `person_id_UNIQUE` (`person_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (12,'Admin','','admin@millhouse','','',0,'','',NULL,'2017-03-30 11:14:32',NULL,2,'8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',1),(13,'Kund','','kund@kund','','',0,'','',1,'2017-03-30 11:15:11',NULL,1,'2a69e508ef042879b2f9bc1f226ae7ed80621d0554bf768cbcc07c559c99ac40',1),(14,'Kund1','','kund1@kund1','','',0,'','',1,'2017-03-30 11:15:41',NULL,1,'6b8cf4833e98d4e75d5b170e7a087764cee0f45e09754dbdfa4e7f1d00c9116b',1);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `price` int(10) unsigned DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `Inactive` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (0,NULL,NULL,NULL,NULL,NULL,0),(1,2,'Rayban','En beskrivning av produkten',2239,NULL,0),(2,2,'Calvin Clein','En beskrivning av produkten',1099,NULL,0),(3,2,'Carrera','Dessa rektangulära solglasögon från Carrera har  gråa linser, som komplementerar den matta svarta ramen. Märkets logga syns längs skalmarna och även i hörnet på den högra linsen. Levereras med två års garanti hos tillverkaren.',2549,NULL,0),(4,2,'Dolce & Gabbana','Dolce and Gabbanas signaturlook med animaliska mönster ser du under crystal-lagret på de här solglasögonen. Den djärva och överdimensionerade retro-formen är lika chic som den är smickrande. Dolce and Gabbanas logotyp ser du i metall på sidorna. Skalmarna  har eleganta metalldetaljer för en snygg finish. Den här bågen är handgjord i Italien av acetat i högsta kvalitet. UV400-skyddande glas med polarisation så att du slipper bländande reflexer. Med två års fabriksgaranti.',3299,NULL,0),(5,2,'Diesel','En beskivning av produkten',999,NULL,0),(6,2,'Gucci','En beskrivning',3299,NULL,0),(7,2,'Marc by marc jacobs','Marc by Marc Jacobs mönster är en av de hetaste den här säsongen. De här wayfarer-bågarna har det vackra mönstret på sig. Det tidlösa havanamönstret ger bågen den perfekta twisten. Skalmarna är läckert rosa. Du ser ståltråden genom skalmarna på sidorna som också har Marc Jacobs logotyp för en extra rosa färgklick. De trendiga multifärgade glasen ger dem en ännu vackrare och trendig finish. Metalldetaljerna på sidorna ger den ett polerat utseende. Handgjorda i Italien. UV400-glas. Marc by Marc Jacobs solglasögon levereras med ett års garanti från tillverkaren.',2399,NULL,0),(8,2,'Marc Jacobs','En beskrivning',1899,NULL,0),(9,2,'Ralph Lauren','Ralph Lauren var ett av de första designermärkerna att lansera en lifestyle-kollektion.  Det lekfulla mönstret hamnar i blickfånget när du vrider på huvudet. Ralph Laurens metallogo pryder skalmarna och glittrar i solskenet. De är dessutom gjorda för hand av högkvalitativt acetat. Glasen har 100 % UV-skydd och solglasögonen levereras med två års garanti från tillverkaren.',2199,NULL,0),(10,2,'Rayban','Den vackra och vintageinspirerade Ray-Ban Gatsby I ger dig all uppmärksamhet men sin slimmade, kurvade brynlinje och näsbrygga. Den havanamönstrade ramen är matchad med gröna linser för ett klassiskt utseende. Tillverkade för hand i Italien. UV400-skyddande linser. Levereras med två års garanti från tillverkaren.',3899,NULL,0),(11,2,'Tom Ford','De här solglasögonen från Tom Ford har en distinkt wayfarerform och en båge av acetat. Skalmarna är dekorerade med Tom Fords klassiska T-logo och solglasögonen kommer också med ett medföljande fodral och rengöringsduk. Glasen skyddar mot 100 % av alla UV-strålar. Bågen är handgjord i Italien. Tom Fords solglasögon levereras med två års garanti.  Färgkod: 01F Glaskategori: 2 Glas(mm) : 53 Näsbrygga(mm) : 20 Skalm(mm) : 145',3790,NULL,0),(12,2,'Yves Saint Laurent','Classic 8 från Saint Laurent är en överdimensionerad och lätt fyrkantigt båge som är tillverkad av förstklassigt acetat. Saint Laurents ikoniska \'Corner Angle\' (metalldetaljen) syns på båda sidorna av bågfronten. Modehusets bokstavslogotyp pryder skalmarna och försäkrar autenticitet. De nedre delarna av skalmarna är raka och ger en modern finish till bågen. UV400-skyddande linser. Levereras med två års garanti hos tillverkaren.',2549,NULL,0),(13,3,'Voluspa apricot & aprilia','Maison Noirs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på svart botten. I serien finns dofter som är både unika och välbekanta. En modern och lyxig doftkollektion för hemmet, unik i sitt slag.\nApricot & Aprilia Classic från Voluspa är ännu en härlig doft ur doftljusens okrönte kungs utbud. Denna gång är det en härlig doft av nyskivade aprikoser och liljeblommor som fyller rummet. Brinntid: 50 timmar. Primära dofter: Aprikos & Liljor. Doftfamilj: Fruktig',159,NULL,0),(14,3,'Voluspa mokara','Voluspa Japonica Candle Collection är en hyllning till vackra japanska konstverk. Känsliga traditionella japanska blommönster tillämpas på Voluspa\'s hittills mest kreativa doftpalett.\nDoftljus, chawan med lock. Voluspa Mokara kombinerar mokaraorkidé, vit lilja och vårens mossor som skapar en ljus, ren och blommig doft. Brinntid: 50 timmar. Doftfamilj: blommor. Limited Edition.',159,NULL,0),(15,3,'Voluspa ambre lumiere','Maison Noirs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på svart botten. I serien finns dofter som är både unika och välbekanta. En modern och lyxig doftkollektion för hemmet, unik i sitt slag.\nAmbre Lumiere Classic från Voluspa är ännu en härlig doft ur doftljusens okrönte kungs utbud. Denna gång är det en fräsch doft av indonesisk patchouli, vanilj och ljus bärnsten som fyller rummet. Brinntid: 50 timmar. Primära dofter: Patchouli, vanilj och bärnsten. Doftfamilj: Jordnära',169,NULL,0),(16,3,'Voluspa moso bamboo','Voluspa Japonica Candle Collection är en hyllning till vackra japanska konstverk. Känsliga traditionella japanska blommönster tillämpas på Voluspa\'s hittills mest kreativa doftpalett.\nMoso Bamboo från Voluspa kombinerar Moso-bambu, svart musk och japansk cypress vilket skapar en lockande, sensuell doft. Brinntid: 50 timmar. Doftfamilj: grön. Limited Edition.',269,NULL,0),(17,3,'Voluspa bourbon vanille','Voluspa Vermeil Candle Collection är inspirerad av Vermeil silver vilket ger en rik lyster och handblåst vintage stil som är exklusivt för Voluspa. Sällsynta dofter i en luxuös palette skapar säsongens nya favoriter.\nBourbon Vanille har en doft av äkta bourbonvaniljstång. 50 timmars brinntid.',159,NULL,0),(18,3,'Voluspa saijo persimmon','Voluspakollektionen Maison Blanc kännetecknas av den sofistikerade lyx som lojala kunder alltid förväntar sig av Voluspa. Maison Blancs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på vit botten.\nJapansk persimon i kombination med röda vinbär och persika utgör en underbar gourmand doft. Brinntid: 50 timmar. Primära dofter: Persika, Persimmon, Röda vinbär Doftfamilj: Fruktig.',159,NULL,0),(19,3,'Voluspa macaron','Voluspakollektionen Maison Blanc kännetecknas av den sofistikerade lyx som lojala kunder alltid förväntar sig av Voluspa. Maison Blancs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på vit botten.\nParis vackra Macarons är kända både för sina färgstarka nyanser och för sina underbara aromer. Här återskapas de små bakverken i ett doftljus från Voluspa. Brinntid: 50 timmar. Primära dofter: Macaron. Doftfamilj: Söt.',159,NULL,0),(20,3,'Voluspa crisp champagne','Maison Noirs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på svart botten. I serien finns dofter som är både unika och välbekanta. En modern och lyxig doftkollektion för hemmet, unik i sitt slag.\nCrisp Champagne Classic från Voluspa doftar som sprudlande torr champagne som blandas med noter av vanilj och ekfat. En klassiker bland Voluspas doftljus. Brinntid: 50 timmar. Primära dofter: Champagne, Ek & Vanilj. Doftfamilj: Söt.',159,NULL,0),(21,3,'Voluspa prosecco bellini','Voluspakollektionen Maison Blanc kännetecknas av den sofistikerade lyx som lojala kunder alltid förväntar sig av Voluspa. Maison Blancs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på vit botten.\nBehaglig doft av persikoskal med söta urkärnade aprikoser sammanrört med fint socker och iskall, mousserande Prosecco. Brinntid: 50 timmar. 312 gram.',159,NULL,0),(22,3,'Voluspa prosecco rosé','Voluspa Vermeil Candle Collection är inspirerad av Vermeil silver vilket ger en rik lyster och handblåst vintage stil som är exklusivt för Voluspa. Sällsynta dofter i en luxuös palette skapar säsongens nya favoriter.\r\nKyld roséchampagne hälls över svarta vinbär och delikata vita rosenblad för att skapa denna doftkombination. 50 timmars brinntid.',159,NULL,0),(23,3,'Voluspa branche vermeil','Voluspa Vermeil Candle Collection är inspirerad av Vermeil silver vilket ger en rik lyster och handblåst vintage stil som är exklusivt för Voluspa. Sällsynta dofter i en luxuös palette skapar säsongens nya favoriter.\nBranche Vermeil har en doft av frisk vintergran och diskreta inslag av citron, balsam och sötma. 60 timmars brinntid.',449,NULL,0),(24,3,'Voluspa mandarino cannela','Maison Noirs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på svart botten. I serien finns dofter som är både unika och välbekanta. En modern och lyxig doftkollektion för hemmet, unik i sitt slag.\nMandarino Cannela doftar italienska apelsiner med en hint av grädde, vanilj och kanel som blandas med muskotnöt. Brinntid: 50 timmar. 312 gram.',159,NULL,0),(25,3,'Voluspa pink citron','Voluspakollektionen Maison Blanc kännetecknas av den sofistikerade lyx som lojala kunder alltid förväntar sig av Voluspa. Maison Blancs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på vit botten.\nPink Citron har en doft av mogen grapefrukt och saftig citron med inslag av syrlig cassis och en diskret hjärtnot av ros. Brinntid: 50 timmar. Primära dofter: Cassis, Citrus & Grapefrukt. Doftfamilj: Citrus.',159,NULL,0),(26,3,'Voluspa laguna','Voluspakollektionen Maison Blanc kännetecknas av den sofistikerade lyx som lojala kunder alltid förväntar sig av Voluspa. Maison Blancs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på vit botten.\nSammetsmjuk sand och ett bländande blått hav. De milda Santa Ana-vindarna som för med sig varm ökenluft till Stilla havet. Brinntid: 50 timmar. Primära dofter: Hav. Doftfamilj: Strand.',159,NULL,0),(27,3,'Voluspa pomegranate blood orange','Maison Noirs traditionsinspirerade förpackningar ger en modern känsla med sina förgyllda och dekorativa mönster på svart botten. I serien finns dofter som är både unika och välbekanta. En modern och lyxig doftkollektion för hemmet, unik i sitt slag.\nPomegranate Blood Orange kombinerar moget granatäpple med mix från blodapelsin, champagnebubbel och nektarinklyftor. Brinntid: 50 timmar. 312 gram.',248,NULL,0),(28,1,'Fossil Townsman','Perfekt vardagsklocka från Fossil som passar till det mesta i din garderob. Modellen kommer med svart urtavla boett i rostfritt stål och armband i bru',1295,NULL,0),(29,1,'Fossil Townsman','Perfekt vardagsklocka från Fossil som passar till det mesta i din garderob. Modellen kommer med svartpläterad boett i rostfritt stål och armband i ljusbrunt läder.',3490,NULL,0),(30,1,'Fossil The Commuter 3H','En beskrivning av produkten',3190,NULL,0),(31,1,'Fossil Grant','Stor klocka med rejäl boett och en kraftig länk. I urtavlan har klockan stora romerska siffror vilket gör klockan mer originell i sitt klassiska utseende. Klockan är även försedd med kronograf för tidtagning. En vattenskyddad, snygg vardagsklocka.',2490,NULL,0),(32,1,'Fossil Jacqueline','Feminin klocka med en klassisk tvist. Läderarmbandet är smalt och har en matt, mockaliknande yta i kombination med en blankpolerad boett i roséfärgat stål. Klockan är försedd med datum och är vattenskyddad för att tåla visst regnstänk och att tvätta händerna.',1990,NULL,0),(33,1,'Gant Park Hill II','En sofistikerad och snygg vardagsklocka med en bicolorfärgad boett och länk i stål som fäster till en stilfull och följsam länk. Klockan har en vit urtavla med guldfärgade, eleganta index och datumvisning i den lilla urtavlan kl 3. Perfekt för en vanlig dag på kontoret!',1890,NULL,0),(34,1,'Gant Park Hill III','Modern kostymklocka som passar på kontoret, vintageinspirerat till lata dagar på landet eller sportinspirerat till skidsemestern. Till personen som gärna byter klocka efter humör och tillfälle. Modell som gjort sig populär i alla åldrar med sin enkla design och klassiska stil. Modern kostymklocka med silverfärgad stållänk, stilren urtavla med datumvisning och silverfärgad boett.',3290,NULL,0),(35,1,'Marc By Marc Jacobs','Till tjejen som lägger tid och energi på att leta efter de senaste accessoarerna. Hon matchar gärna också klockan med andra armband och smycken. När klockan blir ett trendriktigt smycke mer än ett hjälpmedel för att hålla reda på tiden. En stilren klocka som är lätt att matcha med andra smycken eller snygg i sin enkelhet.',2495,NULL,0),(36,1,'Michael Kors Mini Parker','Till den trendmedvetna tjejen som med noggrannhet och omsorg plockar ut välarbetade accessoarer. Hon bär klockan som ett smycke mer än ett hjälpmedel för att komma i tid och byter gärna klocka efter tillfälle och humör. Den vackert utsmyckade klockan är väldigt feminin och passar perfekt till fest. Urtavlan är även utsmyckad med stenar runt om hela boetten och även i urtavlan.',1595,NULL,0),(37,1,'Tissot PRS 516 Quartz','En sportig racinginspirerad herrklocka i rosfritt stål, svart keramisk boettring och läderband. Denna schweiziska klocka är vattentät till 100m och utrustad med kronograffunktion, reptåligt safirglas och viklås. ',3890,NULL,0),(38,1,'Tissot Couturier Automatic','En beskrivning av produkten',4290,NULL,0),(39,1,'Victorinox Chrono Classic','En beskrivning av produkten',5290,NULL,0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_img`
--

DROP TABLE IF EXISTS `product_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_img` (
  `product_img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_img_id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `prod_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_img`
--

LOCK TABLES `product_img` WRITE;
/*!40000 ALTER TABLE `product_img` DISABLE KEYS */;
INSERT INTO `product_img` VALUES (1,1,'img/products/Solglasögon/Armani2.jpg'),(2,2,'img/products/Solglasögon/Calvinklein2.jpg'),(3,3,'img/products/Solglasögon/Carrera2.jpg'),(4,4,'img/products/Solglasögon/D_G2.jpg'),(5,5,'img/products/Solglasögon/Diesel2.jpg'),(6,6,'img/products/Solglasögon/Gucci2.jpg'),(7,7,'img/products/Solglasögon/marcbymarc2.jpg'),(8,8,'img/products/Solglasögon/Marcjacobs2.jpg'),(9,9,'img/products/Solglasögon/Ralphlauren2.jpg'),(10,10,'img/products/Solglasögon/Rayban2.jpg'),(11,11,'img/products/Solglasögon/Tomford2.jpg'),(12,12,'img/products/Solglasögon/Ysl2.jpg'),(13,13,'img/products/doftljus/voulspa1.jpg'),(14,14,'img/products/doftljus/voulspa2.jpg'),(15,15,'img/products/doftljus/voulspa3.jpg'),(16,16,'img/products/doftljus/voulspa4.jpg'),(17,17,'img/products/doftljus/voulspa5.jpg'),(18,18,'img/products/doftljus/voulspa6.jpg'),(19,19,'img/products/doftljus/voulspa7.jpg'),(20,20,'img/products/doftljus/voulspa8.jpg'),(21,21,'img/products/doftljus/voulspa9.jpg'),(22,22,'uploads/product/voulspa10.jpg'),(23,23,'img/products/doftljus/voulspa11.jpg'),(24,24,'img/products/doftljus/voulspa12.jpg'),(25,25,'img/products/doftljus/voulspa13.jpg'),(26,26,'img/products/doftljus/voulspa14.jpg'),(27,27,'img/products/doftljus/voulspa15.jpg'),(29,29,'img/products/klockor/fossil_black_leather_m.jpg'),(30,30,'img/products/klockor/fossil_blue_leather_m.jpg'),(31,31,'img/products/klockor/fossil_blue_m.jpg'),(32,32,'img/products/klockor/fossil_nacre_leather_w.jpg'),(33,33,'img/products/klockor/gant_gold_silver_w.jpg'),(34,34,'img/products/klockor/gant_silver_w.jpg'),(35,35,'img/products/klockor/marc_gold_w.jpg'),(36,36,'img/products/klockor/michaelkors_rose_w.jpg'),(37,37,'img/products/klockor/tissot_black_m.jpg'),(38,38,'img/products/klockor/tissot_black_rose_m.jpg'),(39,39,'img/products/klockor/victorinox_brown_leather_m.jpg');
/*!40000 ALTER TABLE `product_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping` (
  `shipper_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(15) DEFAULT NULL,
  `phone` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`shipper_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
INSERT INTO `shipping` VALUES (1,'DHL',858355421),(2,'Postnord',858346777);
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-30 13:17:33

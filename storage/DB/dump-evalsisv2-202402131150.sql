-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 192.168.56.56    Database: evalsisv2
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruc_ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Acme','0987654321','1003728217001','quito','2024-02-01 17:07:48','2024-02-01 17:07:48');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_user`
--

DROP TABLE IF EXISTS `course_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `role` enum('docente','alumno') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_user_user_id_foreign` (`user_id`),
  KEY `course_user_course_id_foreign` (`course_id`),
  CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_user`
--

LOCK TABLES `course_user` WRITE;
/*!40000 ALTER TABLE `course_user` DISABLE KEYS */;
INSERT INTO `course_user` VALUES (28,2,6,'docente','2024-02-06 13:59:43','2024-02-06 13:59:43'),(36,2,7,'docente','2024-02-11 01:21:31','2024-02-11 01:21:31'),(40,3,5,'alumno','2024-02-11 05:02:16','2024-02-11 05:02:16'),(41,2,5,'docente','2024-02-11 05:04:52','2024-02-11 05:04:52'),(42,3,6,'alumno','2024-02-11 05:21:37','2024-02-11 05:21:37'),(43,5,6,'alumno','2024-02-12 00:25:51','2024-02-12 00:25:51');
/*!40000 ALTER TABLE `course_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_id_company_foreign` (`id_company`),
  CONSTRAINT `courses_id_company_foreign` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (5,1,'Algoritmos de ordenamiento en C','Curso básico de programación en C','2024-02-01 19:33:14','2024-02-11 05:06:38'),(6,1,'Angular','Curso basico de Angular','2024-02-01 20:51:39','2024-02-01 20:51:39'),(7,1,'Javascript','Curso de javascript','2024-02-04 04:10:28','2024-02-04 04:10:28'),(9,1,'TypeScript','Curso de typescript','2024-02-11 05:09:39','2024-02-11 05:09:39');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','Name',1,1,1,1,1,1,NULL,2),(3,1,'email','text','Email',1,1,1,1,1,1,NULL,3),(4,1,'password','password','Password',1,0,0,1,1,0,NULL,4),(5,1,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,5),(6,1,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(7,1,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(8,1,'avatar','image','Avatar',0,1,1,1,1,1,NULL,8),(9,1,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}',10),(10,1,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',11),(11,1,'settings','hidden','Settings',0,0,0,0,0,0,NULL,12),(12,2,'id','number','ID',1,0,0,0,0,0,NULL,1),(13,2,'name','text','Name',1,1,1,1,1,1,NULL,2),(14,2,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(15,2,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(16,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(17,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(18,3,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(19,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(20,3,'display_name','text','Display Name',1,1,1,1,1,1,NULL,5),(21,1,'role_id','text','Role',1,1,1,1,1,1,NULL,9),(22,4,'id','text','Id',1,0,0,0,0,0,'{}',1),(23,4,'name','text','Name',1,1,1,1,1,1,'{\"validation\":{\"rule\":\"required|alpha|max:255\",\"messages\":{\"required\":\"El campo Nombre es obligatorio\",\"string\":\"El Nombre debe ser una cadena de texto\",\"max\":\"El Nombre no puede tener m\\u00e1s de 255 caracteres\"}}}',2),(24,4,'phone','number','Phone',1,1,1,1,1,1,'{\"validation\":{\"rule\":\"required|numeric|digits:10\",\"messages\":{\"required\":\"El campo Tel\\u00e9fono es obligatorio\",\"numeric\":\"El Tel\\u00e9fono debe ser un valor num\\u00e9rico\",\"digits\":\"El Tel\\u00e9fono debe tener exactamente 10 d\\u00edgitos\"}}}',3),(25,4,'ruc_ci','number','Ruc Ci',1,1,1,1,1,1,'{\"optional_details\":{\"validation\":{\"rule\":\"required|numeric|digits_between:10,13\",\"messages\":{\"required\":\"El campo Cedula\\/RUC es obligatorio\",\"numeric\":\"La Cedula\\/RUC debe ser un valor num\\u00e9rico\",\"digits_between\":\"La Cedula\\/RUC debe tener entre 10 y 13 d\\u00edgitos\"}}}}',4),(26,4,'address','text','Address',1,1,1,1,1,1,'{}',5),(27,4,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',6),(28,4,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',7),(29,5,'id','text','Id',1,0,0,0,0,0,'{}',1),(30,5,'user_id','text','User Id',0,1,1,1,1,1,'{}',2),(31,5,'company_id','text','Company Id',0,1,1,1,1,1,'{}',3),(32,5,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',4),(33,5,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',5),(34,7,'id','text','Id',1,0,0,0,0,0,'{}',1),(35,7,'id_company','select_dropdown','Id Company',0,1,1,1,1,1,'{}',2),(36,7,'name','text','Name',1,1,1,1,1,1,'{}',3),(37,7,'description','text','Description',1,1,1,1,1,1,'{}',4),(38,7,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',5),(39,7,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',6),(40,8,'id','text','Id',1,0,0,0,0,0,'{}',1),(41,8,'id_course','text','Id Course',0,1,1,1,1,1,'{}',2),(42,8,'questions','text','Questions',1,1,1,1,1,1,'{}',3),(43,8,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',4),(44,8,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',5),(45,10,'id','text','Id',1,0,0,0,0,0,'{}',1),(46,10,'name','text','Name',1,1,1,1,1,1,'{}',2),(47,10,'status','checkbox','Status',1,1,1,1,1,1,'{\"on\":\"On\",\"off\":\"Off\",\"checked\":\"true\"}',3),(48,10,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',4),(49,10,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',5);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','TCG\\Voyager\\Http\\Controllers\\VoyagerUserController','',1,0,NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(2,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(3,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController','',1,0,NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(4,'companies','companies','Company','Companies',NULL,'App\\Models\\Company',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-01 17:06:45','2024-02-01 17:07:29'),(5,'user_company','user-company','User Company','User Companies',NULL,'App\\Models\\UserCompany',NULL,'App\\Http\\Controllers\\UserCompanyController',NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}','2024-02-01 17:08:27','2024-02-01 17:08:27'),(7,'courses','courses','Course','Courses',NULL,'App\\Models\\Course',NULL,'App\\Http\\Controllers\\CourseController',NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-01 17:12:35','2024-02-01 17:28:20'),(8,'exams','exams','Exam','Exams',NULL,'App\\Models\\Exam',NULL,'App\\Http\\Controllers\\ExamController',NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}','2024-02-01 20:37:53','2024-02-01 20:37:53'),(9,'my_courses_view','my-courses-view','My Courses View','My Courses Views',NULL,'App\\Models\\MyCourseView',NULL,'App\\Http\\Controllers\\MyCourseViewController',NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}','2024-02-04 03:38:58','2024-02-04 03:38:58'),(10,'matriculation_switch_views','matriculation-switch-views','Matriculation Switch View','Matriculation Switch Views',NULL,'App\\Models\\MatriculationSwitchView',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-13 11:16:45','2024-02-13 11:18:06');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_course` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `questions` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exams_id_course_foreign` (`id_course`),
  CONSTRAINT `exams_id_course_foreign` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` VALUES (20,5,'Banco de preguntas de C','Preguntas para el examen del primer bimestre de la materia C','[{\"title\": \"¿Qué palabra reservada en C se utiliza para declarar una función?\", \"responses\": [\"func\", \"fun\", \"def\", \"int\"], \"correct_asnwer_text\": \"int\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Cuál es el operador de asignación en C?\", \"responses\": [\"=\", \"==\", \":=\", \"->\"], \"correct_asnwer_text\": \"=\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el tipo de dato para almacenar números enteros en C?\", \"responses\": [\"float\", \"double\", \"int\", \"char\"], \"correct_asnwer_text\": \"int\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la función principal en un programa de C?\", \"responses\": [\"main()\", \"start()\", \"program()\", \"exec()\"], \"correct_asnwer_text\": \"main()\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cómo se comenta una sola línea en C?\", \"responses\": [\"/* comentario */\", \"// comentario\", \"-- comentario\", \"# comentario\"], \"correct_asnwer_text\": \"// comentario\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es el operador lógico para la conjunción (AND) en C?\", \"responses\": [\"&&\", \"||\", \"!\", \"&\"], \"correct_asnwer_text\": \"&&\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cómo se declara una variable en C?\", \"responses\": [\"variable nombre;\", \"nombre = variable;\", \"tipo nombre;\", \"declare nombre;\"], \"correct_asnwer_text\": \"tipo nombre;\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la forma correcta de incluir un archivo de encabezado en C?\", \"responses\": [\"#include <header.h>\", \"include <header.h>\", \"import <header.h>\", \"#import <header.h>\"], \"correct_asnwer_text\": \"#include <header.h>\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la función para obtener la longitud de una cadena en C?\", \"responses\": [\"len()\", \"length()\", \"size()\", \"strlen()\"], \"correct_asnwer_text\": \"strlen()\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Cuál es la función para imprimir en la pantalla en C?\", \"responses\": [\"console.log()\", \"print()\", \"printf()\", \"display()\"], \"correct_asnwer_text\": \"printf()\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es el operador de incremento en C?\", \"responses\": [\"++\", \"--\", \"+=\", \"*=\"], \"correct_asnwer_text\": \"++\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Qué representa el operador \'%\' en C?\", \"responses\": [\"División\", \"Resto de la división\", \"Multiplicación\", \"Exponenciación\"], \"correct_asnwer_text\": \"Resto de la división\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la sintaxis correcta para un bucle while en C?\", \"responses\": [\"mientras (condición)\", \"for (condición)\", \"while (condición)\", \"do while (condición)\"], \"correct_asnwer_text\": \"while (condición)\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es el carácter de escape para representar una nueva línea en C?\", \"responses\": [\"\\\\n\", \"\\\\r\", \"\\\\t\", \"\\\\l\"], \"correct_asnwer_text\": \"\\\\n\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cómo se compara el contenido de dos cadenas en C?\", \"responses\": [\"strcmp(cadena1, cadena2)\", \"compare(cadena1, cadena2)\", \"== (cadena1, cadena2)\", \"compareStrings(cadena1, cadena2)\"], \"correct_asnwer_text\": \"strcmp(cadena1, cadena2)\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la palabra clave para salir de un bucle en C?\", \"responses\": [\"break\", \"exit\", \"return\", \"continue\"], \"correct_asnwer_text\": \"break\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Qué función se utiliza para reservar memoria dinámicamente en C?\", \"responses\": [\"alloc()\", \"malloc()\", \"new()\", \"reserve()\"], \"correct_asnwer_text\": \"malloc()\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la declaración correcta para una estructura en C?\", \"responses\": [\"struct nombre {int x;}\", \"structure nombre {int x;}\", \"define nombre {int x;}\", \"tipo nombre {int x;}\"], \"correct_asnwer_text\": \"struct nombre {int x;}\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el operador lógico para la disyunción (OR) en C?\", \"responses\": [\"||\", \"&&\", \"!\", \"|\"], \"correct_asnwer_text\": \"||\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la función para obtener el máximo de dos números en C?\", \"responses\": [\"max()\", \"maximum()\", \"getMax()\", \"fmax()\"], \"correct_asnwer_text\": \"max()\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la función para obtener el mínimo de dos números en C?\", \"responses\": [\"min()\", \"minimum()\", \"getMin()\", \"fmin()\"], \"correct_asnwer_text\": \"min()\", \"correct_asnwer_index\": \"0\"}]','2024-02-02 16:56:56','2024-02-04 05:40:42'),(26,5,'Segundo Banco de preguntas de C','Preguntas para el examen del primer bimestre de la materia C','[{\"title\": \"¿Qué palabra reservada en C se utiliza para declarar una constante?\", \"responses\": [\"const\", \"constant\", \"var\", \"let\"], \"correct_asnwer_text\": \"const\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el operador de comparación que verifica la desigualdad en C?\", \"responses\": [\"!=\", \"==\", \"<>\", \"<=\"], \"correct_asnwer_text\": \"!=\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el tipo de dato para almacenar números con decimales en C?\", \"responses\": [\"int\", \"float\", \"double\", \"decimal\"], \"correct_asnwer_text\": \"double\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la forma correcta de definir una constante en C?\", \"responses\": [\"define PI 3.14\", \"const float PI = 3.14\", \"PI = 3.14\", \"constant PI = 3.14\"], \"correct_asnwer_text\": \"const float PI = 3.14\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es el resultado de la expresión \'5 + 3 * 2\' en C?\", \"responses\": [\"16\", \"11\", \"26\", \"13\"], \"correct_asnwer_text\": \"11\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cómo se declara un arreglo de enteros en C?\", \"responses\": [\"array nums[];\", \"int[] nums;\", \"int nums[];\", \"nums array[];\"], \"correct_asnwer_text\": \"int nums[];\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la función para obtener el valor absoluto de un número en C?\", \"responses\": [\"abs()\", \"absolute()\", \"fabs()\", \"value()\"], \"correct_asnwer_text\": \"fabs()\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la sintaxis correcta para un bucle do-while en C?\", \"responses\": [\"for (condición)\", \"do while (condición)\", \"while (condición)\", \"until (condición)\"], \"correct_asnwer_text\": \"do while (condición)\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cómo se accede al primer elemento de un arreglo en C?\", \"responses\": [\"array[0]\", \"array.first()\", \"first(array)\", \"array.at(0)\"], \"correct_asnwer_text\": \"array[0]\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el operador de desplazamiento a la derecha en C?\", \"responses\": [\">>\", \"<<\", \">>>\", \"><\"], \"correct_asnwer_text\": \"<<\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la función para leer un carácter desde la entrada estándar en C?\", \"responses\": [\"getchar()\", \"readchar()\", \"inputchar()\", \"read()\"], \"correct_asnwer_text\": \"getchar()\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la función para escribir un carácter en la salida estándar en C?\", \"responses\": [\"putchar()\", \"writechar()\", \"outputchar()\", \"write()\"], \"correct_asnwer_text\": \"putchar()\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la palabra clave para declarar una estructura en C?\", \"responses\": [\"structure\", \"type\", \"typedef\", \"struct\"], \"correct_asnwer_text\": \"struct\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Cómo se compara el contenido de dos enteros en C?\", \"responses\": [\"compareInts()\", \"== (int1, int2)\", \"int1 == int2\", \"equals(int1, int2)\"], \"correct_asnwer_text\": \"int1 == int2\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es el operador para acceder a un miembro de una estructura en C?\", \"responses\": [\".\", \"->\", \":\", \"::\"], \"correct_asnwer_text\": \"->\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Qué función se utiliza para obtener la parte entera de un número en C?\", \"responses\": [\"integer()\", \"trunc()\", \"int()\", \"floor()\"], \"correct_asnwer_text\": \"trunc()\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es el operador de asignación compuesta para sumar en C?\", \"responses\": [\"+=+\", \"=+\", \"+=\", \"++=\"], \"correct_asnwer_text\": \"+=\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la función para convertir una cadena a un número entero en C?\", \"responses\": [\"atoi()\", \"str2int()\", \"parse()\", \"stringToInt()\"], \"correct_asnwer_text\": \"atoi()\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es el operador de incremento compuesto en C?\", \"responses\": [\"++=\", \"+=\", \"inc=\", \"inc++\"], \"correct_asnwer_text\": \"++=\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cuál es la función para obtener el valor máximo de un arreglo en C?\", \"responses\": [\"maxArray()\", \"getMax()\", \"maximum()\", \"max()\"], \"correct_asnwer_text\": \"max()\", \"correct_asnwer_index\": \"3\"}]','2024-02-02 16:56:56','2024-02-04 05:40:42'),(28,6,'Primer Banco de preguntas de Angular','Preguntas para el examen del primer bimestre de la materia Angular','[{\"title\": \"¿Qué es TypeScript y cuál es su relación con Angular?\", \"responses\": [\"Un lenguaje de programación independiente de Angular\", \"Un superset de JavaScript utilizado en el desarrollo de Angular\", \"Una base de datos de Angular\", \"Un sistema operativo\"], \"correct_asnwer_text\": \"Un superset de JavaScript utilizado en el desarrollo de Angular\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la diferencia entre ngOnInit y constructor en un componente Angular?\", \"responses\": [\"Ambos son lo mismo, se pueden usar indistintamente\", \"constructor es utilizado para la inicialización y ngOnInit para la lógica posterior\", \"ngOnInit es solo para componentes secundarios\", \"constructor es específico para servicios en Angular\"], \"correct_asnwer_text\": \"constructor es utilizado para la inicialización y ngOnInit para la lógica posterior\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cómo se manejan las rutas en Angular?\", \"responses\": [\"Con la directiva ngRoute\", \"A través de la configuración de rutas en el archivo app.routing.ts\", \"Solo se pueden manejar con JavaScript puro\", \"Angular no admite enrutamiento\"], \"correct_asnwer_text\": \"A través de la configuración de rutas en el archivo app.routing.ts\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Qué es el decorador @ViewChild en Angular?\", \"responses\": [\"Una forma de aplicar estilos a un componente hijo\", \"Una manera de acceder a un elemento secundario en un componente\", \"Un método para crear vistas dinámicamente\", \"Una técnica para cambiar la detección de cambios en un componente\"], \"correct_asnwer_text\": \"Una manera de acceder a un elemento secundario en un componente\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la función de Angular Forms y cómo se implementan?\", \"responses\": [\"Manejar formularios HTML puros\", \"Facilitar la comunicación entre servidores\", \"Crear interfaces gráficas\", \"Gestionar formularios y su estado en Angular\"], \"correct_asnwer_text\": \"Gestionar formularios y su estado en Angular\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Qué es el patrón de diseño \'Inyección de Dependencias\' en Angular?\", \"responses\": [\"Un enfoque para evitar la inyección de dependencias\", \"Una técnica para reducir la modularidad\", \"Un principio para manejar la dependencia de componentes\", \"Un sistema de codificación de colores\"], \"correct_asnwer_text\": \"Un principio para manejar la dependencia de componentes\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cómo se realiza la animación en Angular?\", \"responses\": [\"Con CSS puro\", \"Utilizando el módulo de animación de Angular\", \"A través de JavaScript sin bibliotecas externas\", \"Angular no admite animaciones\"], \"correct_asnwer_text\": \"Utilizando el módulo de animación de Angular\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la diferencia entre \'declarations\', \'imports\' y \'providers\' en un módulo Angular?\", \"responses\": [\"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"\'declarations\' para servicios, \'imports\' para componentes, \'providers\' para módulos\", \"\'declarations\' para componentes, \'imports\' para servicios, \'providers\' para módulos externos\", \"\'declarations\' para módulos, \'imports\' para servicios, \'providers\' para componentes\"], \"correct_asnwer_text\": \"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Qué es Angular Material?\", \"responses\": [\"Una biblioteca de música para desarrolladores\", \"Un conjunto de componentes UI basados en Material Design\", \"Una herramienta de optimización de rendimiento en Angular\", \"Un sistema operativo creado por Google\"], \"correct_asnwer_text\": \"Un conjunto de componentes UI basados en Material Design\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuál es la ventaja de lazy loading en Angular?\", \"responses\": [\"Mejora la velocidad de carga inicial de la aplicación\", \"Aumenta la complejidad del código\", \"Requiere más recursos del sistema\", \"No hay ventajas en lazy loading\"], \"correct_asnwer_text\": \"Mejora la velocidad de carga inicial de la aplicación\", \"correct_asnwer_index\": \"0\"}, {\"title\": \"¿Cómo se implementa el manejo de errores en las solicitudes HTTP en Angular?\", \"responses\": [\"No es necesario manejar errores en solicitudes HTTP en Angular\", \"Utilizando la función catch() en las observables HTTP\", \"Con el método errorHandler() en el servicio de red\", \"Solo se puede manejar errores en el lado del servidor\"], \"correct_asnwer_text\": \"Utilizando la función catch() en las observables HTTP\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Qué es AOT (Ahead of Time) compilation en Angular?\", \"responses\": [\"Una técnica para ejecutar código antes del tiempo de compilación\", \"Un enfoque para optimizar el tiempo de ejecución de la aplicación\", \"Un compilador externo a Angular\", \"Una característica obsoleta en versiones recientes de Angular\"], \"correct_asnwer_text\": \"Un enfoque para optimizar el tiempo de ejecución de la aplicación\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cuándo se utiliza el decorador @Input en Angular?\", \"responses\": [\"Para marcar un componente como entrada de datos\", \"Para definir propiedades de entrada en un componente hijo\", \"Solo se usa en servicios\", \"Para declarar variables globales en Angular\"], \"correct_asnwer_text\": \"Para definir propiedades de entrada en un componente hijo\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Qué es el Change Detection en Angular?\", \"responses\": [\"Un método para detectar cambios en la base de datos\", \"Un sistema para controlar eventos del teclado\", \"El proceso de identificar y responder a cambios en el estado de la aplicación\", \"Una técnica para modificar el DOM directamente\"], \"correct_asnwer_text\": \"El proceso de identificar y responder a cambios en el estado de la aplicación\", \"correct_asnwer_index\": \"2\"}, {\"title\": \"¿Cuál es la función de Angular Pipes?\", \"responses\": [\"Conectar componentes y servicios\", \"Transformar datos en la vista\", \"Gestionar formularios y su estado\", \"Una herramienta para análisis estático de código\"], \"correct_asnwer_text\": \"Transformar datos en la vista\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Cómo se implementa la internacionalización (i18n) en Angular?\", \"responses\": [\"No es posible internacionalizar aplicaciones Angular\", \"Utilizando la directiva ng-translate\", \"A través de la herramienta de línea de comandos ng-i18n\", \"Con el módulo de internacionalización incorporado en Angular\"], \"correct_asnwer_text\": \"Con el módulo de internacionalización incorporado en Angular\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Qué es Angular Universal?\", \"responses\": [\"Una versión antigua de Angular\", \"Una herramienta para la creación de componentes universales\", \"Un framework para el desarrollo de aplicaciones web progresivas\", \"Una solución para la representación del lado del servidor en Angular\"], \"correct_asnwer_text\": \"Una solución para la representación del lado del servidor en Angular\", \"correct_asnwer_index\": \"3\"}, {\"title\": \"¿Cuál es la diferencia entre ng-content y ng-container en Angular?\", \"responses\": [\"Ambos son lo mismo, se pueden usar indistintamente\", \"ng-content para proyección de contenido, ng-container para estructura\", \"ng-container para proyección de contenido, ng-content para estructura\", \"No hay diferencia, ambos son obsoletos en versiones recientes de Angular\"], \"correct_asnwer_text\": \"ng-content para proyección de contenido, ng-container para estructura\", \"correct_asnwer_index\": \"1\"}, {\"title\": \"¿Qué es TestBed en Angular y cuál es su función?\", \"responses\": [\"Un componente de Angular para pruebas unitarias\", \"Una herramienta para simular servicios en Angular\", \"Una biblioteca de pruebas para Angular\", \"Un conjunto de utilidades para configurar y realizar pruebas en Angular\"], \"correct_asnwer_text\": \"Un conjunto de utilidades para configurar y realizar pruebas en Angular\", \"correct_asnwer_index\": \"3\"}]','2024-02-02 16:56:56','2024-02-04 05:40:42');
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infos`
--

DROP TABLE IF EXISTS `infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infos`
--

LOCK TABLES `infos` WRITE;
/*!40000 ALTER TABLE `infos` DISABLE KEYS */;
INSERT INTO `infos` VALUES (1,'{\"ci\": \"1003728217\", \"date\": \"1994-09-20\", \"phone\": \"0963429866\", \"address\": \"quito\"}','2024-02-01 16:53:58','2024-02-01 16:53:58'),(2,'{\"ci\": \"1003728218\", \"date\": \"1994-09-20\", \"phone\": \"0987654321\", \"address\": \"nayon\"}','2024-02-01 17:09:44','2024-02-01 17:09:44');
/*!40000 ALTER TABLE `infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculation_switch_views`
--

DROP TABLE IF EXISTS `matriculation_switch_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriculation_switch_views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculation_switch_views`
--

LOCK TABLES `matriculation_switch_views` WRITE;
/*!40000 ALTER TABLE `matriculation_switch_views` DISABLE KEYS */;
INSERT INTO `matriculation_switch_views` VALUES (1,'Matriculation',1,'2024-02-13 11:17:00','2024-02-13 11:37:40'),(2,'Inscription',1,'2024-02-13 11:18:00','2024-02-13 11:34:47');
/*!40000 ALTER TABLE `matriculation_switch_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2024-02-01 16:53:23','2024-02-01 16:53:23','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,5,1,'2024-02-01 16:53:23','2024-02-13 11:13:55','voyager.media.index',NULL),(3,1,'Users','','_self','voyager-person',NULL,NULL,3,'2024-02-01 16:53:23','2024-02-01 16:53:23','voyager.users.index',NULL),(4,1,'Roles','','_self','voyager-lock',NULL,NULL,2,'2024-02-01 16:53:23','2024-02-01 16:53:23','voyager.roles.index',NULL),(5,1,'Tools','','_self','voyager-tools',NULL,NULL,4,'2024-02-01 16:53:23','2024-02-13 11:13:55',NULL,NULL),(6,1,'Menu Builder','','_self','voyager-list',NULL,5,2,'2024-02-01 16:53:23','2024-02-13 11:13:55','voyager.menus.index',NULL),(7,1,'Database','','_self','voyager-data',NULL,5,3,'2024-02-01 16:53:23','2024-02-13 11:13:55','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,4,'2024-02-01 16:53:23','2024-02-13 11:13:55','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,5,'2024-02-01 16:53:23','2024-02-13 11:13:55','voyager.bread.index',NULL),(10,1,'Settings','','_self','voyager-settings',NULL,5,6,'2024-02-01 16:53:23','2024-02-13 11:14:02','voyager.settings.index',NULL),(11,1,'Companies','','_self','voyager-company','#000000',NULL,5,'2024-02-01 17:06:45','2024-02-13 11:14:02','voyager.companies.index','null'),(12,1,'Add to a company','','_self','voyager-backpack','#000000',11,2,'2024-02-01 17:08:27','2024-02-11 00:25:27','voyager.user-company.index','null'),(13,1,'Courses','','_self','voyager-tv','#000000',18,1,'2024-02-01 17:12:35','2024-02-13 11:41:38','voyager.courses.index','null'),(14,1,'Question Bank','','_self','voyager-question','#000000',18,2,'2024-02-01 20:37:53','2024-02-13 11:41:39','voyager.exams.index','null'),(15,1,'My Courses','','_self','voyager-archive','#000000',18,3,'2024-02-04 03:38:58','2024-02-13 11:43:18','voyager.my-courses-view.index','null'),(16,1,'Companies','','_self','voyager-shop','#000000',11,1,'2024-02-11 00:23:33','2024-02-11 00:27:33','voyager.companies.index','null'),(17,1,'Matriculations Switchs','','_self','voyager-power','#000000',18,4,'2024-02-13 11:16:45','2024-02-13 11:43:31','voyager.matriculation-switch-views.index','null'),(18,1,'My Space','#','_self','voyager-laptop','#000000',NULL,6,'2024-02-13 11:41:32','2024-02-13 11:42:57',NULL,'');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2024-02-01 16:53:23','2024-02-01 16:53:23');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (95,'2014_10_12_000000_create_users_table',1),(96,'2014_10_12_100000_create_password_resets_table',1),(97,'2016_01_01_000000_add_voyager_user_fields',1),(98,'2016_01_01_000000_create_data_types_table',1),(99,'2016_05_19_173453_create_menu_table',1),(100,'2016_10_21_190000_create_roles_table',1),(101,'2016_10_21_190000_create_settings_table',1),(102,'2016_11_30_135954_create_permission_table',1),(103,'2016_11_30_141208_create_permission_role_table',1),(104,'2016_12_26_201236_data_types__add__server_side',1),(105,'2017_01_13_000000_add_route_to_menu_items_table',1),(106,'2017_01_14_005015_create_translations_table',1),(107,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(108,'2017_03_06_000000_add_controller_to_data_types_table',1),(109,'2017_04_21_000000_add_order_to_data_rows_table',1),(110,'2017_07_05_210000_add_policyname_to_data_types_table',1),(111,'2017_08_05_000000_add_group_to_settings_table',1),(112,'2017_11_26_013050_add_user_role_relationship',1),(113,'2017_11_26_015000_create_user_roles_table',1),(114,'2018_03_11_000000_add_user_settings',1),(115,'2018_03_14_000000_add_details_to_data_types_table',1),(116,'2018_03_16_000000_make_settings_value_nullable',1),(117,'2019_08_19_000000_create_failed_jobs_table',1),(118,'2019_12_14_000001_create_personal_access_tokens_table',1),(119,'2024_02_01_023710_create_infos_table',1),(120,'2024_02_01_023921_add_id_info_to_users_table',1),(121,'2024_02_01_135429_create_companies_table',1),(122,'2024_02_01_135937_create_user_company_table',1),(123,'2024_02_01_164228_create_courses_table',1),(124,'2024_02_01_185130_create_course_user_table',2),(126,'2024_02_01_202633_create_exams_table',3),(127,'2024_02_04_032707_create_my_courses_view_table',4),(128,'2024_02_04_045054_add_name_to_exams_table',5),(131,'2024_02_04_060101_create_test_configurations_table',6),(133,'2024_02_05_021226_create_tests_table',7),(134,'2024_02_13_110929_create_matriculation_switch_views_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_courses_view`
--

DROP TABLE IF EXISTS `my_courses_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_courses_view` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_courses_view`
--

LOCK TABLES `my_courses_view` WRITE;
/*!40000 ALTER TABLE `my_courses_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_courses_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,3),(1,4),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(16,3),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(36,3),(36,4),(37,1),(38,1),(39,1),(40,1),(41,1),(41,3),(42,1),(43,1),(44,1),(45,1),(46,1),(46,3),(46,4),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(2,'browse_bread',NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(3,'browse_database',NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(4,'browse_media',NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(5,'browse_compass',NULL,'2024-02-01 16:53:23','2024-02-01 16:53:23'),(6,'browse_menus','menus','2024-02-01 16:53:23','2024-02-01 16:53:23'),(7,'read_menus','menus','2024-02-01 16:53:23','2024-02-01 16:53:23'),(8,'edit_menus','menus','2024-02-01 16:53:23','2024-02-01 16:53:23'),(9,'add_menus','menus','2024-02-01 16:53:23','2024-02-01 16:53:23'),(10,'delete_menus','menus','2024-02-01 16:53:23','2024-02-01 16:53:23'),(11,'browse_roles','roles','2024-02-01 16:53:23','2024-02-01 16:53:23'),(12,'read_roles','roles','2024-02-01 16:53:23','2024-02-01 16:53:23'),(13,'edit_roles','roles','2024-02-01 16:53:23','2024-02-01 16:53:23'),(14,'add_roles','roles','2024-02-01 16:53:23','2024-02-01 16:53:23'),(15,'delete_roles','roles','2024-02-01 16:53:23','2024-02-01 16:53:23'),(16,'browse_users','users','2024-02-01 16:53:23','2024-02-01 16:53:23'),(17,'read_users','users','2024-02-01 16:53:23','2024-02-01 16:53:23'),(18,'edit_users','users','2024-02-01 16:53:23','2024-02-01 16:53:23'),(19,'add_users','users','2024-02-01 16:53:23','2024-02-01 16:53:23'),(20,'delete_users','users','2024-02-01 16:53:23','2024-02-01 16:53:23'),(21,'browse_settings','settings','2024-02-01 16:53:23','2024-02-01 16:53:23'),(22,'read_settings','settings','2024-02-01 16:53:23','2024-02-01 16:53:23'),(23,'edit_settings','settings','2024-02-01 16:53:23','2024-02-01 16:53:23'),(24,'add_settings','settings','2024-02-01 16:53:23','2024-02-01 16:53:23'),(25,'delete_settings','settings','2024-02-01 16:53:23','2024-02-01 16:53:23'),(26,'browse_companies','companies','2024-02-01 17:06:45','2024-02-01 17:06:45'),(27,'read_companies','companies','2024-02-01 17:06:45','2024-02-01 17:06:45'),(28,'edit_companies','companies','2024-02-01 17:06:45','2024-02-01 17:06:45'),(29,'add_companies','companies','2024-02-01 17:06:45','2024-02-01 17:06:45'),(30,'delete_companies','companies','2024-02-01 17:06:45','2024-02-01 17:06:45'),(31,'browse_user_company','user_company','2024-02-01 17:08:27','2024-02-01 17:08:27'),(32,'read_user_company','user_company','2024-02-01 17:08:27','2024-02-01 17:08:27'),(33,'edit_user_company','user_company','2024-02-01 17:08:27','2024-02-01 17:08:27'),(34,'add_user_company','user_company','2024-02-01 17:08:27','2024-02-01 17:08:27'),(35,'delete_user_company','user_company','2024-02-01 17:08:27','2024-02-01 17:08:27'),(36,'browse_courses','courses','2024-02-01 17:12:35','2024-02-01 17:12:35'),(37,'read_courses','courses','2024-02-01 17:12:35','2024-02-01 17:12:35'),(38,'edit_courses','courses','2024-02-01 17:12:35','2024-02-01 17:12:35'),(39,'add_courses','courses','2024-02-01 17:12:35','2024-02-01 17:12:35'),(40,'delete_courses','courses','2024-02-01 17:12:35','2024-02-01 17:12:35'),(41,'browse_exams','exams','2024-02-01 20:37:53','2024-02-01 20:37:53'),(42,'read_exams','exams','2024-02-01 20:37:53','2024-02-01 20:37:53'),(43,'edit_exams','exams','2024-02-01 20:37:53','2024-02-01 20:37:53'),(44,'add_exams','exams','2024-02-01 20:37:53','2024-02-01 20:37:53'),(45,'delete_exams','exams','2024-02-01 20:37:53','2024-02-01 20:37:53'),(46,'browse_my_courses_view','my_courses_view','2024-02-04 03:38:58','2024-02-04 03:38:58'),(47,'read_my_courses_view','my_courses_view','2024-02-04 03:38:58','2024-02-04 03:38:58'),(48,'edit_my_courses_view','my_courses_view','2024-02-04 03:38:58','2024-02-04 03:38:58'),(49,'add_my_courses_view','my_courses_view','2024-02-04 03:38:58','2024-02-04 03:38:58'),(50,'delete_my_courses_view','my_courses_view','2024-02-04 03:38:58','2024-02-04 03:38:58'),(51,'browse_matriculation_switch_views','matriculation_switch_views','2024-02-13 11:16:45','2024-02-13 11:16:45'),(52,'read_matriculation_switch_views','matriculation_switch_views','2024-02-13 11:16:45','2024-02-13 11:16:45'),(53,'edit_matriculation_switch_views','matriculation_switch_views','2024-02-13 11:16:45','2024-02-13 11:16:45'),(54,'add_matriculation_switch_views','matriculation_switch_views','2024-02-13 11:16:45','2024-02-13 11:16:45'),(55,'delete_matriculation_switch_views','matriculation_switch_views','2024-02-13 11:16:45','2024-02-13 11:16:45');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2024-02-01 16:50:35','2024-02-01 16:50:35'),(2,'user','Normal User','2024-02-01 16:53:23','2024-02-01 16:53:23'),(3,'docente','Docente','2024-02-01 16:54:37','2024-02-01 16:54:37'),(4,'alumno','Alumno','2024-02-01 16:54:47','2024-02-01 16:54:47');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Site Title','','text',1,'Site'),(2,'site.description','Site Description','Site Description','','text',2,'Site'),(3,'site.logo','Site Logo','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID',NULL,'','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','settings/February2024/sfK9c60s5VjUya9TshwF.jpg','','image',5,'Admin'),(6,'admin.title','Admin Title','EvalSis','','text',1,'Admin'),(7,'admin.description','Admin Description','Una manera simple de evaluar','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)',NULL,'','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_configurations`
--

DROP TABLE IF EXISTS `test_configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_exam` bigint unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_questions` int NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_configurations_id_exam_foreign` (`id_exam`),
  CONSTRAINT `test_configurations_id_exam_foreign` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_configurations`
--

LOCK TABLES `test_configurations` WRITE;
/*!40000 ALTER TABLE `test_configurations` DISABLE KEYS */;
INSERT INTO `test_configurations` VALUES (5,'examen del primer bimestre de angular',28,'2024-02-06',10,'00:10','new','2024-02-04 20:59:01','2024-02-04 20:59:01'),(6,'examen del primer bimestre de C',26,'2024-02-05',10,'00:01','new','2024-02-04 20:59:01','2024-02-04 20:59:01'),(7,'Test medio bimestre de angular',28,'2024-02-11',10,'01:00','new','2024-02-06 01:00:41','2024-02-11 03:11:16'),(33,'test de prueba',28,'2024-02-18',12,'00:35','new','2024-02-12 00:35:42','2024-02-12 00:35:42');
/*!40000 ALTER TABLE `test_configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint unsigned DEFAULT NULL,
  `id_test_configuration` bigint unsigned DEFAULT NULL,
  `responses` json NOT NULL,
  `score` decimal(8,2) NOT NULL,
  `completed_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_id_user_foreign` (`id_user`),
  KEY `tests_id_test_configuration_foreign` (`id_test_configuration`),
  CONSTRAINT `tests_id_test_configuration_foreign` FOREIGN KEY (`id_test_configuration`) REFERENCES `test_configurations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tests_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (7,3,6,'[{\"title\": \"¿Cuál es el operador de comparación que verifica la desigualdad en C?\", \"responses\": [\"!=\", \"==\", \"<>\", \"<=\"], \"user_answer_text\": \"==\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"!=\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Cuál es el tipo de dato para almacenar números con decimales en C?\", \"responses\": [\"int\", \"float\", \"double\", \"decimal\"], \"user_answer_text\": \"double\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"double\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cómo se declara un arreglo de enteros en C?\", \"responses\": [\"array nums[];\", \"int[] nums;\", \"int nums[];\", \"nums array[];\"], \"user_answer_text\": \"int[] nums;\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"int nums[];\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cuál es la función para obtener el valor absoluto de un número en C?\", \"responses\": [\"abs()\", \"absolute()\", \"fabs()\", \"value()\"], \"user_answer_text\": \"abs()\", \"user_anwser_index\": 0, \"correct_asnwer_text\": \"fabs()\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cómo se compara el contenido de dos enteros en C?\", \"responses\": [\"compareInts()\", \"== (int1, int2)\", \"int1 == int2\", \"equals(int1, int2)\"], \"user_answer_text\": \"equals(int1, int2)\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"int1 == int2\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cuál es el operador para acceder a un miembro de una estructura en C?\", \"responses\": [\".\", \"->\", \":\", \"::\"], \"user_answer_text\": \":\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"->\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Qué función se utiliza para obtener la parte entera de un número en C?\", \"responses\": [\"integer()\", \"trunc()\", \"int()\", \"floor()\"], \"user_answer_text\": \"trunc()\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"trunc()\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es el operador de asignación compuesta para sumar en C?\", \"responses\": [\"+=+\", \"=+\", \"+=\", \"++=\"], \"user_answer_text\": \"=+\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"+=\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cuál es el operador de incremento compuesto en C?\", \"responses\": [\"++=\", \"+=\", \"inc=\", \"inc++\"], \"user_answer_text\": \"+=\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"++=\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Cuál es la función para obtener el valor máximo de un arreglo en C?\", \"responses\": [\"maxArray()\", \"getMax()\", \"maximum()\", \"max()\"], \"user_answer_text\": \"getMax()\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"max()\", \"correct_asnwer_index\": 3}]',2.00,'complete','2024-02-06 01:42:17','2024-02-06 01:42:17'),(8,3,5,'[{\"title\": \"¿Cómo se manejan las rutas en Angular?\", \"responses\": [\"Con la directiva ngRoute\", \"A través de la configuración de rutas en el archivo app.routing.ts\", \"Solo se pueden manejar con JavaScript puro\", \"Angular no admite enrutamiento\"], \"user_answer_text\": \"A través de la configuración de rutas en el archivo app.routing.ts\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"A través de la configuración de rutas en el archivo app.routing.ts\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es la función de Angular Forms y cómo se implementan?\", \"responses\": [\"Manejar formularios HTML puros\", \"Facilitar la comunicación entre servidores\", \"Crear interfaces gráficas\", \"Gestionar formularios y su estado en Angular\"], \"user_answer_text\": \"Manejar formularios HTML puros\", \"user_anwser_index\": 0, \"correct_asnwer_text\": \"Gestionar formularios y su estado en Angular\", \"correct_asnwer_index\": 3}, {\"title\": \"¿Qué es el patrón de diseño \'Inyección de Dependencias\' en Angular?\", \"responses\": [\"Un enfoque para evitar la inyección de dependencias\", \"Una técnica para reducir la modularidad\", \"Un principio para manejar la dependencia de componentes\", \"Un sistema de codificación de colores\"], \"user_answer_text\": \"Un sistema de codificación de colores\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Un principio para manejar la dependencia de componentes\", \"correct_asnwer_index\": 2}, {\"title\": \"¿Cómo se realiza la animación en Angular?\", \"responses\": [\"Con CSS puro\", \"Utilizando el módulo de animación de Angular\", \"A través de JavaScript sin bibliotecas externas\", \"Angular no admite animaciones\"], \"user_answer_text\": \"A través de JavaScript sin bibliotecas externas\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"Utilizando el módulo de animación de Angular\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es la diferencia entre \'declarations\', \'imports\' y \'providers\' en un módulo Angular?\", \"responses\": [\"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"\'declarations\' para servicios, \'imports\' para componentes, \'providers\' para módulos\", \"\'declarations\' para componentes, \'imports\' para servicios, \'providers\' para módulos externos\", \"\'declarations\' para módulos, \'imports\' para servicios, \'providers\' para componentes\"], \"user_answer_text\": \"\'declarations\' para servicios, \'imports\' para componentes, \'providers\' para módulos\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Cuál es la ventaja de lazy loading en Angular?\", \"responses\": [\"Mejora la velocidad de carga inicial de la aplicación\", \"Aumenta la complejidad del código\", \"Requiere más recursos del sistema\", \"No hay ventajas en lazy loading\"], \"user_answer_text\": \"No hay ventajas en lazy loading\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Mejora la velocidad de carga inicial de la aplicación\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Qué es AOT (Ahead of Time) compilation en Angular?\", \"responses\": [\"Una técnica para ejecutar código antes del tiempo de compilación\", \"Un enfoque para optimizar el tiempo de ejecución de la aplicación\", \"Un compilador externo a Angular\", \"Una característica obsoleta en versiones recientes de Angular\"], \"user_answer_text\": \"Un enfoque para optimizar el tiempo de ejecución de la aplicación\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"Un enfoque para optimizar el tiempo de ejecución de la aplicación\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuándo se utiliza el decorador @Input en Angular?\", \"responses\": [\"Para marcar un componente como entrada de datos\", \"Para definir propiedades de entrada en un componente hijo\", \"Solo se usa en servicios\", \"Para declarar variables globales en Angular\"], \"user_answer_text\": \"Para marcar un componente como entrada de datos\", \"user_anwser_index\": 0, \"correct_asnwer_text\": \"Para definir propiedades de entrada en un componente hijo\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cómo se implementa la internacionalización (i18n) en Angular?\", \"responses\": [\"No es posible internacionalizar aplicaciones Angular\", \"Utilizando la directiva ng-translate\", \"A través de la herramienta de línea de comandos ng-i18n\", \"Con el módulo de internacionalización incorporado en Angular\"], \"user_answer_text\": \"Con el módulo de internacionalización incorporado en Angular\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Con el módulo de internacionalización incorporado en Angular\", \"correct_asnwer_index\": 3}, {\"title\": \"¿Qué es Angular Universal?\", \"responses\": [\"Una versión antigua de Angular\", \"Una herramienta para la creación de componentes universales\", \"Un framework para el desarrollo de aplicaciones web progresivas\", \"Una solución para la representación del lado del servidor en Angular\"], \"user_answer_text\": \"Un framework para el desarrollo de aplicaciones web progresivas\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"Una solución para la representación del lado del servidor en Angular\", \"correct_asnwer_index\": 3}]',3.00,'complete','2024-02-06 01:42:52','2024-02-06 01:42:52'),(15,3,7,'[{\"title\": \"¿Qué es TypeScript y cuál es su relación con Angular?\", \"responses\": [\"Un lenguaje de programación independiente de Angular\", \"Un superset de JavaScript utilizado en el desarrollo de Angular\", \"Una base de datos de Angular\", \"Un sistema operativo\"], \"user_answer_text\": \"Un superset de JavaScript utilizado en el desarrollo de Angular\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"Un superset de JavaScript utilizado en el desarrollo de Angular\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cómo se manejan las rutas en Angular?\", \"responses\": [\"Con la directiva ngRoute\", \"A través de la configuración de rutas en el archivo app.routing.ts\", \"Solo se pueden manejar con JavaScript puro\", \"Angular no admite enrutamiento\"], \"user_answer_text\": \"Con la directiva ngRoute\", \"user_anwser_index\": 0, \"correct_asnwer_text\": \"A través de la configuración de rutas en el archivo app.routing.ts\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es la función de Angular Forms y cómo se implementan?\", \"responses\": [\"Manejar formularios HTML puros\", \"Facilitar la comunicación entre servidores\", \"Crear interfaces gráficas\", \"Gestionar formularios y su estado en Angular\"], \"user_answer_text\": \"Gestionar formularios y su estado en Angular\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Gestionar formularios y su estado en Angular\", \"correct_asnwer_index\": 3}, {\"title\": \"¿Cuál es la diferencia entre \'declarations\', \'imports\' y \'providers\' en un módulo Angular?\", \"responses\": [\"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"\'declarations\' para servicios, \'imports\' para componentes, \'providers\' para módulos\", \"\'declarations\' para componentes, \'imports\' para servicios, \'providers\' para módulos externos\", \"\'declarations\' para módulos, \'imports\' para servicios, \'providers\' para componentes\"], \"user_answer_text\": \"\'declarations\' para servicios, \'imports\' para componentes, \'providers\' para módulos\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"\'declarations\' para componentes, \'imports\' para módulos externos, \'providers\' para servicios\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Qué es Angular Material?\", \"responses\": [\"Una biblioteca de música para desarrolladores\", \"Un conjunto de componentes UI basados en Material Design\", \"Una herramienta de optimización de rendimiento en Angular\", \"Un sistema operativo creado por Google\"], \"user_answer_text\": \"Una biblioteca de música para desarrolladores\", \"user_anwser_index\": 0, \"correct_asnwer_text\": \"Un conjunto de componentes UI basados en Material Design\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es la ventaja de lazy loading en Angular?\", \"responses\": [\"Mejora la velocidad de carga inicial de la aplicación\", \"Aumenta la complejidad del código\", \"Requiere más recursos del sistema\", \"No hay ventajas en lazy loading\"], \"user_answer_text\": \"Requiere más recursos del sistema\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"Mejora la velocidad de carga inicial de la aplicación\", \"correct_asnwer_index\": 0}, {\"title\": \"¿Cómo se implementa el manejo de errores en las solicitudes HTTP en Angular?\", \"responses\": [\"No es necesario manejar errores en solicitudes HTTP en Angular\", \"Utilizando la función catch() en las observables HTTP\", \"Con el método errorHandler() en el servicio de red\", \"Solo se puede manejar errores en el lado del servidor\"], \"user_answer_text\": \"Solo se puede manejar errores en el lado del servidor\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Utilizando la función catch() en las observables HTTP\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuándo se utiliza el decorador @Input en Angular?\", \"responses\": [\"Para marcar un componente como entrada de datos\", \"Para definir propiedades de entrada en un componente hijo\", \"Solo se usa en servicios\", \"Para declarar variables globales en Angular\"], \"user_answer_text\": \"Solo se usa en servicios\", \"user_anwser_index\": 2, \"correct_asnwer_text\": \"Para definir propiedades de entrada en un componente hijo\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cuál es la función de Angular Pipes?\", \"responses\": [\"Conectar componentes y servicios\", \"Transformar datos en la vista\", \"Gestionar formularios y su estado\", \"Una herramienta para análisis estático de código\"], \"user_answer_text\": \"Transformar datos en la vista\", \"user_anwser_index\": 1, \"correct_asnwer_text\": \"Transformar datos en la vista\", \"correct_asnwer_index\": 1}, {\"title\": \"¿Cómo se implementa la internacionalización (i18n) en Angular?\", \"responses\": [\"No es posible internacionalizar aplicaciones Angular\", \"Utilizando la directiva ng-translate\", \"A través de la herramienta de línea de comandos ng-i18n\", \"Con el módulo de internacionalización incorporado en Angular\"], \"user_answer_text\": \"Con el módulo de internacionalización incorporado en Angular\", \"user_anwser_index\": 3, \"correct_asnwer_text\": \"Con el módulo de internacionalización incorporado en Angular\", \"correct_asnwer_index\": 3}]',4.00,'complete','2024-02-11 05:32:24','2024-02-11 05:32:24');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_company`
--

DROP TABLE IF EXISTS `user_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_company` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_company_user_id_foreign` (`user_id`),
  KEY `user_company_company_id_foreign` (`company_id`),
  CONSTRAINT `user_company_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `user_company_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_company`
--

LOCK TABLES `user_company` WRITE;
/*!40000 ALTER TABLE `user_company` DISABLE KEYS */;
INSERT INTO `user_company` VALUES (23,2,1,NULL,NULL);
/*!40000 ALTER TABLE `user_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_info` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_id_info_foreign` (`id_info`),
  CONSTRAINT `users_id_info_foreign` FOREIGN KEY (`id_info`) REFERENCES `infos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Miguel Admin','miguel@admin.com','users/default.png',NULL,'$2y$10$7V50eDw6dUKFHAB04EhQG.0Tt99Ii7/qwNspKGkBjB51Qur.9Ibcu',NULL,NULL,'2024-02-01 16:50:35','2024-02-01 16:53:58',1),(2,3,'miguel docente','miguel@docente.com','users/default.png',NULL,'$2y$10$5Zz7n/PAHoyeX15rZMWMde6XHRSLRPct0dC.Zq2HkntWqRoG/Qwqq',NULL,'{\"locale\":\"en\"}','2024-02-01 16:54:26','2024-02-01 17:09:44',2),(3,4,'Miguel estudiante','miguel@estudiante.com','users/default.png',NULL,'$2y$10$QmRsnehfdCXERNGjT/wx3eo95UMP4tu508kX/28aHmJr0oYDkco8u',NULL,'{\"locale\":\"en\"}','2024-02-01 19:30:29','2024-02-01 19:30:29',NULL),(4,4,'miguel nuevo','miguel1@estudiante.com','users/default.png',NULL,'$2y$10$Pj8/wvUKZt53HSUePy.Hc.EaondsCBSdb9lM40jNrUHZuEK/4YFca',NULL,'{\"locale\":\"en\"}','2024-02-04 21:01:42','2024-02-04 21:01:42',NULL),(5,4,'Miguel Munevar','miguel000127@gmail.com','users/default.png',NULL,'$2y$10$7vVQwWsgNoBVE/9g3YuCnuTE1y8ymLf5JOaq7ZSxBb.9x2nqhzOma',NULL,'{\"locale\":\"en\"}','2024-02-12 00:25:21','2024-02-12 00:25:37',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'evalsisv2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-13 11:50:07

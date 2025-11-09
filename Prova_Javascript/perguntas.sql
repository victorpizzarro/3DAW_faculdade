CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pergunta` text NOT NULL,
  `alternativa1` varchar(255) NOT NULL,
  `alternativa2` varchar(255) NOT NULL,
  `alternativa3` varchar(255) NOT NULL,
  `alternativa4` varchar(255) NOT NULL,
  `alternativa5` varchar(255) NOT NULL,
  `correta` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


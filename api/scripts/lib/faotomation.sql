CREATE TABLE `users` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`verification` varchar(255) NULL,
	`role` varchar(255) NULL DEFAULT 0,
	`status` varchar(255) NULL DEFAULT 0,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
	) ENGINE = InnoDB;

CREATE TABLE `player_details` (
	`id` int PRIMARY KEY,
	`photo` varchar(255) NULL,
	`birth_date` timestamp NOT NULL,
	`birth_place` varchar(255) NOT NULL,
	`weight` int NOT NULL,
	`height` int NOT NULL,
	`position` varchar(255) NOT NULL,
	`foot` varchar(255) NOT NULL,
	`market_value` varchar(255) NOT NULL,
	`parent_name` varchar(255) NOT NULL,
	`parent_phone` varchar(255) NOT NULL,
	`parent_mail` varchar(255) NOT NULL,
	`address` varchar(255) NOT NULL,
	`country_code` varchar(255) NOT NULL,
	`class_id` int NULL,
	`countinutiy` varchar(255) NULL,
	`statistics` varchar(255) NULL,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
  ) ENGINE = InnoDB;

CREATE TABLE `classes` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`coach_id` timestamp NULL,
	`status` varchar(255) NULL DEFAULT 0,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
  ) ENGINE = InnoDB;

CREATE TABLE `classes_players` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`class_id` int,
	`player_id` int
  ) ENGINE = InnoDB;

CREATE TABLE `coach_details` (
	`id` int PRIMARY KEY,
	`photo` varchar(255) NULL,
	`phone` varchar(255) NOT NULL,
	`birth_date` timestamp NOT NULL,
	`birth_place` varchar(255) NOT NULL,
	`weight` int NOT NULL,
	`height` int NOT NULL,
	`address` varchar(255) NOT NULL,
	`country_code` varchar(255) NOT NULL,
	`class_id` int NULL,
	`statistics` varchar(255) NULL,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
  ) ENGINE = InnoDB;

CREATE TABLE `classes_coaches` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`class_id` int,
	`coach_id` int
  ) ENGINE = InnoDB;

CREATE TABLE `coach_notes` (
	`id` int PRIMARY KEY,
	`coach_id` int NOT NULL,
	`notes` varchar(255) NOT NULL,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
  ) ENGINE = InnoDB;

CREATE TABLE `job` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`type` varchar(255) NOT NULL,
	`value` varchar(255) NOT NULL,
	`status` varchar(255) NULL DEFAULT 0,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`uploaded_at` timestamp NULL
  ) ENGINE = InnoDB;

ALTER TABLE `player_details` ADD FOREIGN KEY (`id`) REFERENCES `users` (`id`);

ALTER TABLE `classes_players` ADD FOREIGN KEY (`player_id`) REFERENCES `player_details` (`id`);

ALTER TABLE `classes_players` ADD FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

ALTER TABLE `coach_notes` ADD FOREIGN KEY (`id`) REFERENCES `coach_details` (`id`);

ALTER TABLE `classes_coaches` ADD FOREIGN KEY (`coach_id`) REFERENCES `coach_details` (`id`);

ALTER TABLE `classes_coaches` ADD FOREIGN KEY (`id`) REFERENCES `classes` (`id`);

ALTER TABLE `coach_details` ADD FOREIGN KEY (`id`) REFERENCES `users` (`id`);

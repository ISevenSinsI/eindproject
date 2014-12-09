	/* Aanmaken tabel voorraad */
		CREATE TABLE
			`factories`(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`factory` varchar(32) NOT NULL,
				`phone` varchar(32),

				/* Vaststellen primary key */
				PRIMARY KEY(`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; 	

		/* Aanmaken tabel medewerkers */
		CREATE TABLE
			`users`(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`initials` varchar(32) NOT NULL,
				`prefix` varchar(32),
				`last_name` varchar(32) NOT NULL,
				`username` varchar(32) NOT NULL,
				`password` varchar(64) NOT NULL,
				/* Vaststellen primary key */
				PRIMARY KEY(`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; 

		/* Aanmaken tabel locaties */
		CREATE TABLE
			`locations`(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`location` varchar(32) NOT NULL,

				/* vaststellen primary key */
				PRIMARY KEY(`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; 

		/* Aanmaken tabel producten */
		CREATE TABLE
			`products`(			
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`product` varchar(32) NOT NULL,
				`type` varchar(32), 
				`factory_id` int(11) NOT NULL,
				`buy_price` decimal(11,2) NOT NULL,
				`sell_price` decimal(11,2) NOT NULL,

				/* Vaststellen primary key */
				PRIMARY KEY(`id`),
				/* vaststellen relatie fabrieken */
				FOREIGN KEY eerste(factory_id) REFERENCES factories(id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

		/* Aanmaken tabel voorraad */
		CREATE TABLE
			`stock`( 
				`location_id` int(11) NOT NULL,
				`product_id` int(11) NOT NULL,
				`amount` int(11),

				/* vaststellen relatie locatie */
				FOREIGN KEY tweede(location_id) REFERENCES locations(id),
				FOREIGN KEY derde(product_id) REFERENCES products(id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
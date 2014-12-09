<?php 
$sql = "
	/* Voer gegevens in de tabel factories in */

	insert into factories(`factory`, `phone`)
			values('Bosch', '0411-454647'),
				  ('Black & Dekker', '0909-0538'),
				  ('Precision', '0800-0909');

    /* Voer gegevens in de tabel users in */
	insert into users(`initials`, `prefix`, `last_name`, `username`, `password`)
			values('J', 'De', 'Man', 'Jorie', '3c649185ca41b2c53060c8266b0845206b4ab363'),
				  ('R', '', 'Vissers', 'Ruud', 'b0ea5de4163aab11169c3edc780644cfc79dd7b20'),
				  ('F', '', 'Verwaard', 'Francy', '2356e59638c3bc00ed8b72d433dbf0b7ecedc536');		
	
	/* Voer gegevens in de tabel Locations in */

	insert into locations(`location`)
			values('Rotterdam'),
				  ('Almere'),
				  ('Eindhoven');


	/* Voer gegevens in de tabel products in */

	insert into products(`product`, `type`, `factory_id`, `buy_price`, `sell_price`)
			values('Boormachine', 'XM-1022', '1', '40', '60'),
				  ('Hamer', 'MX-2011', '2', '15', '70'),
				  ('Schroevendraaier', '2020-MM', '3', '23', '55');

	/* Voer gegevens in de tabel stock in */

	insert into stock(`location_id`, `product_id`, `amount`)
			values('1', '1', '25'),
				  ('1', '2', '45'),
				  ('3', '3', '46'),
				  ('2', '3', '12');
    	  

";	
?>
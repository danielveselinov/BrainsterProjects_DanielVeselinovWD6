create TABLE users(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    fullname varchar(64) not null,
    email varchar(128) not null,
    password varchar(244),
    is_admin int unsigned
);

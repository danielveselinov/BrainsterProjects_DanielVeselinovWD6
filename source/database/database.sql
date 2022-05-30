create TABLE users(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    fullname varchar(64) not null,
    email varchar(128) not null,
    password varchar(244),
    is_admin tinyint not null
);

insert into users(fullname, email, password) VALUES('Daniel Veselinov', 'admin@library.com', '$2y$10$Xwjc0RhdaJ8KpFxDdYOp0.X7AjoTDonGbDkbWzEwxRAzgkwxtEJZO');
create TABLE `users`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    fullname varchar(64) not null,
    email varchar(128) not null,
    password varchar(244),
    is_admin tinyint not null
);

ALTER TABLE `users` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `is_admin`;

insert into users(fullname, email, password) VALUES('John Doe', 'admin@library.com', '$2y$10$Xwjc0RhdaJ8KpFxDdYOp0.X7AjoTDonGbDkbWzEwxRAzgkwxtEJZO');

create TABLE `categories`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    title varchar(64) not null,
    is_deleted tinyint not null,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create TABLE `authors`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    name varchar(32) not null,
    surname varchar(48) not null,
    about text not null,
    is_deleted tinyint not null,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create TABLE `books`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    existing_author_id int unsigned,
    category int unsigned,
    title varchar(128) not null,
    published year(4) not null,
    pages smallint unsigned not null,
    cover_image text not null,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY(existing_author_id) REFERENCES `authors`(id),
    FOREIGN KEY(category) REFERENCES `categories`(id)
);

create TABLE `comments`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    existing_user_id int unsigned,
    commented_on_book int unsigned,
    `comment` text not null,
    is_approved tinyint not null,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY(existing_user_id) REFERENCES `users`(id),
    FOREIGN KEY(commented_on_book) REFERENCES `books`(id)
);

create TABLE `notes`(
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
    existing_user_id int unsigned,
    note_on_book int unsigned,
    note_text text not null,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY(existing_user_id) REFERENCES `users`(id),
    FOREIGN KEY(note_on_book) REFERENCES `books`(id)
);
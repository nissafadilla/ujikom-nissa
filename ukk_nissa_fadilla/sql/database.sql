show databases ;

show tables ;

create database ukk_gallery_website ;

use ukk_gallery_website ;

create table users (
    id int(11) primary key auto_increment,
    username varchar(255),
    password varchar(255),
    email varchar(255),
    full_name varchar(255),
    address text
) engine = InnoDB;

create table pictures (
    id int(11) primary key auto_increment,
    title varchar(255),
    description text,
    upload_date date,
    file_path varchar(255),
    user_id int(11)
) engine = InnoDB;

create table comments (
    id int(11) primary key auto_increment,
    picture_id int(11),
    user_id int(11),
    comment text,
    comment_date date
) engine = InnoDB;

create table likes (
    id int(11) primary key auto_increment,
    picture_id int(11),
    user_id int(11),
    like_date date
) engine = InnoDB;

ALTER TABLE pictures
    ADD CONSTRAINT pictures_users_id_fk FOREIGN KEY (user_id)
        REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE comments
    ADD CONSTRAINT comments_users_id_fk FOREIGN KEY (user_id)
        REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT comments_pictures_id_fk FOREIGN KEY (picture_id)
        REFERENCES pictures(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE likes
    ADD CONSTRAINT likes_users_id_fk FOREIGN KEY (user_id)
        REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT likes_pictures_id_fk FOREIGN KEY (picture_id)
        REFERENCES pictures(id) ON UPDATE CASCADE ON DELETE CASCADE;

show create table users ;
show create table pictures ;
show create table comments ;
show create table likes ;

select * from pictures p join users u on u.id = p.user_id;

select * from pictures ;

insert into likes (picture_id, user_id, like_date) values ();

drop database ukk_gallery_website;
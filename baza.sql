CREATE DATABASE webaplikacija1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use webaplikacija1;

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE 
); 

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,  
  `user_pwd` varchar(256) NOT NULL,
   user_admin tinyint not null,
   PRIMARY KEY (`user_id`)
)ENGINE=InnoDb;

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
    news_id int not null auto_increment primary key,
    news_title varchar(255) not null,
    news_date datetime not null,
    news_article text not null,
    news_user_id int not null,
    news_category_id int not null,
    foreign key (news_user_id) references `user`(user_id) on delete restrict,
    foreign key (news_category_id) references category(category_id) on delete restrict
) ENGINE=InnoDb;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` INT NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_message` varchar(256) NOT NULL,
  comment_news_id int not null,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (comment_user_id) REFERENCES `user`(user_id) ON DELETE RESTRICT,
  foreign key (comment_news_id) references news(news_id) on delete cascade
) ENGINE=InnoDb;

insert into `user`(user_first, user_last, user_email, user_pwd, user_admin) values('Vladimir', 'Vidulović', 'blizanci03@gmail.com', 'generisi hash', 1);

insert into category(category_name) values('Svet'), ('Balkan'), ('Evropa');
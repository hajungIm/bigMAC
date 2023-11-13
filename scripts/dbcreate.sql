-- 데이터베이스 생성(소민)
CREATE DATABASE team04;
USE team04;

-- 테이블 생성(소민)
CREATE TABLE restaurant_open_days (
    open_days_id BIGINT PRIMARY KEY,
    monday INT,
    tuesday INT,
    wednesday INT,
    thursday INT,
    friday INT,
    saturday INT,
    sunday INT
);

CREATE TABLE restaurant (
    restaurant_id BIGINT PRIMARY KEY,
    restaurant_name VARCHAR(50),
    cuisine VARCHAR(30),
    city VARCHAR(20),
    borough VARCHAR(20),
    avenue VARCHAR(20),
    open_days_id BIGINT,
    review_count BIGINT,
    FOREIGN KEY (open_days_id) REFERENCES restaurant_open_days(open_days_id)
);

CREATE TABLE member (
    member_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    login_id VARCHAR(30) UNIQUE NOT NULL,
    member_name VARCHAR(10) NOT NULL,
    password VARCHAR(30) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    age INT NOT NULL
);

CREATE TABLE review (
    review_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    member_id BIGINT,
    restaurant_id BIGINT,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    FOREIGN KEY (member_id) REFERENCES member(member_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id)
);

CREATE TABLE restaurant_member_likes (
    restaurant_id BIGINT,
    liked_member_id BIGINT,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (liked_member_id) REFERENCES member(member_id)
);


CREATE TABLE menu (
    menu_id BIGINT PRIMARY KEY,
    menu_name VARCHAR(60),
    price DECIMAL(5, 2)
);

CREATE TABLE hashtag (
    hashtag_id BIGINT PRIMARY KEY,
    hashtag_name VARCHAR(20)
);

CREATE TABLE restaurant_hashtag (
    restaurant_id BIGINT,
    hashtag_id BIGINT,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (hashtag_id) REFERENCES hashtag(hashtag_id)
);

CREATE TABLE menu_list (
    restaurant_id BIGINT,
    menu_id BIGINT,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (menu_id) REFERENCES menu(menu_id)
);

-- INDEX(소민)
CREATE INDEX idx_price ON menu (price);
CREATE INDEX idx_hashtag_name ON hashtag (hashtag_name);

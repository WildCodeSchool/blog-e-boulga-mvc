-- Create the database 'blogeboulga' if it doesn't exist
CREATE DATABASE IF NOT EXISTS blogeboulga;
USE blogeboulga;

-- Create the 'category' table
CREATE TABLE category (
                          id INT PRIMARY KEY,
                          category_name VARCHAR(255) NOT NULL,
                          status TINYINT(2) NOT NULL
);

-- Create the 'newsletter' table
CREATE TABLE newsletter (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            email_address VARCHAR(255) NOT NULL,
                            subscription_date DATE,
                            unsubscribe DATE,
                            status TINYINT NOT NULL
);

-- Create the 'user' table
CREATE TABLE user (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      first_name VARCHAR(80) NOT NULL,
                      last_name VARCHAR(80) NOT NULL,
                      email_address VARCHAR(255) NOT NULL,
                      login VARCHAR(80) NOT NULL,
                      password VARCHAR(255) NOT NULL,
                      account_status TINYINT(2) NOT NULL,
                      roles VARCHAR(255) NOT NULL,
                      UNIQUE KEY unique_email (email_address)
);

-- Create the 'form' table
CREATE TABLE form (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      first_name VARCHAR(80) NOT NULL,
                      last_name VARCHAR(80) NOT NULL,
                      email_address VARCHAR(255) NOT NULL,
                      topic VARCHAR(80) NOT NULL,
                      message_content TEXT NOT NULL,
                      sending_status TINYINT NOT NULL
);

-- Create the 'author' table
CREATE TABLE author (
                        id INT PRIMARY KEY,
                        short_description TEXT,
                        full_description TEXT,
                        linkedin_url VARCHAR(255),
                        github_url VARCHAR(255),
                        website_url VARCHAR(255),
                        img_src VARCHAR(255),
                        user_id INT,
                        FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Create the 'article' table
CREATE TABLE article (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         author_id INT,
                         category_id INT,
                         article_title VARCHAR(255) NOT NULL,
                         home_title VARCHAR(80) NOT NULL,
                         img_src VARCHAR(255) NOT NULL,
                         alt_img VARCHAR(255) NOT NULL,
                         home_preview VARCHAR(255) NOT NULL,
                         introduction TEXT NOT NULL,
                         detail TEXT NOT NULL,
                         description TEXT NOT NULL,
                         shadow_color VARCHAR(80) NOT NULL,
                         release_date DATE,
                         status TINYINT NOT NULL,
                         updated_at DATE,
                         FOREIGN KEY (author_id) REFERENCES author(id),
                         FOREIGN KEY (category_id) REFERENCES category(id)
);

-- Create the 'user_favourite' table (many-to-many relationship)
CREATE TABLE user_favourite (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                id_article INT,
                                id_user INT,
                                FOREIGN KEY (id_article) REFERENCES article(id),
                                FOREIGN KEY (id_user) REFERENCES user(id)
);

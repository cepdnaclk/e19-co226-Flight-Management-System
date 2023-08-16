DROP DATABASE flight_management_db;
CREATE DATABASE flight_management_db;
USE flight_management_db;

CREATE TABLE users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        birth_day date NOT NULL,
        id varchar(50) NOT NULL,
        email varchar(50) NOT NULL,
        country varchar(50) NOT NULL,
        password varchar(255) NOT NULL,
        role varchar(50) NOT NULL,
        UNIQUE (id),
        UNIQUE(email)
    );

CREATE TABLE flight (
    flight_id INT AUTO_INCREMENT PRIMARY KEY,
    departure_time datetime NOT NULL,
    arrival_time datetime NOT NULL,
    depature varchar(50) NOT NULL,
    destination varchar(50) NOT NULL,
    duration int(20) NOT NULL,
    price int(10) NOT NULL
);

CREATE TABLE ticket (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    uid int,
    fid int,
    FOREIGN KEY (uid) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fid) REFERENCES flight(flight_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- INSERT INTO ticket (uid,fid)
-- VALUES ($uid,$fid);

-- SELECT * FROM flight WHERE depature = '$departure' AND destination = '$destination';

-- SELECT user_id FROM users WHERE email='$username'; 

-- SELECT SUM(price) FROM (SELECT flight.price FROM flight INNER JOIN ticket ON ticket.fid = flight.flight_id) AS subQuery;

-- DELETE FROM flight WHERE departure_time < NOW();
USE events;
CREATE TABLE IF NOT EXISTS eventlist (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
description VARCHAR(255) NOT NULL,
startdate DATE,
endDate DATE,
tid INT(10) DEFAULT '1')
DROP PROCEDURE IF EXISTS p
CREATE PROCEDURE p(IN name VARCHAR(255), IN descrip VARCHAR(255), IN CurDate DATE, IN finalDate DATE, IN tlid INT(10)) 
BEGIN INSERT INTO eventlist(title, description, startdate, endDate, tid) VALUES (name, descrip, CurDate, finalDate, tlid); END;
DROP PROCEDURE IF EXISTS q
CREATE PROCEDURE q(IN tlid INT(10)) 
BEGIN SELECT title, startdate FROM eventlist WHERE (tid = tlid) ORDER BY startdate ASC; END
CREATE PROCEDURE r(IN name VARCHAR(255), IN dsc VARCHAR(255), IN startDate DATE, IN enddate DATE, IN tlid INT(10)) 
BEGIN UPDATE eventlist SET tid = tlid WHERE title LIKE CONCAT('%', name, '%'); END;
CREATE PROCEDURE s(IN name VARCHAR(255)) BEGIN DELETE FROM eventlist WHERE title LIKE CONCAT('%', name, '%'); END;
CREATE DATABASE first_pj;

USE first_pj;

CREATE TABLE obj_list(
	obj_no int PRIMARY KEY auto_increment
	,obj_contents VARCHAR(100) NOT NULL
	);
	
CREATE TABLE do_list(
	list_no INT PRIMARY KEY auto_increment
	,list_title VARCHAR(50) NOT null
	,list_contents VARCHAR(50) NOT null
	,ex_set CHAR(2)
	,ex_num CHAR(3)
	,ex_hour CHAR(1)
	,ex_min CHAR(2)
	,com_flg CHAR(1) NOT NULL DEFAULT '0'
	,write_date DATETIME NOT null
	,update_date datetime
	,del_date DATETIME
	);


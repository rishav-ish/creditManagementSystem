create database spark;

use spark;

create table user(
	id int not null auto_increment primary key,
	name varchar(100) not null,
	email varchar(100) not null,
	current_credit int not null
	
)


INSERT INTO user(name,email,current_credit)
VALUES
('Rishav','rishav@fake.com',5000),
('Amit','amit@fake.com',5000),
('deepika','deepika@fake.com',5000),
('isha','isha@fake.com',5000),
('Shubham','shubham@fake.com',5000),
('Shivam','shivam@fake.com',5000),
('Bhanu','bhanu@fake.com',5000),
('Shridhar','shridhar@fake.com',5000),
('Muskan','muskan@fake.com',5000),
('Akshita','askhita@fake.com',5000)


create table transaction(
	id int not null auto_increment primary key,
	name varchar(100),
	sendTo varchar(100),
	sendAmount int,
	receivedFrom varchar(100),
	receivedAmount int,
	status varchar(50) not null,
	stamp timestamp not null
)

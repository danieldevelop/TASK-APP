-- Active: 1685417922905@@127.0.0.1@3306@tasks_app
create database if not exists tasks_app;
use tasks_app;


create table if not exists task (
    id int primary key auto_increment,
    name varchar(100),
    description varchar(255)
);

insert into task (name, description) values ('write', 'I need to write a book');
insert into task (name, description) values ('create a website', 'I hvae to create a website for my company');


select * from task;
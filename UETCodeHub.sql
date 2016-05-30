create database if not exists UETCodeHub CHARACTER SET utf8 COLLATE utf8_general_ci;

use UETCodeHub;

create table if not exists UserRole (
	roleId int AUTO_INCREMENT PRIMARY KEY,
	roleName char(100) NOT NULL
);

create table if not exists Users (
	userId int AUTO_INCREMENT PRIMARY KEY,
	username char(200) UNIQUE NOT NULL,
	password char(200) NOT NULL,
	firstname char(100),
	lastname char(100),
	email char(200),
	roleId int REFERENCES UserRole(roleId),
	isActive boolean NOT NULL DEFAULT 1
);

create table if not exists Problems(
	problemId int AUTO_INCREMENT PRIMARY KEY,
	userId int REFERENCES Users(userId),
	content text, 
	timelimit float,
	defaultScore int DEFAULT 0,
	tagValues text,
	isActive boolean NOT NULL DEFAULT 1
);

create table if not exists Semesters(
	semesterId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
	semesterName varchar(200) NOT NULL
);

create table if not exists Courses(
	courseId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
	courseName varchar(200) NOT NULL,
	createdUserId int REFERENCES Users(userId),
	semesterId int REFERENCES Semesters(semesterId),
	description varchar(200),
	isActive boolean NOT NULL DEFAULT 1
);

create table if not exists CourseProblems(
	courseProblemId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
	courseId int NOT NULL REFERENCES Courses(courseId) ,
	problemId int NOT NULL REFERENCES Problems(problemId) ,
	hardLevel int DEFAULT 1,	
	scoreInCourse int NOT NULL DEFAULT 0,
	UNIQUE (courseId, problemId),
	isActive boolean NOT NULL DEFAULT 1
);

create table if not exists Exams(
	examId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
	examName varchar(200) NOT NULL,
	courseId int REFERENCES Courses(courseId),
	availableFrom DATETIME,
	availableTo DATETIME,
	duration int DEFAULT 60,	
	isActive boolean NOT NULL DEFAULT 1,
	isFinish boolean NOT NULL DEFAULT 0
);

create table if not exists ExamProblems(
	examProblemId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
	examId int NOT NULL REFERENCES Exams(examId) ,
	problemId int NOT NULL REFERENCES Problems(problemId),
	scoreInExam int DEFAULT 0,
	UNIQUE (examId, problemId),
	isActive boolean NOT NULL DEFAULT 1 
);

create table if not exists Submissions(
	submitId int AUTO_INCREMENT PRIMARY KEY,
	problemId int NOT NULL REFERENCES Problems(problemId),	
	examId int REFERENCES Exams(examId),
	courseId int REFERENCES Courses(courseId),
	userId int NOT NULL REFERENCES Users(userId),
	submitTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	language char(20),
	sourceCode text,
	runningTime float,
	result text,
	resultScore int DEFAULT 0,
	isActive boolean NOT NULL DEFAULT 1
);

create table if not exists CourseUsersRole(
	courseUsersRoleId int AUTO_INCREMENT PRIMARY KEY,
	courseUsersRoleName char(100) NOT NULL
);

create table if not exists CourseUsers(
	courseUserId int AUTO_INCREMENT PRIMARY KEY,
	userId int NOT NULL REFERENCES Users(userId),
	courseId int NOT NULL REFERENCES Courses(courseId),
	roleInCourse int REFERENCES CourseUsersRole(courseUsersRoleId)
);

insert into UserRole(roleId, roleName) values (1,'Administrator'),(2,'Teacher'),(3,'Teaching Staff'),(4,'Student');
insert into Users(username, password, roleId) values('admin','1234','1');
insert into Semesters(semesterName) values('2015-2016 HK1'), ('2015-2016 HK2'), ('2016-2017 HK1');
insert into CourseUsersRole(courseUsersRoleName) values ('Teacher'), ('Assistant'), ('Student');
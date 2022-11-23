-- DROP SCHEMA dbo;

CREATE SCHEMA dbo;
-- rcproject.dbo.TB_Project definition

-- Drop table

-- DROP TABLE rcproject.dbo.TB_Project;

CREATE TABLE rcproject.dbo.TB_Project (
	projectCode varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	projectName varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT TB_Project_PK PRIMARY KEY (projectCode)
);


-- rcproject.dbo.TB_PengajuanSourcing definition

-- Drop table

-- DROP TABLE rcproject.dbo.TB_PengajuanSourcing;

CREATE TABLE rcproject.dbo.TB_PengajuanSourcing (
	id int IDENTITY(0,1) NOT NULL,
	materialCategory varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	materialDeskripsi text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	materialSpesification text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	catalogOrCasNumber varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	company varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	website varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	finishDossageForm varchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	keterangan text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	projectCode varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	created datetime NULL,
	CONSTRAINT TB_PengajuanSourcing_PK PRIMARY KEY (id),
	CONSTRAINT TB_PengajuanSourcing_FK FOREIGN KEY (projectCode) REFERENCES rcproject.dbo.TB_Project(projectCode) ON UPDATE CASCADE
);


-- rcproject.dbo.TB_RiwayatSourcing definition

-- Drop table

-- DROP TABLE rcproject.dbo.TB_RiwayatSourcing;

CREATE TABLE rcproject.dbo.TB_RiwayatSourcing (
	id int IDENTITY(0,1) NOT NULL,
	dateSourcing date NULL,
	teamLeader varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	researcher varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	feedbackTL bit NULL,
	feedbackRPIC bit NULL,
	dateApprovedTL date NULL,
	dateAcceptedRPIC date NULL,
	status varchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	projectCode varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT TB_RiwayatSourcing_PK PRIMARY KEY (id),
	CONSTRAINT TB_RiwayatSourcing_FK FOREIGN KEY (projectCode) REFERENCES rcproject.dbo.TB_Project(projectCode) ON UPDATE CASCADE
);
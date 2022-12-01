CREATE DATABASE rcproject;

USE rcproject;

CREATE TABLE rcproject.dbo.TB_Project (
	projectCode varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	projectName varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT TB_Project_PK PRIMARY KEY (projectCode)
);

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
	dateSourcing date NULL,
	teamLeader varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	researcher varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	feedbackTL bit NULL,
	feedbackRPIC bit NULL,
	dateApprovedTL date NULL,
	dateAcceptedRPIC date NULL,
	status varchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT TB_PengajuanSourcing_PK PRIMARY KEY (id),
	CONSTRAINT TB_PengajuanSourcing_FK FOREIGN KEY (projectCode) REFERENCES rcproject.dbo.TB_Project(projectCode) ON UPDATE CASCADE
);

CREATE TABLE rcproject.dbo.TB_Supplier (
	id int IDENTITY(0,1) NOT NULL,
	supplier varchar(300) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	manufacture varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	originCountry varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	leadTime date NULL,
	catalogOrCasNumber varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	gladeOrReferenceStandard varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	documentInfo varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	document varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	feedbackRND text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	feedbackProc text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	finalFeedbackRND text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	idMaterial int NULL,
	CONSTRAINT TB_Supplier_PK PRIMARY KEY (id),
	CONSTRAINT TB_Supplier_FK FOREIGN KEY (idMaterial) REFERENCES rcproject.dbo.TB_PengajuanSourcing(id) ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_DetailSupplier] (
    [idDetailSupplier] INT           IDENTITY (0, 1) NOT NULL,
    [MoQ]              INT           NULL,
    [UoM]              VARCHAR (100) NULL,
    [price]            INT           NULL,
    [idSupplier]       INT           NULL,
    CONSTRAINT [TB_DetailSupplier_PK] PRIMARY KEY CLUSTERED ([idDetailSupplier] ASC),
    CONSTRAINT [TB_DetailSupplier_FK] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

GO
CREATE DATABASE rcproject;

USE rcproject;

CREATE TABLE [dbo].[TB_Project] (
    [id]          INT           IDENTITY (1, 1) NOT NULL,
    [projectCode] VARCHAR (100) CONSTRAINT [DEFAULT_TB_Project_projectCode] DEFAULT ('') NOT NULL,
    [projectName] VARCHAR (100) CONSTRAINT [DEFAULT_TB_Project_projectName] DEFAULT ('') NOT NULL,
    CONSTRAINT [PK_TB_Project] PRIMARY KEY CLUSTERED ([id] ASC)
);

CREATE TABLE [dbo].[TB_PengajuanSourcing] (
    [id]                    INT           IDENTITY (1, 1) NOT NULL,
    [sourcingNumber]        INT           CONSTRAINT [DEFAULT_TB_PengajuanSourcing_sourcingNumber] DEFAULT ((0)) NOT NULL,
    [materialCategory]      VARCHAR (40)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_materialCategory] DEFAULT ('') NOT NULL,
    [materialName]          VARCHAR (150) CONSTRAINT [DEFAULT_TB_PengajuanSourcing_materialName] DEFAULT ('') NOT NULL,
    [priority]              INT           CONSTRAINT [DEFAULT_TB_PengajuanSourcing_priority] DEFAULT ((0)) NOT NULL,
    [materialSpesification] TEXT          CONSTRAINT [DEFAULT_TB_PengajuanSourcing_materialSpesification] DEFAULT ('') NOT NULL,
    [catalogOrCasNumber]    VARCHAR (50)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_catalogOrCasNumber] DEFAULT ('') NOT NULL,
    [company]               VARCHAR (80)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_company] DEFAULT ('') NOT NULL,
    [website]               VARCHAR (80)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_website] DEFAULT ('') NOT NULL,
    [finishDossageForm]     VARCHAR (80)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_finishDossageForm] DEFAULT ('') NOT NULL,
    [keterangan]            TEXT          CONSTRAINT [DEFAULT_TB_PengajuanSourcing_keterangan] DEFAULT ('') NOT NULL,
    [vendorAERO]            TEXT          CONSTRAINT [DEFAULT_TB_PengajuanSourcing_vendorAERO] DEFAULT ('') NOT NULL,
    [documentReq]           VARCHAR (100) CONSTRAINT [DEFAULT_TB_PengajuanSourcing_documentReq] DEFAULT ('') NOT NULL,
    [dateSourcing]          VARCHAR (20)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_dateSourcing] DEFAULT ('-') NOT NULL,
    [teamLeader]            VARCHAR (10)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_teamLeader] DEFAULT ('') NOT NULL,
    [researcher]            VARCHAR (50)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_researcher] DEFAULT ('') NOT NULL,
    [feedbackTL]            BIT           CONSTRAINT [DEFAULT_TB_PengajuanSourcing_feedbackTL] DEFAULT ((0)) NOT NULL,
    [feedbackRPIC]          BIT           CONSTRAINT [DEFAULT_TB_PengajuanSourcing_feedbackRPIC] DEFAULT ((0)) NOT NULL,
    [dateApprovedTL]        VARCHAR (20)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_dateApprovedTL] DEFAULT ('-') NOT NULL,
    [dateAcceptedRPIC]      VARCHAR (20)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_dateAcceptedRPIC] DEFAULT ('-') NOT NULL,
    [statusRiwayat]         VARCHAR (15)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_statusRiwayat] DEFAULT ('NO STATUS') NOT NULL,
    [statusSourcing]        VARCHAR (15)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_statusPengajuan] DEFAULT ('NO STATUS') NOT NULL,
    [sumaryReport]          TEXT          CONSTRAINT [DEFAULT_TB_PengajuanSourcing_sumaryReport] DEFAULT ('') NOT NULL,
    [dateSumaryReport]      VARCHAR (20)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_dateSumaryReport] DEFAULT ('-') NOT NULL,
    [idProject]             INT           CONSTRAINT [DEFAULT_TB_PengajuanSourcing_idProject] DEFAULT ((0)) NOT NULL,
    [created]               DATETIME      NULL,
    CONSTRAINT [TB_PengajuanSourcing_PK] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_PengajuanSourcing_TB_Project] FOREIGN KEY ([idProject]) REFERENCES [dbo].[TB_Project] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Supplier] (
    [id]                     INT           IDENTITY (1, 1) NOT NULL,
    [supplier]               VARCHAR (80)  CONSTRAINT [DEFAULT_TB_Supplier_supplier] DEFAULT ('') NOT NULL,
    [manufacture]            VARCHAR (80)  CONSTRAINT [DEFAULT_TB_Supplier_manufacture] DEFAULT ('') NOT NULL,
    [originCountry]          VARCHAR (30)  CONSTRAINT [DEFAULT_TB_Supplier_originCountry] DEFAULT ('') NOT NULL,
    [leadTime]               VARCHAR (20)  CONSTRAINT [DEFAULT_TB_Supplier_leadTime] DEFAULT ('') NOT NULL,
    [catalogOrCasNumber]     VARCHAR (50)  CONSTRAINT [DEFAULT_TB_Supplier_catalogOrCasNumber] DEFAULT ('') NOT NULL,
    [gradeOrReference]       VARCHAR (30)  CONSTRAINT [DEFAULT_TB_Supplier_gradeOrReference] DEFAULT ('') NOT NULL,
    [documentInfo]           VARCHAR (100) CONSTRAINT [DEFAULT_TB_Supplier_documentInfo] DEFAULT ('') NOT NULL,
    [feedbackRndPriceReview] TEXT          CONSTRAINT [DEFAULT_TB_Supplier_feedbackRndPriceReview] DEFAULT ('') NOT NULL,
    [dateFinalFeedbackRnd]   VARCHAR (20)  CONSTRAINT [DEFAULT_TB_Supplier_dateFinalFeedbackRnd] DEFAULT ('-') NOT NULL,
    [finalFeedbackRnd]       TEXT          CONSTRAINT [DEFAULT_TB_Supplier_finalFeedbackRnd] DEFAULT ('') NOT NULL,
    [writerFinalFeedbackRnd] VARCHAR (50)  CONSTRAINT [DEFAULT_TB_Supplier_writerFinalFeedbackRnd] DEFAULT ('') NOT NULL,
    [idMaterial]             INT           CONSTRAINT [DEFAULT_TB_Supplier_idMaterial] DEFAULT ((0)) NOT NULL,
    [created]                DATETIME      NULL,
    CONSTRAINT [TB_Supplier_PK] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [TB_Supplier_FK] FOREIGN KEY ([idMaterial]) REFERENCES [dbo].[TB_PengajuanSourcing] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_DetailSupplier] (
    [idDetailSupplier] INT             IDENTITY (1, 1) NOT NULL,
    [MoQ]              DECIMAL (18, 2) CONSTRAINT [DEFAULT_TB_DetailSupplier_MoQ] DEFAULT ((0)) NOT NULL,
    [UoM]              VARCHAR (10)    CONSTRAINT [DEFAULT_TB_DetailSupplier_UoM] DEFAULT ('') NOT NULL,
    [price]            VARCHAR (50)    CONSTRAINT [DEFAULT_TB_DetailSupplier_price] DEFAULT ('') NOT NULL,
    [idSupplier]       INT             CONSTRAINT [DEFAULT_TB_DetailSupplier_idSupplier] DEFAULT ((0)) NOT NULL,
    CONSTRAINT [TB_DetailSupplier_PK] PRIMARY KEY CLUSTERED ([idDetailSupplier] ASC),
    CONSTRAINT [TB_DetailSupplier_FK] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_DetailFeedbackRnd] (
    [id]           INT          IDENTITY (1, 1) NOT NULL,
    [dateFeedback] VARCHAR (15) CONSTRAINT [DEFAULT_TB_DetailFeedbackRnd_dateFeedback] DEFAULT ('-') NOT NULL,
    [sampel]       TEXT         CONSTRAINT [DEFAULT_TB_DetailFeedbackRnd_sampel] DEFAULT ('') NOT NULL,
    [writer]       VARCHAR (50) CONSTRAINT [DEFAULT_TB_DetailFeedbackRnd_writer] DEFAULT ('') NOT NULL,
    [idSupplier]   INT          CONSTRAINT [DEFAULT_TB_DetailFeedbackRnd_idSupplier] DEFAULT ((0)) NOT NULL,
    CONSTRAINT [PK_TB_DetailFeedbackRnd] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_DetailFeedbackRnd_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_FeedbackDocReq] (
    [id]         INT         IDENTITY (1, 1) NOT NULL,
    [CoA]        VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_CoA] DEFAULT ('') NOT NULL,
    [MSDS]       VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_MSDS] DEFAULT ('') NOT NULL,
    [MoA]        VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_MoA] DEFAULT ('') NOT NULL,
    [Halal]      VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_Halal] DEFAULT ('') NOT NULL,
    [DMF]        VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_DMF] DEFAULT ('') NOT NULL,
    [GMP]        VARCHAR (5) CONSTRAINT [DEFAULT_TB_FeedbackDocReq_GMP] DEFAULT ('') NOT NULL,
    [idSupplier] INT         CONSTRAINT [DEFAULT_TB_FeedbackDocReq_idSupplier] DEFAULT ((0)) NOT NULL,
    CONSTRAINT [PK_TB_FeedbackDocReq] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_FeedbackDocReq_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_FeedbackProc] (
    [id]               INT          IDENTITY (1, 1) NOT NULL,
    [dateFeedbackProc] VARCHAR (15) CONSTRAINT [DEFAULT_TB_FeedbackProc_dateFeedbackProc] DEFAULT ('-') NOT NULL,
    [feedback]         TEXT         CONSTRAINT [DEFAULT_TB_FeedbackProc_feedback] DEFAULT ('') NOT NULL,
    [writer]           VARCHAR (50) CONSTRAINT [DEFAULT_TB_FeedbackProc_writer] DEFAULT ('') NOT NULL,
    [idSupplier]       INT          CONSTRAINT [DEFAULT_TB_FeedbackProc_idSupplier] DEFAULT ((0)) NOT NULL,
    CONSTRAINT [PK_TB_FeedbackProc] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_FeedbackProc_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_File] (
    [id]         INT           IDENTITY (1, 1) NOT NULL,
    [fileName]   VARCHAR (200) CONSTRAINT [DEFAULT_TB_File_fileName] DEFAULT ('') NOT NULL,
    [fileHash]   VARCHAR (200) CONSTRAINT [DEFAULT_TB_File_fileHash] DEFAULT ('') NOT NULL,
    [idSupplier] INT           CONSTRAINT [DEFAULT_TB_File_idSupplier] DEFAULT ((0)) NOT NULL,
    CONSTRAINT [PK_TB_File] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_File_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Notifications] (
    [id]             INT           IDENTITY (1, 1) NOT NULL,
    [randomId]       VARCHAR (50)  CONSTRAINT [DEFAULT_TB_Notifications_randomId] DEFAULT ('') NOT NULL,
    [subject]        VARCHAR (250) CONSTRAINT [DEFAULT_TB_Notifications_subject] DEFAULT ('') NOT NULL,
    [message]        TEXT          CONSTRAINT [DEFAULT_TB_Notifications_message] DEFAULT ('') NOT NULL,
    [person]         VARCHAR (50)  CONSTRAINT [DEFAULT_TB_Notifications_person] DEFAULT ('') NOT NULL,
    [sourcingNumber] INT           CONSTRAINT [DEFAULT_TB_Notifications_sourcingNumber] DEFAULT ((0)) NULL,
    [idMaterial]     INT           CONSTRAINT [DEFAULT_TB_Notifications_idMaterial] DEFAULT ((0)) NULL,
    [idSupplier]     INT           CONSTRAINT [DEFAULT_TB_Notifications_idSupplier] DEFAULT ((0)) NULL,
    [created]        DATETIME      NULL,
    CONSTRAINT [PK_TB_Notifications] PRIMARY KEY CLUSTERED ([id] ASC)
);

CREATE TABLE [dbo].[TB_StatusNotifications] (
    [readingStatus]        BIT          CONSTRAINT [DEFAULT_TB_StatusNotifications_readingStatus] DEFAULT ((0)) NOT NULL,
    [notifStatus]          BIT          CONSTRAINT [DEFAULT_TB_StatusNotifications_notifStatus] DEFAULT ((0)) NOT NULL,
    [levelUser]            INT          CONSTRAINT [DEFAULT_TB_StatusNotifications_levelUser] DEFAULT ((0)) NOT NULL,
    [idUser]               INT          CONSTRAINT [DEFAULT_TB_StatusNotifications_idUser] DEFAULT ((0)) NOT NULL,
    [randomIdNotification] VARCHAR (50) CONSTRAINT [DEFAULT_TB_StatusNotifications_randomIdNotification] DEFAULT ('') NOT NULL,
    [idNotification]       INT          CONSTRAINT [DEFAULT_TB_StatusNotifications_idNotification] DEFAULT ((0)) NOT NULL,
    [created]              DATETIME     NULL,
    CONSTRAINT [FK_TB_StatusNotifications_TB_Notifications] FOREIGN KEY ([idNotification]) REFERENCES [dbo].[TB_Notifications] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Admin] (
    [id]         INT          IDENTITY (1, 1) NOT NULL,
    [username]   VARCHAR (50) COLLATE SQL_Latin1_General_CP1_CS_AS CONSTRAINT [DEFAULT_TB_Admin_username] DEFAULT ('') NOT NULL,
    [password]   VARCHAR (40) CONSTRAINT [DEFAULT_TB_Admin_password] DEFAULT ('') NOT NULL,
    [level]      INT          CONSTRAINT [DEFAULT_TB_Admin_level] DEFAULT ((0)) NOT NULL,
    [teamLeader] VARCHAR (10) CONSTRAINT [DEFAULT_TB_Admin_teamLeader] DEFAULT ('') NOT NULL,
    CONSTRAINT [PK_TB_Admin] PRIMARY KEY CLUSTERED ([id] ASC)
);

CREATE TABLE [dbo].[TB_MasterVendor] (
    [id]         INT          IDENTITY (1, 1) NOT NULL,
    [vendorName] VARCHAR (80) CONSTRAINT [DEFAULT_NewTable_vendorName] DEFAULT ('') NOT NULL,
    [location]   TEXT         CONSTRAINT [DEFAULT_NewTable_location] DEFAULT ('') NOT NULL,
    [created]    DATETIME     NULL,
    CONSTRAINT [PK_NewTable] PRIMARY KEY CLUSTERED ([id] ASC)
);

GO
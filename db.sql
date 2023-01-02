CREATE DATABASE rcproject;

USE rcproject;

CREATE TABLE [dbo].[TB_Project] (
    [projectCode] VARCHAR (100) NOT NULL,
    [projectName] VARCHAR (100) NULL,
    CONSTRAINT [TB_Project_PK] PRIMARY KEY CLUSTERED ([projectCode] ASC)
);

CREATE TABLE [dbo].[TB_PengajuanSourcing] (
    [id]                    INT           IDENTITY (0, 1) NOT NULL,
    [materialCategory]      VARCHAR (40)  NULL,
    [materialName]          TEXT          NULL,
    [priority]              INT           NULL,
    [materialSpesification] TEXT          NULL,
    [catalogOrCasNumber]    VARCHAR (100) NULL,
    [company]               VARCHAR (50)  NULL,
    [website]               VARCHAR (50)  NULL,
    [finishDossageForm]     VARCHAR (50)  NULL,
    [keterangan]            TEXT          NULL,
    [vendor]                VARCHAR (50)  NULL,
    [documentReq]           VARCHAR (100) NULL,
    [projectCode]           VARCHAR (100) NULL,
    [dateSourcing]          DATE          NULL,
    [teamLeader]            VARCHAR (100) NULL,
    [researcher]            VARCHAR (100) NULL,
    [feedbackTL]            BIT           NULL,
    [feedbackRPIC]          BIT           NULL,
    [dateApprovedTL]        DATE          NULL,
    [dateAcceptedRPIC]      DATE          NULL,
    [statusRiwayat]         VARCHAR (50)  NULL,
    [statusPengajuan]       VARCHAR (50)  CONSTRAINT [DEFAULT_TB_PengajuanSourcing_statusPengajuan] DEFAULT ('') NOT NULL,
    [sumaryReport]          TEXT          NULL,
    [dateSumaryReport]      DATE          NULL,
    [created]               DATETIME      NULL,
    CONSTRAINT [TB_PengajuanSourcing_PK] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [TB_PengajuanSourcing_FK] FOREIGN KEY ([projectCode]) REFERENCES [dbo].[TB_Project] ([projectCode]) ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Supplier] (
    [id]                     INT           IDENTITY (0, 1) NOT NULL,
    [supplier]               VARCHAR (100) CONSTRAINT [DEFAULT_TB_Supplier_supplier] DEFAULT ('') NOT NULL,
    [manufacture]            VARCHAR (100) CONSTRAINT [DEFAULT_TB_Supplier_manufacture] DEFAULT ('') NOT NULL,
    [originCountry]          VARCHAR (100) CONSTRAINT [DEFAULT_TB_Supplier_originCountry] DEFAULT ('') NOT NULL,
    [leadTime]               DATE          NULL,
    [catalogOrCasNumber]     VARCHAR (100) NULL,
    [gradeOrReference]       VARCHAR (100) NULL,
    [documentInfo]           VARCHAR (100) NULL,
    [document]               VARCHAR (100) NULL,
    [feedbackRndPriceReview] TEXT          CONSTRAINT [DEFAULT_TB_Supplier_feedbackRndPriceReview] DEFAULT ('') NULL,
    [dateFinalFeedbackRnd]   DATE          NULL,
    [finalFeedbackRnd]       TEXT          CONSTRAINT [DEFAULT_TB_Supplier_finalFeedbackRnd] DEFAULT ('') NULL,
    [idMaterial]             INT           NULL,
    CONSTRAINT [TB_Supplier_PK] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [TB_Supplier_FK] FOREIGN KEY ([idMaterial]) REFERENCES [dbo].[TB_PengajuanSourcing] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_DetailSupplier] (
    [idDetailSupplier] INT           IDENTITY (0, 1) NOT NULL,
    [MoQ]              INT           NULL,
    [UoM]              VARCHAR (100) NULL,
    [price]            VARCHAR (50)  NULL,
    [idSupplier]       INT           NULL,
    CONSTRAINT [TB_DetailSupplier_PK] PRIMARY KEY CLUSTERED ([idDetailSupplier] ASC),
    CONSTRAINT [TB_DetailSupplier_FK] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_DetailFeedbackRnd] (
    [id]           INT          IDENTITY (0, 1) NOT NULL,
    [dateFeedback] DATE         NULL,
    [sampel]       TEXT         NULL,
    [writer]       VARCHAR (50) NULL,
    [idSupplier]   INT          NULL,
    CONSTRAINT [PK_TB_DetailFeedbackRnd] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_DetailFeedbackRnd_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_FeedbackDocReq] (
    [id]         INT         IDENTITY (0, 1) NOT NULL,
    [CoA]        VARCHAR (5) NULL,
    [MSDS]       VARCHAR (5) NULL,
    [MoA]        VARCHAR (5) NULL,
    [Halal]      VARCHAR (5) NULL,
    [DMF]        VARCHAR (5) NULL,
    [GMP]        VARCHAR (5) NULL,
    [idSupplier] INT         NULL,
    CONSTRAINT [PK_TB_FeedbackDocReq] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_FeedbackDocReq_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_FeedbackProc] (
    [id]               INT          IDENTITY (0, 1) NOT NULL,
    [dateFeedbackProc] DATE         NULL,
    [feedback]         TEXT         NULL,
    [writer]           VARCHAR (50) NULL,
    [idSupplier]       INT          NULL,
    CONSTRAINT [PK_TB_FeedbackProc] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_FeedbackProc_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_File] (
    [id]         INT           IDENTITY (0, 1) NOT NULL,
    [fileName]   VARCHAR (200) NULL,
    [fileHash]   VARCHAR (200) NULL,
    [idSupplier] INT           NULL,
    CONSTRAINT [PK_TB_File] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_File_TB_Supplier] FOREIGN KEY ([idSupplier]) REFERENCES [dbo].[TB_Supplier] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Notifications] (
    [id] INT           IDENTITY (0, 1) NOT NULL,
    [subject]        VARCHAR (100) NULL,
    [message]        VARCHAR (255) NULL,
    [person]         VARCHAR (100) NULL,
    [status]         INT           NULL,
    [idMaterial]     INT           NULL,
    [idSupplier]     INT           NULL,
    [created]        DATETIME      NULL,
    CONSTRAINT [PK_TB_Notifications] PRIMARY KEY CLUSTERED ([idNotification] ASC)
);

CREATE TABLE [dbo].[TB_StatusNotifications] (
    [id]             INT      IDENTITY (0, 1) NOT NULL,
    [readingStatus]  BIT      CONSTRAINT [DEFAULT_TB_StatusNotifications_readingStatus] DEFAULT ((0)) NOT NULL,
    [idUser]         INT      NULL,
    [idNotification] INT      NULL,
    [created]        DATETIME NULL,
    CONSTRAINT [PK_TB_StatusNotifications] PRIMARY KEY CLUSTERED ([id] ASC),
    CONSTRAINT [FK_TB_StatusNotifications_TB_Notifications] FOREIGN KEY ([idNotification]) REFERENCES [dbo].[TB_Notifications] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE [dbo].[TB_Admin] (
    [id]         INT           IDENTITY (0, 1) NOT NULL,
    [username]   VARCHAR (100) NULL,
    [password]   VARCHAR (50)  NULL,
    [level]      INT           NULL,
    [teamLeader] VARCHAR (10)  NULL,
    CONSTRAINT [PK_TB_Admin] PRIMARY KEY CLUSTERED ([id] ASC)
);

GO
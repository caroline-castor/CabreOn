CREATE DATABASE IF NOT EXISTS CABREON;

USE CABREON;

CREATE TABLE IF NOT EXISTS Cliente(
	RG VARCHAR(12) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    dataNascimento DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(15),
    apelido VARCHAR(50) NOT NULL,
    senha VARCHAR(10) NOT NULL,
    UNIQUE(apelido),
    PRIMARY KEY(RG)
);

CREATE TABLE IF NOT EXISTS Admin(
    CPF VARCHAR (20) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    dataNascimento DATE,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(15),
    apelido VARCHAR(50) NOT NULL,
    senha VARCHAR(10) NOT NULL,
    UNIQUE(apelido),
    qteConvites INT,
    PRIMARY KEY(CPF)
)ENGINE=MYISAM CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS Festa(
	ID VARCHAR(50) NOT NULL,
	CPF_admin VARCHAR(20),
    nome VARCHAR(255) NOT NULL,
    valor FLOAT,
    descricao VARCHAR(512),
    dataRealizacao DATE NOT NULL,
    qtdIngressos int,
    qtdIngressosRestantes int,
    local varchar(100),
    hora TIME,
    foto varchar(100),
    FOREIGN KEY (CPF_admin) REFERENCES Admin(CPF),
    PRIMARY KEY(ID)
)ENGINE=MYISAM CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS Evento(
	ID VARCHAR(50) NOT NULL,
	CPF_admin VARCHAR(20),
    nome VARCHAR(255) NOT NULL,
    valor FLOAT,
    descricao VARCHAR(512),
    dataRealizacao DATE NOT NULL,
    qtdIngressos int,
    qtdIngressosRestantes int,
    local varchar(100),
    hora TIME NOT NULL,
    foto varchar(100),
    FOREIGN KEY (CPF_admin) REFERENCES Admin(CPF),
    PRIMARY KEY(ID)
)ENGINE=MYISAM CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS Compra_Evento(
	ID INT AUTO_INCREMENT NOT NULL UNIQUE,
    RG_Cli VARCHAR(12),
    ID_Evento VARCHAR(50),
    qtdIngressos INT,
    PRIMARY KEY(ID),
    FOREIGN KEY (RG_Cli) REFERENCES Cliente(RG),
    FOREIGN KEY(ID_Evento) REFERENCES Evento(ID)
);

CREATE TABLE IF NOT EXISTS Compra_Festa(
	ID INT AUTO_INCREMENT NOT NULL UNIQUE,
    RG_Cliente VARCHAR(12),
    ID_Festa VARCHAR(50),
    qtdIngressos INT,
    PRIMARY KEY(ID),
    FOREIGN KEY (RG_Cliente) REFERENCES Cliente(RG),
    FOREIGN KEY(ID_Festa) REFERENCES Festa(ID)
)ENGINE=MYISAM CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS Contato(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    telefone VARCHAR(15),
    mensagem VARCHAR(512) NOT NULL,
    PRIMARY KEY(ID)
);
--O ID da festa e dos eventos serão calculador da seguinte forma, primeiro o cpf do Admin seguido da data completa de realização do evento

INSERT INTO Cliente(RG, nome, dataNascimento, email, telefone, apelido, senha) VALUES (
'00.000.000-1','Caroline Castor dos Santos', '30/08/1994', 'carolinecdsantos@gmail.com', '(16)982071719', 'Carol', '12345');

INSERT INTO Cliente(RG, nome, dataNascimento, email, telefone, apelido, senha) VALUES (
'00.000.000-2','Ilgner Lino Vieira', '12/07/1994', 'ilgner@gmail.com', '(16)999999999', 'Ilgner', '12345');

INSERT INTO Festa(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("Banana House Circus Edition",40,"Uma edição especial que levará você ao universo circense interagindo com grandes atrações e um espetáculo de apresentação pelos melhores DJ's de nossa região","14/07/2017",200,170,"Banana Brasil Eventos","17:00","images/img1.jpg");
INSERT INTO Festa(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("Sunset do Kevinho",60,"Um sábado a tarde até anoitecer com a presença do número 1 do funk na atualidade cantando seus hits de sucesso e as músicas novas (aguardem que vem mais música nova do kevinho)","22/07/2017",300,200,"Banana Brasil Eventos","17:00","images/img2.jpg");   
INSERT INTO Festa(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("Gig",15,"A Paradinha Ah Ah Ah Ah! A Rocknbeats está de volta com uma edição especial pra você que gosta de rebolar na balada, em casa, na facul, no supermercado… em qualquer lugar!","22/07/2017",150,50,"GIG - Rua 9 de Julho, 1817 - São Carlos, SP","23:00","images/img4.jpg");
INSERT INTO Festa(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("METAaAMORFOSE 18 anos",100,"A festa a fantasia mais tradicional de São Carlos e região está completando 18 anos, e o presente é voce quem ganha!Já imaginou uma festa open de CHOCOLATE? Willy Wonka te convida para uma deliciosa viagem a Fantástica Fábrica do METAaMORFOSE!","07/07/2017",300,75,"Banana Brasil Eventos","23:00","images/img5.jpg");   


INSERT INTO "Eventos(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("Palestra Cultura Ambev",0,"Venha conhecer mais sobre a Cultura Ambev, nossos princípios e nossa gente com a participação do Gerente de Gente e Gestão Mauro Cardoso.","04/07/2017",200,150,"Anfiteatro Bento Prado Jr UFSCAR","18:00","images/img6.jpg");
INSERT INTO Eventos(nome,valor,descricao,dataRealizacao,qtdIngressos,qtdIngressosRestantes,local,hora,foto) VALUES("Mesa-Redonda Movile",0,"Carreiras em Empresas de Tecnologia: visa explicar e dar noção aos alunos sobre a carreira em uma empresa de tecnologia, o seu dia-a-dia, a trajetória dos convidados da mesa, as adversidades do mundo da tecnologia e como o mercado tem se adaptado a constante evolução tecnológica","02/07/2017",50,10,"Anfiteatro Bento Prado Jr UFSCAR","12:15","images/img3.jpg");
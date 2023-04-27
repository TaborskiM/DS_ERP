-- Create the client table
CREATE TABLE client (
  CODCLT INT PRIMARY KEY,
  Nom_CLT VARCHAR(50) NOT NULL,
  ADRS_CLT VARCHAR(100) NOT NULL
);

-- Create the agence table
CREATE TABLE agence (
  CODAG VARCHAR(50) PRIMARY KEY,
  Libelle_AG VARCHAR(50) NOT NULL,
  ADRS_AG VARCHAR(100) NOT NULL
);

-- Create the operation table
CREATE TABLE operation (
  CODOPER VARCHAR(50) PRIMARY KEY,
  Libelle_OPER VARCHAR(50) NOT NULL
);

-- Create the compte table
CREATE TABLE compte (
  NUMCPTE VARCHAR(50) PRIMARY KEY,
  Libelle_CPTE VARCHAR(50) NOT NULL,
  TOT_Debit DECIMAL(10, 2) NOT NULL,
  TOT_Credit DECIMAL(10, 2) NOT NULL,
  Solde DECIMAL(10, 2) NOT NULL,
  CODAG VARCHAR(50) NOT NULL,
  CODCLT INT NOT NULL,
  FOREIGN KEY (CODAG) REFERENCES agence (CODAG),
  FOREIGN KEY (CODCLT) REFERENCES client (CODCLT)
);

-- Create the mouvements table
CREATE TABLE mouvements (
  NUMCPTE VARCHAR(50) NOT NULL,
  CODOPER VARCHAR(50) NOT NULL,
  NUM_MVT INT PRIMARY KEY,
  DATE_MVT DATE NOT NULL,
  MNT_MVT DECIMAL(10, 2) NOT NULL,
  SENS_MVT CHAR(1) NOT NULL,
  FOREIGN KEY (NUMCPTE) REFERENCES compte (NUMCPTE),
  FOREIGN KEY (CODOPER) REFERENCES operation (CODOPER)
);
CREATE TABLE login (
 username VARCHAR(50),
 password VARCHAR(50)
);
INSERT INTO `login`(`username`, `password`) VALUES ('admin','12345');
INSERT INTO `login`(`username`, `password`) VALUES ('malek','12345');
INSERT INTO `agence`(`CODAG`, `Libelle_AG`, `ADRS_AG`) VALUES ('024','ATTIJARI','25, Rue Hédi Nouira ,Tunis');
INSERT INTO `agence`(`CODAG`, `Libelle_AG`, `ADRS_AG`) VALUES ('026','ATTIJARI','1, Avenue Mohamed Ali ,Gabès');
INSERT INTO `agence`(`CODAG`, `Libelle_AG`, `ADRS_AG`) VALUES ('900','ATTIJARI','v Abdelhamid El Cadhi - 4180 Djerba');
INSERT INTO `agence`(`CODAG`, `Libelle_AG`, `ADRS_AG`) VALUES ('705','ATTIJARI','VENUE HABIB BOURGUIBA GABES 6000 ,Gabes');
